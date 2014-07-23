<?php

namespace PUGX\Bot\Package;

use Doctrine\Common\Persistence\ObjectRepository;

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

} 