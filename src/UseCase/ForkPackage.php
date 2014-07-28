<?php

namespace PUGX\Bot\UseCase;

use Github\Api\Repo;
use PUGX\Bot\Package;
use Github\Client;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use PUGX\Bot\Events\StepsEvents;
use PUGX\Bot\Events\RepositoryForkedEvent;

class ForkPackage extends DispatcherUseCase
{
    /**
     * @var \Github\Client $client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function  __construct(Client $client, EventDispatcherInterface $dispatcher)
    {
        parent::__construct($dispatcher);
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

        $fork = $githubRepository->forks()
            ->create($package->getUsername(), $package->getRepoName());

        $this->dispatchEvent(StepsEvents::REPOSITORY_FORKED, new RepositoryForkedEvent($fork));

        return $fork;
    }
}
