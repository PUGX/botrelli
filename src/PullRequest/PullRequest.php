<?php

namespace PUGX\Bot\PullRequest;

use PUGX\Bot\Events\PullRequestMade;

class PullRequest
{
    private $repositoryName;
    private $repositoryURL;
    private $URL;
    private $status;
    private $number;
    private $funnyMessage;

    private function __construct($number, $repositoryName, $URL, $funnyMessage, $repositoryURL, $status)
    {
        $this->URL = $URL;
        $this->funnyMessage = $funnyMessage;
        $this->number = $number;
        $this->repositoryName = $repositoryName;
        $this->repositoryURL = $repositoryURL;
        $this->status = $status;
    }

    public function changeStatus($status)
    {
        $this->status = $status;
    }

    public function getIdentity()
    {
        return sprintf('%s#%d', $this->repositoryName, $this->number);
    }

    public static function createFromPREvent(PullRequestMade $event)
    {
        return new self($event->getNumber(), $event->getRepositoryName(), $event->getURL(), $event->getFunnyMessage(), $event->getRepositoryURL(), $event->getStatus());
    }
}