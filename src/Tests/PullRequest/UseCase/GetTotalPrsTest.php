<?php

namespace PUGX\Bot\Tests\PullRequest\UseCase;

use PUGX\Bot\PullRequest\UseCase\GetTotalPRs;

class GetTotalPrsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldHaveTheLatestPr()
    {
        $repository = $this->getMock('\PUGX\Bot\PullRequest\PullRequestRepositoryReaderInterface');

        $repository
            ->expects($this->once())
            ->method('countPRMade')
            ->will($this->returnValue(1));

        $pr = new GetTotalPRs($repository);

        $this->assertEquals(1, $pr->getTotalPR());
    }
}
