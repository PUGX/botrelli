<?php

namespace PUGX\Bot\Tests\Package;

use PUGX\Bot\UseCase\GetANeverVisitedPackage;

class GetANeverVisitedPackageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGetANeverVisitedPackage()
    {
        $repository = $this->getMockBuilder('PUGX\Bot\Package\PackageRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $package = $this->getMockBuilder('PUGX\Bot\Package')
            ->disableOriginalConstructor()
            ->getMock();

        $repository
            ->expects($this->once())
            ->method('getANeverVisitedPackage')
            ->will($this->returnValue($package));

        $command = new GetANeverVisitedPackage($repository);
        $this->assertEquals($package, $command->execute());
    }
}
