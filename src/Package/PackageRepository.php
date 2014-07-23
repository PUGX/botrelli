<?php
namespace PUGX\Bot\Package;


class PackageRepository
{
    /** @var ProviderInterface */
    private $provider;

    function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function getANeverVisitedPackage()
    {
        throw new \Exception('Not Implemented');
    }
} 