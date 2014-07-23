<?php

namespace PUGX\Bot\Tests\Package;

use PUGX\Bot\Package;
use PUGX\Bot\LocalPackage;
use PUGX\Bot\UseCase\MakeAPR;

class MakeAPRTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToMakeAPR()
    {
        $package = $this->getMock('\PUGX\Bot\Package');
        $package
            ->expects($this->once())
            ->method('getUsername')
            ->will($this->returnValue('pugx'));
        $package
            ->expects($this->once())
            ->method('getRepoName')
            ->will($this->returnValue('botrelli'));
        $localPackage = new LocalPackage('/tmp', $package);

        $messageRepository = $this->getMock('\PUGX\Bot\Message\MessageRepositoryInterface');
        $messageRepository
            ->expects($this->once())
            ->method('fetch')
            ->will($this->returnValue('A funny message'));

        $pullRequest = $this->getMockBuilder('\Github\Api\PullRequest')
            ->disableOriginalConstructor()
            ->getMock();
        $pullRequest
            ->expects($this->once())
            ->method('create')
            ->with($this->equalTo('pugx'),
                $this->equalTo('botrelli'),
                $this->equalTo(array('base' => 'master', 'head' => 'master', 'title' => 'CS Fixes', 'body' => 'A funny message')));

        $response = $this->getMockBuilder('\Guzzle\Http\Message\Response')
            ->disableOriginalConstructor()
            ->getMock();
        $response
            ->expects($this->once())
            ->method('getStatusCode')
            ->will($this->returnValue(201));

        $httpClient = $this->getMock('\Github\HttpClient\HttpClient');
        $httpClient
            ->expects($this->once())
            ->method('getLastResponse')
            ->will($this->returnValue($response));

        $client = $this->getMock('\Github\Client');
        $client
            ->expects($this->once())
            ->method('api')
            ->with($this->equalTo('pull_request'))
            ->will($this->returnValue($pullRequest));

        $client
            ->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($httpClient));

        $command = new MakeAPR($client, $messageRepository);

        $this->assertTrue($command->execute($localPackage));
    }
}
