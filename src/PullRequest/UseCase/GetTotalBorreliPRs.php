<?php

namespace PUGX\Bot\PullRequest\UseCase;

class GetTotalBorreliPRs
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getTotalPR()
    {
        return $this->value;
    }
}
