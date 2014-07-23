<?php

namespace PUGX\Bot\Tests\Package;

use \PUGX\Bot\Package\PackageRepository;

class PackageRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGetAValidPackage()
    {
        $this->markTestIncomplete();

        $provider = $this->getMock('\PUGX\Bot\Package\ProviderInterface');
        $packageRepository = new PackageRepository($provider);

        $this->assertInstanceOf('\Packagist\Api\Result\Package', $packageRepository->getANeverVisitedPackage());
    }
}
