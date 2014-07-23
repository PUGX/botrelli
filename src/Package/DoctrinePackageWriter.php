<?php

namespace PUGX\Bot\Package;

use Doctrine\Common\Persistence\ObjectManager;
use PUGX\Bot\Package;

class DoctrinePackageWriter implements PackageWriterInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function write(Package $package)
    {
        $this->manager->persist($package);
        $this->manager->flush($package);
    }

} 