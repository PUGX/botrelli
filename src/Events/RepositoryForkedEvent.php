<?php

namespace PUGX\Bot\Events;

use Symfony\Component\EventDispatcher\Event;

class RepositoryForkedEvent extends Event
{
    private $fork;

    function __construct($fork)
    {
        $this->fork = $fork;
    }
} 