<?php

namespace PUGX\Bot\PullRequest\UseCase;

use PUGX\Bot\PullRequest\PullRequestRepositoryReaderInterface;

class GetLatestPullRequests
{
    private $repository;

    function __construct(PullRequestRepositoryReaderInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getLatestPullRequest()
    {
        return $this->repository->getAllDesc();
    }
} 