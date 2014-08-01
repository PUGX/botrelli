<?php

namespace PUGX\Bot\Tests\Package;

use \PUGX\Bot\Package\PackageRepository;

class PackageRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGetANeverVisitedPackage()
    {
        $this->markTestSkipped();

        $provider = $this->getMock('\PUGX\Bot\Package\ProviderInterface');

        $package = $this->getMockBuilder('PUGX\Bot\Package')
            ->disableOriginalConstructor()
            ->getMock();

        $provider
            ->expects($this->once())
            ->method('getANeverVisitedPackage')
            ->will($this->returnValue($package));

        $packageRepository = new PackageRepository($provider);

        $this->assertInstanceOf('\Packagist\Api\Result\Package', $packageRepository->getANeverVisitedPackage());
    }
}
