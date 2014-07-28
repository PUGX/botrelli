<?php

namespace PUGX\Bot\Tests\UseCase;

use Packagist\Api\Result\Package;

use PUGX\Bot\LocalPackage;
use PUGX\Bot\UseCase\CloneLocally;

class CloneLocallyTest extends BaseTestCase
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

        $git= $this->getMockBuilder('\GitWrapper\GitWorkingCopy')
            ->disableOriginalConstructor()
            ->getMock();

        $git->expects($this->any())
            ->method('config')
            ->will($this->returnValue($git));

        $package = $this->getMockBuilder('PUGX\Bot\Package')
            ->disableOriginalConstructor()
            ->getMock();

        $localPackage = new LocalPackage(null, $localPath, $package);

        $gitWrapper->expects($this->once())
                   ->method('cloneRepository')
                   ->will($this->returnValue($git));

        $package->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($repoName));

        $command = new CloneLocally($gitWrapper, $this->mockEventDispatcher());

        $this->assertNotFalse($command->execute($localPackage));
    }
}
