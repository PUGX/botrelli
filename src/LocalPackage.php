<?php

namespace PUGX\Bot;

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
        return $this->package->getName();
    }

    public function getDescription()
    {
        return $this->package->getDescription();
    }

    public function getTime()
    {
        return $this->package->getTime();
    }

    public function getMaintainers()
    {
        return $this->package->getMaintainers();
    }

    public function getVersions()
    {
        return $this->package->getVersions();
    }

    public function getType()
    {
        return $this->package->getType();
    }

    public function getRepository()
    {
        return $this->package->getRepository();
    }

    public function getDownloads()
    {
        return $this->package->getDownloads();
    }

    public function getFavers()
    {
        return $this->package->getFavers();
    }

    public function getUsername()
    {
        return $this->package->getUsername();
    }

    /**
     * @return mixed
     */
    public function getRepoName()
    {
        return $this->package->getRepoName();
    }

    /**
     * @return string
     */
    public function getFolder()
    {
        return $this->folder;
    }

}