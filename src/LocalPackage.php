<?php

namespace PUGX\Bot;

use Packagist\Api\Result\Package;
use Packagist\Api\Result\AbstractResult;

class LocalPackage extends AbstractResult
{
    protected $folder;
    protected $package;

    function __construct($folder, Package $package)
    {
        $this->folder = $folder;
        $this->package = $package;
    }

    public function getName()
    {
        return $this->package->name;
    }

    public function getDescription()
    {
        return $this->package->description;
    }

    public function getTime()
    {
        return $this->package->time;
    }

    public function getMaintainers()
    {
        return $this->package->maintainers;
    }

    public function getVersions()
    {
        return $this->package->versions;
    }

    public function getType()
    {
        return $this->package->type;
    }

    public function getRepository()
    {
        return $this->package->repository;
    }

    public function getDownloads()
    {
        return $this->package->downloads;
    }

    public function getFavers()
    {
        return $this->package->favers;
    }

}