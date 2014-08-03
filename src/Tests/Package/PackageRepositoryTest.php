<?php

namespace PUGX\Bot\Tests\Package;

use PUGX\Bot\Infrastructure\Package\DoctrineRepository;

class PackageRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGetANotVisitedRecentlyPackage()
    {
        $reader = $this->getMock('\PUGX\Bot\Package\PackageReaderInterface');
        $writer = $this->getMock('\PUGX\Bot\Package\PackageWriterInterface');

        $package = $this->getMockBuilder('PUGX\Bot\Package')
            ->disableOriginalConstructor()
            ->getMock();

        $reader
            ->expects($this->once())
            ->method('getANotVisitedRecentlyPackage')
            ->will($this->returnValue($package));

        $packageRepository = new DoctrineRepository($reader, $writer);

        $this->assertInstanceOf('\Packagist\Api\Result\Package', $packageRepository->getANotVisitedRecentlyPackage());
    }
}
