<?php

namespace PUGX\Bot\Tests\Step;

use PUGX\Bot\Step\GetANeverVisitedPackage;

class GetANeverVisitedPackageTest extends BaseTestCase
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

        $command = new GetANeverVisitedPackage($repository, $this->mockEventDispatcher());
        $this->assertEquals($package, $command->execute());
    }
}
