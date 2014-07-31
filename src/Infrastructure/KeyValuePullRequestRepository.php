<?php

namespace PUGX\Bot\Infrastructure;

use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Cache\CacheProvider;
use PUGX\Bot\PullRequest\PullRequest;
use PUGX\Bot\PullRequest\PullRequestRepositoryWriterInterface;
use PUGX\Bot\PullRequest\PullRequestRepositoryReaderInterface;

class KeyValuePullRequestRepository implements PullRequestRepositoryReaderInterface, PullRequestRepositoryWriterInterface
{
    private $provider;

    public function __construct(CacheProvider $provider = null)
    {
        $this->provider = $provider;
        if (null === $this->provider) {
            $this->provider = new FilesystemCache(sys_get_temp_dir());
        }
    }

    public function getOpened()
    {
        // TODO: Implement getOpened() method.
    }

    public function getAllDesc()
    {
        // TODO: Implement getAllDesc() method.
    }

    public function countPRMade()
    {
        // TODO: Implement countPRMade() method.
    }

    public function save(PullRequest $pullRequest)
    {

    }

    public function incrementNumberOfPRMade()
    {
        // TODO: Implement incrementNumberOfPRMade() method.
    }


}