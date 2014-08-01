<?php

namespace PUGX\Bot\Tests\Infrastructure;

use PUGX\Bot\Infrastructure\RedisPullRequestRepository;
use PUGX\Bot\PullRequest\PullRequest;

class RedisPullRequestRepositoryTest extends \PHPUnit_Framework_TestCase
{
    private $repository;

    public function setUp()
    {
        if (!class_exists('\Predis\Client')) {
            $this->markTestSkipped('Redis class not found');
        }

        $redis = new \Predis\Client();
        $this->repository = new RedisPullRequestRepository($redis);
    }

    /**
     * @test
     */
    public function shouldIncrementAndCountTheNumberOfPRMade()
    {
        $count = $this->repository->countPRMade();
        $this->repository->incrementNumberOfPRMade();

        $this->assertGreaterThan($count, $this->repository->countPRMade());
    }

    /**
     * @test
     */
    public function shouldSaveAndGetAllPR()
    {
        $pr = new PullRequest(1,2,3,4,5,6);

        $this->repository->save($pr);
        $all = $this->repository->getAllDesc();

        $this->assertTrue(in_array($pr, $all));
    }
}
