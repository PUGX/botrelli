<?php

namespace PUGX\Bot\UseCase;

use Packagist\Api\Result\Package;

class ForkPackage
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function execute(Package $package)
    {
        return false;
    }
} 