<?php

namespace PUGX\Bot\PullRequest;

interface PullRequestRepositoryWriterInterface
{
    public function save(PullRequest $pullRequest);
    public function incrementNumberOfPRMade();
}
