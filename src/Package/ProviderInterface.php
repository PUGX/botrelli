<?php

namespace PUGX\Bot\Package;


interface ProviderInterface
{
//    public function getAllPackages();
//    public function setAllPackages();
//    public function getANeverVisitedPackage();
    public function get($package);
}