<?php

namespace PUGX\Bot\PullRequest\Listener;

use PUGX\Bot\Events\PullRequestMade;
use PUGX\Bot\PullRequest\PullRequest;
use PUGX\Bot\PullRequest\PullRequestRepositoryWriterInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;

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

        $this->deleteFolder($event->getLocalPath());
    }

    private function incrementNumberOfPRMade()
    {
        $this->repository->incrementNumberOfPRMade();
    }

    private function deleteFolder($folder)
    {
        $fs = new Filesystem();

        $fs->remove($folder);
    }
} 