<?php

namespace PUGX\Bot\UseCase;

use PUGX\Bot\Package;

class ForkPackage
{
    private $client;

    public function  __construct($client)
    {
        $this->client = $client;
    }

    public function execute(Package $package)
    {
        return $this->client->api('repo')->forks()->create($package->getUsername(), $package->getRepoName());
    }
} 