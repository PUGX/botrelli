<?php

namespace PUGX\Bot\Tests\Service;

use PUGX\Bot\Service\GetRandomPackage;

class GetRandomPackageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToFetchAListOfPackages()
    {
        $repository = $this->getMockBuilder('\PUGX\Bot\Package\PackageRepositoryInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $packages = array(
            'pugx/pinco',
            'pugx/pallino'
        );

        $return = new \stdClass();

        $repository
            ->expects($this->once())
            ->method('getAllPackages')
            ->will($this->returnValue($packages));

        $repository
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue($return));

        $randomPackage = new GetRandomPackage($repository);

        $this->assertEquals($randomPackage->getRandomPackage(), $return);
    }
}
