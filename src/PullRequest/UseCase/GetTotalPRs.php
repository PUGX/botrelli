<?php

namespace PUGX\Bot\PullRequest\UseCase;

use PUGX\Bot\PullRequest\PullRequestRepositoryReaderInterface;

class GetTotalPRs
{
    private $repository;

    public function __construct(PullRequestRepositoryReaderInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getTotalPR()
    {
        return $this->repository->countPRMade();
    }
}
