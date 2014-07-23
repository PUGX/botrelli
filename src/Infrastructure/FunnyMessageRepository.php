<?php

namespace PUGX\Bot\Infrastructure;

use PUGX\Bot\Message\Message;
use \PUGX\Bot\Message\MessageRepositoryInterface;

class FunnyMessageRepository implements MessageRepositoryInterface
{

    private $messages = array();

    public function __construct()
    {
        $messages[] = "D'oh!";
        $messages[] = "This is nearly perfect, now!";
        $messages[] = "Spring cleaning...";
        $messages[] = "Details make perfection, and perfection is not a detail (Leonardo Da Vinci)";
        $messages[] = "No thanks needed, dude!";
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