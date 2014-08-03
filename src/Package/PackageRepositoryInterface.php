<?php

namespace PUGX\Bot\Package;

use PUGX\Bot\Package;

interface PackageRepositoryInterface
{
    public function get($package);
    public function add(Package $package);
}
