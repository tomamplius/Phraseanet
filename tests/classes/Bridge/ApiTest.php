<?php

require_once __DIR__ . '/Bridge_datas.inc';

/**
 * @group functional
 * @group legacy
 */
class Bridge_ApiTest extends \PhraseanetTestCase
{
    /**
     * @var Bridge_Api
     */
    protected $object;
    protected $id;
    protected $type;

    public function setUp()
    {
        parent::setUp();

        $app = $this->getApplication();

        $stmt = $app->getApplicationBox()->get_connection()->prepare('DELETE FROM bridge_apis WHERE name = "Apitest"');
        $stmt->execute();
        $stmt->closeCursor();

        $this->type = 'Apitest';

        $api = Bridge_Api::create($app, $this->type);

        $this->id = $api->get_id();
        $this->object = new Bridge_Api($app, $api->get_id());
    }

    public function tearDown()
    {
        if ($this->object) {
            $this->object->delete();
        }
        try {
            new Bridge_Api(self::$DI['app'], $this->id);
            $this->fail();
        } catch (Bridge_Exception_ApiNotFound $e) {

        }
        parent::tearDown();
    }

    public function testGet_id()
    {
        $this->assertTrue(is_int($this->object->get_id()));
        $this->assertTrue($this->object->get_id() > 0);
        $this->assertEquals($this->id, $this->object->get_id());
    }

    public function testis_disabled()
    {
        $this->assertTrue(is_bool($this->object->is_disabled()));
        $this->assertFalse($this->object->is_disabled());
    }

    public function testenable()
    {
        $this->assertInternalType('bool', $this->object->is_disabled());
        $this->assertFalse($this->object->is_disabled());
        $this->backDateObjectUpdatedOnField();
        $update1 = $this->object->get_updated_on();

        $this->object->disable(new DateTime('+2 seconds'));
        $this->assertTrue($this->object->is_disabled());
        $update2 = $this->object->get_updated_on();

        $this->assertTrue($update2 > $update1, $update2->format('Y-m-d, H:i:s') ." sould be > to " . $update1->format('Y-m-d, H:i:s'));

        $this->assertFalse($this->object->is_disabled(new DateTime('+10 seconds')));
        $this->object->enable();
        $this->assertFalse($this->object->is_disabled());
    }

    public function testGet_created_on()
    {
        $this->assertInstanceOf('DateTime', $this->object->get_created_on());
        $this->assertTrue($this->object->get_created_on() <= new DateTime());
    }

    public function testGet_updated_on()
    {
        $this->assertInstanceOf('DateTime', $this->object->get_updated_on());
        $this->assertTrue($this->object->get_updated_on() <= new DateTime());
        $this->assertTrue($this->object->get_updated_on() >= $this->object->get_created_on());
    }

    private function backDateObjectUpdatedOnField()
    {
        static $reflection;

        if (null === $reflection) {
            $reflection = new ReflectionProperty(Bridge_Api::class, 'updated_on');

            $reflection->setAccessible(true);
        }

        $reflection->setValue($this->object, new DateTime('yesterday'));
    }
}
