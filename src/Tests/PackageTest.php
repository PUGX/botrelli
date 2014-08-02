<?php

namespace PUGX\Bot\Tests;

use PUGX\Bot\Package;

class PackageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGetUsernameFromPackage()
    {
        $package = new Package();
        $package->fromArray(array('name' => 'pugX/botRelli'));
        $this->assertEquals('pugX', $package->getUsername());
    }

    /**
     * @test
     */
    public function shouldGetRepoNameFromPackage()
    {
        $package = new Package();
        $package->fromArray(array('name' => 'pugX/botRelli'));
        $this->assertEquals('botRelli', $package->getRepoName());
    }
}
