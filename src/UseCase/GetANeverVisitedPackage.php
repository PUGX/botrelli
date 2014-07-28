<?php

namespace PUGX\Bot\UseCase;

use PUGX\Bot\Package\PackageRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class GetANeverVisitedPackage extends DispatcherUseCase
{
    private $repository;

    public function __construct(PackageRepository $repository, EventDispatcherInterface $dispatcher)
    {
        parent::__construct($dispatcher);
        $this->repository = $repository;
    }

    public function execute()
    {
        return $this->repository->getANeverVisitedPackage();
    }
} 