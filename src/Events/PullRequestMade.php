<?php

namespace PUGX\Bot\Events;

use Symfony\Component\EventDispatcher\Event;

class PullRequestMade extends Event
{
    private $repositoryName;
    private $repositoryURL;
    private $URL;
    private $status;
    private $number;
    private $funnyMessage;
    private $localPath;
    private $avatarUrl;

    public function __construct($number, $repositoryName, $URL, $funnyMessage, $repositoryURL, $status, $localPath, $avatarUrl)
    {
        $this->URL = $URL;
        $this->funnyMessage = $funnyMessage;
        $this->number = $number;
        $this->repositoryName = $repositoryName;
        $this->repositoryURL = $repositoryURL;
        $this->status = $status;
        $this->localPath = $localPath;
        $this->avatarUrl = $avatarUrl;
    }


    public static function createFromGithubResponse($array, $funnyMessage, $localPath)
    {
        $repositoryName = $array['base']['repo']['full_name'];
        $repositoryURL = $array['base']['repo']['html_url'];
        $URL = $array['html_url'];
        $status = $array['state'];
        $number = $array['number'];
        $avatarUrl = $array['base']['user']['avatar_url'];

        return new self($number, $repositoryName, $URL, $funnyMessage, $repositoryURL, $status, $localPath, $avatarUrl);
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

    /**
     * @return mixed
     */
    public function getLocalPath()
    {
        return $this->localPath;
    }

    /**
     * @return mixed
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

}