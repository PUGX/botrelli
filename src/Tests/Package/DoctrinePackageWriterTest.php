<?php

namespace PUGX\Bot\Tests\Package;

use PUGX\Bot\Package\DoctrinePackageWriter;

class DoctrinePackageWriterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldWriteAPackage()
    {
        $manager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');

        $package = $this->getMockBuilder('PUGX\Bot\Package')
            ->disableOriginalConstructor()
            ->getMock();

        $manager
            ->expects($this->once())
            ->method('persist')
            ->with($package);

        $manager
            ->expects($this->once())
            ->method('flush')
            ->with($package);

        $writer = new DoctrinePackageWriter($manager);

        $writer->write($package);
    }
}
