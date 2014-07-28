<?php
namespace PUGX\Bot\Tests\UseCase;


class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    protected $eventDispatcher;

    public function setUp()
    {
       $this->eventDispatcher = $this->mockEventDispatcher();
    }

    public function mockEventDispatcher()
    {
        return $this->getMock('\Symfony\Component\EventDispatcher\EventDispatcherInterface');
    }
}
