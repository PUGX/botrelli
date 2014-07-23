<?php

namespace PUGX\Bot\UseCase;

use Packagist\Api\Client;
use PUGX\Bot\Package\ProviderInterface;

class PullPackagistList
{
    private $packagistClient;
    private $provider;

    public function __construct(Client $packagistClient, ProviderInterface $provider)
    {
        $this->packagistClient = $packagistClient;
        $this->provider = $provider;
    }

    public function execute()
    {
        $packages = $this->packagistClient->all();

        return $this->provider->setAllPackages($packages);
    }
} 