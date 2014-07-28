<?php

namespace PUGX\Bot\Tests\UseCase;

use PUGX\Bot\Package;
use PUGX\Bot\UseCase\ForkPackage;

class ForkPackageTest extends BaseTestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToForkAPackage()
    {
        $package      = $this->getMockedPackage();
        $githubClient = $this->prepareMockedGithubClient($package);
        $command      = new ForkPackage($githubClient, $this->eventDispatcher);

        $command->execute($package);
    }

    private function getMockedGitHubClient()
    {
        $client = $this->getMockBuilder('\Github\Client')
                       ->disableOriginalConstructor()
                       ->getMock();

        return $client;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockedPackage()
    {
        $package = $this->getMockBuilder('\PUGX\Bot\Package')
                        ->disableOriginalConstructor()
                        ->getMock();

        $package->expects($this->any())
                ->method('getUsername')
                ->will($this->returnValue('jdoe'));

        $package->expects($this->any())
                ->method('getRepoName')
                ->will($this->returnValue('PHPRockStars/SuperFantasticRepo'));

        return $package;
    }

    /**
     * @param $package
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function prepareMockedGithubClient($package)
    {
        $githubClient = $this->getMockedGitHubClient();

        $githubRepo = $this->getMockBuilder('\Github\Api\Repo')
                           ->disableOriginalConstructor()
                           ->getMock();

        $githubClient->expects($this->once())
                     ->method('api')
                     ->with('repo')
                     ->will($this->returnValue($githubRepo));

        $githubFork = $this->getMockBuilder('\Github\Api\Repository\Forks')
                           ->disableOriginalConstructor()
                           ->getMock();

        $githubRepo->expects($this->once())
                   ->method('forks')
                   ->will($this->returnValue($githubFork));

        $githubFork->expects($this->once())
                   ->method('create')
                   ->with($package->getUsername(), $package->getRepoName())
                   ->will($this->returnValue('{ "aValid": "json"}'));

        return $githubClient;
    }
}
