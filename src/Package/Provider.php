<?php

namespace PUGX\Bot\Package;

class Provider implements ProviderInterface
{
//    private $writer;
    private $reader;

    public function __construct(/*PackageWriterInterface $writer, */PackageReaderInterface $reader)
    {
//        $this->writer = $writer;
        $this->reader = $reader;
    }

//    public function getAllPackages()
//    {
//        // TODO: Implement getAllPackages() method.
//    }
//
//    public function setAllPackages()
//    {
//        // TODO: Implement setAllPackages() method.
//    }
//
//    public function getANeverVisitedPackage()
//    {
//       return $this->reader->getANeverVisitedPackage();
//    }

    public function get($package)
    {
        return $this->reader->get($package);
    }
} 