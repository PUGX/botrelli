<?php

namespace PUGX\Bot\Infrastructure;

use PUGX\Bot\PullRequest\PullRequest;
use PUGX\Bot\PullRequest\PullRequestRepositoryWriterInterface;
use PUGX\Bot\PullRequest\PullRequestRepositoryReaderInterface;

class RedisPullRequestRepository implements PullRequestRepositoryReaderInterface, PullRequestRepositoryWriterInterface
{
    private $redis;
    const COUNT_PR = 'COUNTER_PR';
    const PR = 'PR';

    public function __construct($redis)
    {
        $this->redis = $redis;
    }

    public function getOpened()
    {
        return $this->getAllDesc();
    }

    public function getAllDesc()
    {
        return array_map(function($item) {
                return unserialize($item);
            },
            $this->redis->lrange(self::PR, 0, -1)
        );
    }

    public function countPRMade()
    {
        return $this->redis->get(self::COUNT_PR);
    }

    public function save(PullRequest $pullRequest)
    {
        $this->redis->lpush(self::PR, serialize($pullRequest));
    }

    public function incrementNumberOfPRMade()
    {
        $this->redis->incr(self::COUNT_PR);
    }
}