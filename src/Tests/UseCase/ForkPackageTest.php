<?php

namespace PUGX\Bot\Tests\Package;

use Packagist\Api\Result\Package;
use \PUGX\Bot\UseCase\ForkPackage;

class ForkPackageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToForkAPackage()
    {
        $this->markTestIncomplete();

        $package = new Package();

        $command = new ForkPackage();
        $this->assertTrue($command->execute($package));
    }
}
