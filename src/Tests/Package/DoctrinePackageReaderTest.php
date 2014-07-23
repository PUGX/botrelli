<?php

namespace PUGX\Bot\Tests\Package;

use PUGX\Bot\Package\DoctrinePackageReader;

class DoctrinePackageReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGetANeverVisitedPackage()
    {
        $repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');

        $package = $this->getMockBuilder('PUGX\Bot\Package')
            ->disableOriginalConstructor()
            ->getMock();

        $repository
            ->expects($this->once())
            ->method('findBy')
            ->with(array('visited' => false), array('name' => 'ASC'), 1)
            ->will($this->returnValue($package));

        $reader = new DoctrinePackageReader($repository);

        $this->assertInstanceOf('\Packagist\Api\Result\Package', $reader->getANeverVisitedPackage());
    }
}
