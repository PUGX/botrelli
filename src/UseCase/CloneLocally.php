<?php

namespace PUGX\Bot\UseCase;

use GitWrapper\GitWrapper;
use PUGX\Bot\LocalPackage;
use Packagist\Api\Result\Package;

class CloneLocally
{
    /**
     * @var GitWrapper $gitWrapper
     */
    private $gitWrapper;

    /**
     * @param GitWrapper $gitWrapper
     */
    public function __construct(GitWrapper $gitWrapper)
    {
        $this->gitWrapper = $gitWrapper;
    }

    /**
     * @param Package $package
     * @param $dir
     *
     * @return LocalPackage
     */
    public function execute(Package $package, $dir)
    {
       $this->gitWrapper->cloneRepository($package->getRepository(), $dir);

       return new LocalPackage($dir, $package);
    }
}
