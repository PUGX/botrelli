<?php

namespace PUGX\Bot\UseCase;

use PUGX\Bot\Package\PackageRepository;

class GetANeverVisitedPackage
{
    private $repository;

    public function __construct(PackageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute()
    {
        return $this->repository->getANeverVisitedPackage();
    }
} 