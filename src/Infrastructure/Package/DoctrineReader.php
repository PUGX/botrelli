<?php

namespace PUGX\Bot\Infrastructure\Package;

use Doctrine\Common\Persistence\ObjectRepository;
use PUGX\Bot\Package\PackageReaderInterface;

class DoctrineReader implements PackageReaderInterface
{
    private $repository;

    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getANotVisitedRecentlyPackage()
    {
        $packages = $this->repository->findBy(array('blacklisted' => false), array('visited' => 'ASC', 'lastVisited' => 'ASC', 'name' => 'ASC'), 1);
        return count($packages) ? $packages[0]: null;
    }

    public function get($package)
    {
        return $this->repository->findOneBy(array('name' => $package));
    }
}
