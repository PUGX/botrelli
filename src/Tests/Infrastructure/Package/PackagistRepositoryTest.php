<?php

namespace PUGX\Bot\Tests\Infrastructure\Package;

use PUGX\Bot\Infrastructure\Package\PackagistRepository;

class PackagistRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGetAPackage()
    {
        $client = $this->getMock('\Packagist\Api\Client');

        $package = $this->getMockBuilder('PUGX\Bot\Package')
            ->disableOriginalConstructor()
            ->getMock();

        $client
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue($package));

        $packageRepository = new PackagistRepository($client);

        $this->assertInstanceOf('\PUGX\Bot\Package', $packageRepository->get('leaphly/price'));
    }
}
