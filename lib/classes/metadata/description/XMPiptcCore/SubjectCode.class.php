<?php

/*
 * This file is part of Phraseanet
 *
 * (c) 2005-2012 Alchemy
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @license     http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link        www.phraseanet.com
 */
class metadata_description_XMPiptcCore_SubjectCode extends metadata_Abstract implements metadata_Interface
{

  const SOURCE = '/rdf:RDF/rdf:Description/XMP-iptcCore:SubjectCode';
  const NAME_SPACE = 'XMP-iptcCore';
  const TAGNAME = 'SubjectCode';
  const MAX_LENGTH = 0;
  const MULTI = false;
  const TYPE = self::TYPE_STRING;

}
