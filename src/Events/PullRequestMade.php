<?php

namespace PUGX\Bot\Events;

use Symfony\Component\EventDispatcher\Event;

class PullRequestMade extends Event
{
    private $response;

    function __construct($response)
    {
        $this->response = $response;
    }
} 