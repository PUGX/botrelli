<?php

namespace PUGX\Bot\Tests\Package;

use Packagist\Api\Result\Package;
use PUGX\Bot\LocalPackage;
use PUGX\Bot\UseCase\MakeAPR;

class MakeAPRTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToMakeAPR()
    {
        $this->markTestIncomplete();

        $messageRepository = $this->getMock('\PUGX\Bot\Message\MessageRepositoryInterface');

        $package = new LocalPackage('/tmp', new Package());

        $command = new MakeAPR($messageRepository);
        $this->assertTrue($command->execute($package));
    }
}
