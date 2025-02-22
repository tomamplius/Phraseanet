<?php

namespace Alchemy\Phrasea\Model\Proxies\__CG__\Alchemy\Phrasea\Model\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Basket extends \Alchemy\Phrasea\Model\Entities\Basket implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'id', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'name', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'description', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'user', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'isRead', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'pusher', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'archived', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'created', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'updated', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'validation', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'elements', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'order'];
        }

        return ['__isInitialized__', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'id', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'name', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'description', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'user', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'isRead', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'pusher', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'archived', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'created', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'updated', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'validation', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'elements', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\Basket' . "\0" . 'order'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Basket $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', [$name]);

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', []);

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescription', [$description]);

        return parent::setDescription($description);
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescription', []);

        return parent::getDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setUser(\Alchemy\Phrasea\Model\Entities\User $user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUser', [$user]);

        return parent::setUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser', []);

        return parent::getUser();
    }

    /**
     * {@inheritDoc}
     */
    public function markRead()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'markRead', []);

        return parent::markRead();
    }

    /**
     * {@inheritDoc}
     */
    public function markUnread()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'markUnread', []);

        return parent::markUnread();
    }

    /**
     * {@inheritDoc}
     */
    public function isRead()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isRead', []);

        return parent::isRead();
    }

    /**
     * {@inheritDoc}
     */
    public function setPusher(\Alchemy\Phrasea\Model\Entities\User $user = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPusher', [$user]);

        return parent::setPusher($user);
    }

    /**
     * {@inheritDoc}
     */
    public function getPusher()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPusher', []);

        return parent::getPusher();
    }

    /**
     * {@inheritDoc}
     */
    public function setArchived($archived)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArchived', [$archived]);

        return parent::setArchived($archived);
    }

    /**
     * {@inheritDoc}
     */
    public function getArchived()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArchived', []);

        return parent::getArchived();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreated(\DateTime $created)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreated', [$created]);

        return parent::setCreated($created);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreated()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreated', []);

        return parent::getCreated();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdated(\DateTime $updated)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdated', [$updated]);

        return parent::setUpdated($updated);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdated()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdated', []);

        return parent::getUpdated();
    }

    /**
     * {@inheritDoc}
     */
    public function setValidation(\Alchemy\Phrasea\Model\Entities\ValidationSession $validation = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setValidation', [$validation]);

        return parent::setValidation($validation);
    }

    /**
     * {@inheritDoc}
     */
    public function getValidation()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getValidation', []);

        return parent::getValidation();
    }

    /**
     * {@inheritDoc}
     */
    public function addElement(\Alchemy\Phrasea\Model\Entities\BasketElement $element)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addElement', [$element]);

        return parent::addElement($element);
    }

    /**
     * {@inheritDoc}
     */
    public function removeElement(\Alchemy\Phrasea\Model\Entities\BasketElement $element)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeElement', [$element]);

        return parent::removeElement($element);
    }

    /**
     * {@inheritDoc}
     */
    public function setOrder(\Alchemy\Phrasea\Model\Entities\Order $order = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOrder', [$order]);

        return parent::setOrder($order);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOrder', []);

        return parent::getOrder();
    }

    /**
     * {@inheritDoc}
     */
    public function getElements()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getElements', []);

        return parent::getElements();
    }

    /**
     * {@inheritDoc}
     */
    public function getElementsByOrder($order)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getElementsByOrder', [$order]);

        return parent::getElementsByOrder($order);
    }

    /**
     * {@inheritDoc}
     */
    public function hasRecord(\Alchemy\Phrasea\Application $app, \record_adapter $record)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasRecord', [$app, $record]);

        return parent::hasRecord($app, $record);
    }

    /**
     * {@inheritDoc}
     */
    public function getSize(\Alchemy\Phrasea\Application $app)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSize', [$app]);

        return parent::getSize($app);
    }

}
