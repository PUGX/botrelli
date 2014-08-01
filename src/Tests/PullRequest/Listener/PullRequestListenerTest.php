<?php

namespace PUGX\Bot\Tests\PullRequest\Listener;

use PUGX\Bot\PullRequest\Listener\PullRequestListener;

class PullRequestListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldSaveAndIncrementTheNumberOfPR()
    {
        $repository = $this->getMock('\PUGX\Bot\PullRequest\PullRequestRepositoryWriterInterface');

        $repository
            ->expects($this->once())
            ->method('incrementNumberOfPRMade')
            ->will($this->returnValue(true));

        $repository
            ->expects($this->once())
            ->method('save')
            ->will($this->returnValue(true));

        $pr = new PullRequestListener($repository);

        $event = $this->getMockBuilder('\PUGX\Bot\Events\PullRequestMade')
            ->disableOriginalConstructor()
            ->getMock();

        $pr->onPullRequestMade($event);
    }
} 