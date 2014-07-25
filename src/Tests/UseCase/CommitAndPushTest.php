<?php

namespace PUGX\Bot\Tests\Package;

use PUGX\Bot\Package;
use PUGX\Bot\LocalPackage;
use PUGX\Bot\UseCase\CommitAndPush;

class CommitAndPushTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToCommitAndPush()
    {

        $package = new LocalPackage(array(), '/tmp', new Package());

        $gitWorkingCopy = $this->getMockBuilder('GitWrapper\GitWorkingCopy')
            ->disableOriginalConstructor()
            ->getMock();

        $gitWorkingCopy
            ->expects($this->once())
            ->method('add')
            ->with($this->equalTo('.'))
            ->will($this->returnValue($gitWorkingCopy));

        $gitWorkingCopy
            ->expects($this->once())
            ->method('commit')
            ->with($this->equalTo('CS Fixes'))
            ->will($this->returnValue($gitWorkingCopy));

        $gitWorkingCopy
            ->expects($this->once())
            ->method('push')
            ->with($this->equalTo('origin'), $this->equalTo('cs_fixer'))
            ->will($this->returnValue('860106e..4b64b6e  master -> master'));

        $command = new CommitAndPush();
        $command->initGit($gitWorkingCopy);

        $this->assertTrue($command->execute($package));
    }
    /**
     * @test
     */
    public function shouldReturnFalseIfPushFails()
    {

        $package = new LocalPackage(array(), '/tmp', new Package());

        $gitWorkingCopy = $this->getMockBuilder('GitWrapper\GitWorkingCopy')
            ->disableOriginalConstructor()
            ->getMock();

        $gitWorkingCopy
            ->expects($this->once())
            ->method('add')
            ->with($this->equalTo('.'))
            ->will($this->returnValue($gitWorkingCopy));

        $gitWorkingCopy
            ->expects($this->once())
            ->method('commit')
            ->with($this->equalTo('CS Fixes'))
            ->will($this->returnValue($gitWorkingCopy));

        $gitWorkingCopy
            ->expects($this->once())
            ->method('push')
            ->with($this->equalTo('origin'), $this->equalTo('cs_fixer'))
            ->will($this->returnValue('error: some error'));

        $command = new CommitAndPush();
        $command->initGit($gitWorkingCopy);

        $this->assertFalse($command->execute($package));
    }
}
