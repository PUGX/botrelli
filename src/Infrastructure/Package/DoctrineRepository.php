<?php

namespace PUGX\Bot\Infrastructure\Package;

use PUGX\Bot\Package;

class DoctrineRepository extends AbstractRepository
{
    /**
     * @var \PUGX\Bot\Package\PackageReaderInterface
     */
    private $reader;

    /**
     * @var \PUGX\Bot\Package\PackageWriterInterface
     */
    private $writer;

    public function __construct(Package\PackageReaderInterface $reader, Package\PackageWriterInterface $writer)
    {
        $this->reader = $reader;
        $this->writer = $writer;
    }

    /**
     * Fetch a Package from Doctrine, given it's name.
     *
     * @param $package
     *
     * @return Package
     *
     * @throws \Exception
     */
    public function get($packageName)
    {
        $package = $this->reader->get($packageName);

        if (!($package instanceof \Packagist\Api\Result\Package)) {
            return null;
        }

        return $this->createPackage($package);
    }

    public function getANotVisitedRecentlyPackage()
    {
        return $this->reader->getANotVisitedRecentlyPackage();
    }

    public function add(Package $package)
    {
        $this->writer->write($package);
    }
}
