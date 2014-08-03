<?php

namespace PUGX\Bot\Package;

interface PackageRepositoryInterface
{
    public function getAllPackages();
    public function get($package);
}
