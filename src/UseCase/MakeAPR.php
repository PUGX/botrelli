<?php

namespace PUGX\Bot\UseCase;

use PUGX\Bot\LocalPackage;
use PUGX\Bot\Message\MessageRepositoryInterface;

class MakeAPR
{
    private $messageRepository;

    function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function execute(LocalPackage $package)
    {
        $message =  (string) $this->messageRepository->fetch();

        return false;
    }
} 