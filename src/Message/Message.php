<?php

namespace PUGX\Bot\Message;


class Message
{

    private $text;

    function __construct($text)
    {
        $this->text = $text;
    }

    public function __toString()
    {
        return (string)$this->text;
    }

} 