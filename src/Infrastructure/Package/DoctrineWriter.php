<?php

namespace PUGX\Bot\Infrastructure\Package;

use Doctrine\Common\Persistence\ObjectManager;
use PUGX\Bot\Package;

class DoctrineWriter implements Package\PackageWriterInterface
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
