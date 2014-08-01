<?php

namespace PUGX\Bot\Service;

use PUGX\Bot\Package\PackageRepositoryInterface;


class GetANeverVisitedPackage
{
    private $repository;

    public function __construct(PackageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getANeverVisitedPackage()
    {
        $all = $this->repository->getAllPackages();

        // @todo some magic here...
        $this->allPackages = $this->repository->getAllPackages();

        return $this->allPackages[array_rand($this->allPackages)];
    }
} 