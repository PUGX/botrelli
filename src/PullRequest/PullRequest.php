<?php

namespace PUGX\Bot\PullRequest;

use PUGX\Bot\Events\PullRequestMade;

class PullRequest
{
    protected $repositoryName;
    protected $repositoryURL;
    protected $URL;
    protected $status;
    protected $number;
    protected $funnyMessage;
    protected $avatarUrl;

    public function __construct($number, $repositoryName, $URL, $funnyMessage, $repositoryURL, $status, $avatarUrl)
    {
        $this->URL = $URL;
        $this->funnyMessage = $funnyMessage;
        $this->number = $number;
        $this->repositoryName = $repositoryName;
        $this->repositoryURL = $repositoryURL;
        $this->status = $status;
        $this->avatarUrl = $avatarUrl;
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
        return new self($event->getNumber(), $event->getRepositoryName(), $event->getURL(), $event->getFunnyMessage(), $event->getRepositoryURL(), $event->getStatus(), $event->getAvatarUrl());
    }

    /**
     * @return mixed
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * @return mixed
     */
    public function getFunnyMessage()
    {
        return $this->funnyMessage;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getRepositoryName()
    {
        return $this->repositoryName;
    }

    /**
     * @return mixed
     */
    public function getRepositoryURL()
    {
        return $this->repositoryURL;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }
}
