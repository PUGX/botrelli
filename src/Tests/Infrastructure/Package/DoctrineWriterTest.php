<?php

namespace PUGX\Bot\Infrastructure\Tests\Package;

use PUGX\Bot\Infrastructure\Package\DoctrineWriter;

class DoctrineWriterTest extends \PHPUnit_Framework_TestCase
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

        $writer = new DoctrineWriter($manager);

        $writer->write($package);
    }
}
