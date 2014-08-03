<?php

namespace PUGX\Bot\Infrastructure\Package;

use PUGX\Bot\Package;

abstract class AbstractRepository implements Package\PackageRepositoryInterface
{
    protected function createPackage($apiPackage)
    {
        return Package::createFromAPIPackage($apiPackage);
    }
}
