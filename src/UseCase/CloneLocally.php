<?php

namespace PUGX\Bot\UseCase;

use PUGX\Bot\LocalPackage;
use Packagist\Api\Result\Package;

class CloneLocally
{
    /**
     * @param Package $package
     * @param $dir
     *
     * @return LocalPackage
     */
    public function execute(Package $package, $dir)
    {
        return false;
    }
} 