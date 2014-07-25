<?php

namespace PUGX\Bot\UseCase;

use Github\Api\Repo;
use PUGX\Bot\Package;
use Github\Client;

class ForkPackage
{
    /**
     * @var \Github\Client $client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function  __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param Package $package
     *
     * @return \Guzzle\Http\EntityBodyInterface|mixed|string
     */
    public function execute(Package $package)
    {
        /** @var Repo $githubRepository */
        $githubRepository = $this->client->api('repo');

        return $githubRepository->forks()
            ->create($package->getUsername(), $package->getRepoName());
    }
}
