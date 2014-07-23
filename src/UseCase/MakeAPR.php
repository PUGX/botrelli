<?php

namespace PUGX\Bot\UseCase;

use PUGX\Bot\LocalPackage;
use PUGX\Bot\Message\MessageRepositoryInterface;

class MakeAPR
{
    const PREFIX = <<< EOF
| Q             | A
| ------------- | ---
| Bug fix?      | no
| New feature?  | no
| BC breaks?    | no
| Deprecations? | no
| Tests pass?   | yes
| Fixed tickets |
| License       | MIT
| Doc PR        |
EOF;

    private $messageRepository;

    function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function execute(LocalPackage $package)
    {
        $message = (string)$this->messageRepository->fetch();

        return false;
    }

    private function getPrefixCommitMessage()
    {
        return self::PREFIX;
    }

    private function getCommitTitle()
    {
        return '[CS] Coding Standard fixed';
    }
} 