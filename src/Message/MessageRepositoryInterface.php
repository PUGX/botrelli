<?php
namespace PUGX\Bot\Message;


interface MessageRepositoryInterface
{
    /**
     * @return Message
     *
     * @throws \Exception
     */
    public function fetch();
} 