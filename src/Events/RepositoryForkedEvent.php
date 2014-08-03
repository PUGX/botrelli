<?php

namespace PUGX\Bot\Events;

use Symfony\Component\EventDispatcher\Event;

class RepositoryForkedEvent extends Event
{
    private $fork;

    public function __construct($fork)
    {
        $this->fork = $fork;
    }
}
