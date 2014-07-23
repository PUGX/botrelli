<?php

namespace PUGX\Bot\Tests\Package;

use Packagist\Api\Result\Package;
use PUGX\Bot\LocalPackage;
use PUGX\Bot\UseCase\ExecuteCSFixer;

class ExecuteCSFixerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToForkAPackage()
    {
        $this->markTestIncomplete();

        $package = new LocalPackage('/tmp', new Package());

        $command = new ExecuteCSFixer();
        $this->assertTrue($command->execute($package));
    }
}
