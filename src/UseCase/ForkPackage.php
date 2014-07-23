<?php

namespace PUGX\Bot\UseCase;

use Packagist\Api\Result\Package;

class ForkPackage
{
    private $client;

    public function  __construct($client)
    {
        $this->client = $client;
    }

    public function execute(Package $package)
    {
        $repository = $this->client->api('repo')->forks()->create($package->getName(), $package->get);
        return false;
    }
} 