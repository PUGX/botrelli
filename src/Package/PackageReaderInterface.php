<?php

namespace PUGX\Bot\Package;

interface PackageReaderInterface
{
    public function get($package);
    public function getANotVisitedRecentlyPackage();
}
