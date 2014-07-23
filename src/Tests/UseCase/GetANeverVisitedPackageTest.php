<?php

namespace PUGX\Bot\Tests\Package;


use PUGX\Bot\UseCase\GetANeverVisitedPackage;

class GetANeverVisitedPackageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToMakeAPR()
    {
        $this->markTestIncomplete();

        $command = new GetANeverVisitedPackage();
        $this->assertTrue($command->execute());
    }
}
