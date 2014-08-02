<?php

namespace PUGX\Bot\PullRequest\Listener;

use PUGX\Bot\Events\PullRequestMade;
use PUGX\Bot\PullRequest\PullRequest;
use PUGX\Bot\PullRequest\PullRequestRepositoryWriterInterface;

class PullRequestListener
{
    private $repository;

    function __construct(PullRequestRepositoryWriterInterface $repository)
    {
        $this->repository = $repository;
    }

    public function onPullRequestMade(PullRequestMade $event)
    {
        $pullRequest = PullRequest::createFromPREvent($event);

        $this->incrementNumberOfPRMade();

        $this->repository->save($pullRequest);
    }

    private function incrementNumberOfPRMade()
    {
        $this->repository->incrementNumberOfPRMade();
    }
} 