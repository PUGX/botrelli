<?php

namespace PUGX\Bot\Infrastructure;

use PUGX\Bot\Message\Message;
use \PUGX\Bot\Message\MessageRepositoryInterface;

class FunnyMessageRepository implements MessageRepositoryInterface
{
    /**
     * @return Message
     *
     * @throws \Exception
     */
    public function fetch()
    {
        throw new \Exception('Missing funny message');
    }
} 