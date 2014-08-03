<?php

namespace PUGX\Bot\Infrastructure\Package;

use PUGX\Bot\Package\PackageRepositoryInterface;
use Packagist\Api\Client;
use PUGX\Bot\Package;

class PackagistRepository implements PackageRepositoryInterface
{
    private $client;

    public function __construct($client = null)
    {
        $this->client = $client;

        if (null === $this->client) {
            $this->client = new Client();
        }
    }

    /**
     * Fetch a Package from Packagist, given it's name.
     *
     * @param $package
     *
     * @return Package
     *
     * @throws \Exception
     */
    public function get($package)
    {
        $repo = $this->client->get($package);

        if (!($repo instanceof \Packagist\Api\Result\Package)) {
            throw new \Exception('Repository name not valid');
        }

        return $this->createPackage($repo);
    }

    public function getAllPackages()
    {
        return $this->client->all();
    }

    private function createPackage($apiPackage)
    {
       return Package::createFromAPIPackage($apiPackage);
    }
}
