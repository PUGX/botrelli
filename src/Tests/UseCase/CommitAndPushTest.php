<?php

namespace PUGX\Bot\Tests\UseCase;

use PUGX\Bot\Package;
use PUGX\Bot\LocalPackage;
use PUGX\Bot\UseCase\CommitAndPush;

class CommitAndPushTest extends BaseTestCase
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

        $command = new CommitAndPush($this->mockEventDispatcher());

        $this->assertTrue($command->execute($gitWorkingCopy, $package));
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
            ->with($this->equalTo('origin'), $this->equalTo('cs_fixer'));

        $gitWorkingCopy
            ->expects($this->once())
            ->method('getStatus')
            ->will($this->returnValue('something'));

        $command = new CommitAndPush($this->mockEventDispatcher());

        $this->assertFalse($command->execute($gitWorkingCopy, $package));
    }
}
