<?php

namespace PUGX\Bot\Infrastructure\Tests\Package;

use PUGX\Bot\Infrastructure\Package\DoctrineReader;

class DoctrineReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGetANotVisitedRecentlyPackage()
    {
        $repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');

        $package = $this->getMockBuilder('PUGX\Bot\Package')
            ->disableOriginalConstructor()
            ->getMock();

        $repository
            ->expects($this->once())
            ->method('findBy')
            ->with(array('blacklisted' => false), array('visited' => 'ASC', 'lastVisited' => 'ASC', 'name' => 'ASC'), 1)
            ->will($this->returnValue(array($package)));

        $reader = new DoctrineReader($repository);

        $this->assertInstanceOf('\Packagist\Api\Result\Package', $reader->getANotVisitedRecentlyPackage());
    }
}
