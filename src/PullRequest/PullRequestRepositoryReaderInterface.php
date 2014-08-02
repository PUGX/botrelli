<?php

namespace PUGX\Bot\PullRequest;

interface PullRequestRepositoryReaderInterface
{
    public function getOpened();
    public function getAllDesc();
    public function countPRMade();
}
