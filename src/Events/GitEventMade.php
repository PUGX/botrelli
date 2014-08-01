<?php

namespace PUGX\Bot\Events;

use Symfony\Component\EventDispatcher\Event;
use GitWrapper\GitWorkingCopy;

class GitEventMade extends Event
{
    private $gitWorkingCopy;

    public function __construct(GitWorkingCopy $gitWorkingCopy)
    {
        $this->gitWorkingCopy = $gitWorkingCopy;
    }

    public function __toString()
    {
        return (string) $this->gitWorkingCopy->getOutput();
    }
} 