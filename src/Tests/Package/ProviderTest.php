<?php

namespace PUGX\Bot\Tests\Package;

use PUGX\Bot\Package\Provider;

class ProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGetANeverVisitedPackage()
    {
        $writer = $this->getMock('PUGX\Bot\Package\PackageWriterInterface');
        $reader = $this->getMock('PUGX\Bot\Package\PackageReaderInterface');
        $package = $this->getMockBuilder('PUGX\Bot\Package')
            ->disableOriginalConstructor()
            ->getMock();

        $reader
            ->expects($this->once())
            ->method('getANeverVisitedPackage')
            ->will($this->returnValue($package));

        $provider = new Provider($writer, $reader);
        $package = $provider->getANeverVisitedPackage();

        $this->assertInstanceOf('\Packagist\Api\Result\Package', $package);
    }
}
