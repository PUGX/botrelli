<?php

namespace PUGX\Bot\Service;

use PUGX\Bot\Package\PackageRepositoryInterface;

class GetRandomPackage
{
    private $repository;

    public function __construct(PackageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getRandomPackage()
    {
        $this->allPackages = $this->repository->getAllPackages();
        $packageName = $this->allPackages[array_rand($this->allPackages)];

        return $this->repository->get($packageName);
    }
}
