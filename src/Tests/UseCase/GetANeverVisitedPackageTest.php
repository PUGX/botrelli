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

        $command = new GetANeverVisitedPackage($repository);
        $this->assertTrue($command->execute());
    }
}
