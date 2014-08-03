<?php

namespace PUGX\Bot\Tests\PullRequest\UseCase;

use PUGX\Bot\PullRequest\UseCase\GetLatestPullRequests;

class GetLatestPullRequestsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldHaveTheLatestPr()
    {
        $repository = $this->getMock('\PUGX\Bot\PullRequest\PullRequestRepositoryReaderInterface');

        $repository
            ->expects($this->once())
            ->method('getAllDesc')
            ->will($this->returnValue(array(1)));

        $pr = new GetLatestPullRequests($repository);

        $this->assertEquals(array(1), $pr->getLatestPullRequest());
    }
}
