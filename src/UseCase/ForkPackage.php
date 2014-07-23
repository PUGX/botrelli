<?php

namespace PUGX\Bot\UseCase;

use Packagist\Api\Result\Package;

class ForkPackage
{
    public function execute(Package $package)
    {
        return false;
    }
} 