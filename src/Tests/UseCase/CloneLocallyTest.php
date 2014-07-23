<?php

namespace PUGX\Bot\Tests\Package;

use Packagist\Api\Result\Package;

use PUGX\Bot\UseCase\CloneLocally;

class CloneLocallyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToCloneLocally()
    {
        $this->markTestIncomplete();

        $command = new CloneLocally();
        $this->assertInstanceOf('\PUGX\Bot\LocalPackage', $command->execute(new Package(), 'tmp'));
    }
}
