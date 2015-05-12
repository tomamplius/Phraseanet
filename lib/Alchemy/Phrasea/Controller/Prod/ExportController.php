<?php
/*
 * This file is part of Phraseanet
 *
 * (c) 2005-2015 Alchemy
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Alchemy\Phrasea\Controller\Prod;

use Alchemy\Phrasea\Application;
use Alchemy\Phrasea\Application\Helper\DispatcherAware;
use Alchemy\Phrasea\Controller\Controller;
use Alchemy\Phrasea\Core\Event\ExportFailureEvent;
use Alchemy\Phrasea\Core\PhraseaEvents;
use Alchemy\Phrasea\Exception\InvalidArgumentException;
use Alchemy\Phrasea\Notification\Emitter;
use Alchemy\Phrasea\Notification\Mail\MailRecordsExport;
use Alchemy\Phrasea\Notification\Receiver;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExportController extends Controller
{
    use DispatcherAware;

    /**
     * Display form to export documents
     *
     * @param  Application $app
     * @param  Request     $request
     * @return Response
     */
    public function displayMultiExport(Application $app, Request $request)
    {
        $download = new \set_export(
            $app,
            $request->request->get('lst', ''),
            $request->request->get('ssel', ''),
            $request->request->get('story')
        );

        return new Response($app['twig']->render('common/dialog_export.html.twig', [
            'download'             => $download,
            'ssttid'               => $request->request->get('ssel'),
            'lst'                  => $download->serialize_list(),
            'default_export_title' => $app['conf']->get(['registry', 'actions', 'default-export-title']),
            'choose_export_title'  => $app['conf']->get(['registry', 'actions', 'export-title-choice'])
        ]));
    }

    /**
     * Test a FTP connexion
     *
     * @param  Application  $app
     * @param  Request      $request
     * @return JsonResponse
     */
    public function testFtpConnexion(Application $app, Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            $app->abort(400);
        }

        $success = false;
        $msg = _('Error while connecting to FTP');

        try {
            $ftpClient = $app['phraseanet.ftp.client']($request->request->get('address', ''), 21, 90, !!$request->request->get('ssl'));
            $ftpClient->login($request->request->get('login', 'anonymous'), $request->request->get('password', 'anonymous'));
            $ftpClient->close();
            $msg = $app->trans('Connection to FTP succeed');
            $success = true;
        } catch (\Exception $e) {
        }

        return $app->json([
            'success' => $success,
            'message' => $msg
        ]);
    }

    /**
     *
     * @param  Application  $app
     * @param  Request      $request
     * @return JsonResponse
     */
    public function exportFtp(Application $app, Request $request)
    {
        $download = new \set_exportftp($app, $request->request->get('lst'), $request->request->get('ssttid'));

        $mandatoryParameters = ['address', 'login', 'obj'];

        foreach ($mandatoryParameters as $parameter) {
            if (!$request->request->get($parameter)) {
                $app->abort(400, sprintf('required parameter `%s` is missing', $parameter));
            }
        }

        if (count($download->get_display_ftp()) == 0) {
            return $app->json([
                'success' => false,
                'message' => $app->trans("You do not have required rights to send these documents over FTP")
            ]);
        }

        try {
            $download->prepare_export(
                $app['authentication']->getUser(),
                $app['filesystem'],
                $request->request->get('obj'),
                false,
                $request->request->get('businessfields')
            );

            $download->export_ftp(
                $request->request->get('user_dest'),
                $request->request->get('address'),
                $request->request->get('login'),
                $request->request->get('password', ''),
                $request->request->get('ssl'),
                $request->request->get('max_retry'),
                $request->request->get('passive'),
                $request->request->get('dest_folder'),
                $request->request->get('prefix_folder'),
                $request->request->get('logfile')
            );

            return $app->json([
                'success' => true,
                'message' => $app->trans('Export saved in the waiting queue')
            ]);
        } catch (\Exception $e) {
            return $app->json([
                'success' => false,
                'message' => $app->trans('Something went wrong')
            ]);
        }
    }

    /**
     * Export document by mail
     *
     * @param  Application  $app
     * @param  Request      $request
     * @return JsonResponse
     */
    public function exportMail(Application $app, Request $request)
    {
        set_time_limit(0);
        session_write_close();
        ignore_user_abort(true);

        $lst = $request->request->get('lst', '');
        $ssttid = $request->request->get('ssttid', '');

        //prepare export
        $download = new \set_export($app, $lst, $ssttid);
        $list = $download->prepare_export(
            $app['authentication']->getUser(),
            $app['filesystem'],
            (array) $request->request->get('obj'),
            $request->request->get("type") == "title" ? : false,
            $request->request->get('businessfields')
        );

        $separator = preg_split('//', ' ;,', -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $separator = '/\\' . implode('|\\', $separator) . '/';

        $list['export_name'] = sprintf("%s.zip", $download->getExportName());
        $list['email'] = implode(';', preg_split($separator, $request->request->get("destmail", "")));

        $destMails = [];
        //get destination mails
        foreach (explode(";", $list['email']) as $mail) {
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $destMails[] = $mail;
            } else {
                $this->dispatch(PhraseaEvents::EXPORT_MAIL_FAILURE, new ExportFailureEvent($app['authentication']->getUser()->getId(), $ssttid, $lst, \eventsmanager_notify_downloadmailfail::MAIL_NO_VALID, $mail));
            }
        }

        $token = $app['manipulator.token']->createEmailExportToken(serialize($list));

        if (count($destMails) > 0) {
            //zip documents
            \set_export::build_zip(
                $app,
                $token,
                $list,
                $app['tmp.download.path'].'/'. $token->getValue() . '.zip'
            );

            $remaingEmails = $destMails;

            $url = $app->url('prepare_download', ['token' => $token->getValue(), 'anonymous' => false, 'type' => \Session_Logger::EVENT_EXPORTMAIL]);

            $emitter = new Emitter($app['authentication']->getUser()->getDisplayName(), $app['authentication']->getUser()->getEmail());

            foreach ($destMails as $key => $mail) {
                try {
                    $receiver = new Receiver(null, trim($mail));
                } catch (InvalidArgumentException $e) {
                    continue;
                }

                $mail = MailRecordsExport::create($app, $receiver, $emitter, $request->request->get('textmail'));
                $mail->setButtonUrl($url);
                $mail->setExpiration($token->getExpiration());

                $app['notification.deliverer']->deliver($mail, !!$request->request->get('reading_confirm', false));
                unset($remaingEmails[$key]);
            }

            //some mails failed
            if (count($remaingEmails) > 0) {
                foreach ($remaingEmails as $mail) {
                    $this->dispatch(PhraseaEvents::EXPORT_MAIL_FAILURE, new ExportFailureEvent($app['authentication']->getUser()->getId(), $ssttid, $lst, \eventsmanager_notify_downloadmailfail::MAIL_FAIL, $mail));
                }
            }
        }

        return $app->json([
            'success' => true,
            'message' => ''
        ]);
    }
}
