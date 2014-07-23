<?php
namespace PUGX\Bot\Tests\Package;

use Packagist\Api\Result\Package;

use PUGX\Bot\LocalPackage;
use PUGX\Bot\UseCase\CloneLocally;

class CloneLocallyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToCloneLocally()
    {
        $repoName  = "git://github.com/cpliakas/git-wrapper.git";
        $localPath = "/path/to/working/copy";

        $gitWrapper= $this->getMockBuilder('\GitWrapper\GitWrapper')
                          ->disableOriginalConstructor()
                          ->getMock();

        $package = $this->getMockBuilder('PUGX\Bot\Package')
            ->disableOriginalConstructor()
            ->getMock();

        $gitWrapper->expects($this->once())
                   ->method('cloneRepository')
                   ->with($repoName, $localPath)
                   ->will($this->returnValue(new LocalPackage(null, $package)));

        $package->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($repoName));

        $command = new CloneLocally($gitWrapper);

        $this->assertInstanceOf('\PUGX\Bot\LocalPackage', $command->execute($package, $localPath));
    }
}
