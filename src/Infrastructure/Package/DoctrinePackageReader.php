<?php

namespace PUGX\Bot\Infrastructure\Package;

use Doctrine\Common\Persistence\ObjectRepository;
use PUGX\Bot\Package\PackageReaderInterface;

class DoctrinePackageReader implements PackageReaderInterface
{
    private $repository;

    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getANeverVisitedPackage()
    {
        return $this->repository->findBy(array('visited' => false), array('name' => 'ASC'), 1);
    }

    function get($package)
    {
        return $this->repository->find($package);
    }
} 