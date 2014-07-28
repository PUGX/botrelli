<?php

namespace PUGX\Bot\Package;

use PUGX\Bot\Package;

class PackageRepository
{
    /** @var ProviderInterface */
    private $provider;

    function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

//    public function getANeverVisitedPackage()
//    {
//        return $this->provider->getANeverVisitedPackage();
//    }

    public function getPackage($repository)
    {
        $repo = $this->provider->get($repository);

        if (!$repo) {
            throw new \Exception('Repository name not valid');
        }

        $repo = Package::createFromPackage($repo);

        return $repo;
    }
} 