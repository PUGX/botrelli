<?php

namespace PUGX\Bot\Infrastructure;

use PUGX\Bot\Message\Message;
use \PUGX\Bot\Message\MessageRepositoryInterface;

class FunnyMessageRepository implements MessageRepositoryInterface
{

    private $messages = array();

    public function __construct()
    {
        $messages[] = New Message("D'oh!");
        $messages[] = New Message("This is nearly perfect, now!");
        $messages[] = New Message("Spring cleaning...");
        $messages[] = New Message("Details make perfection, and perfection is not a detail (Leonardo Da Vinci)");
        $messages[] = New Message("No thanks needed, dude!");
        $messages[] = New Message("They call me PSR-Nazi.");
        $this->messages = $messages;
    }

    /**
     * @return Message
     *
     * @throws \Exception
     */
    public function fetch()
    {
       $i = rand(0, sizeof($this->messages)-1);
       return $this->messages[$i];
    }

}