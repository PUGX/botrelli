<?php

namespace PUGX\Bot\Tests\UseCase;

use PUGX\Bot\Package;
use PUGX\Bot\LocalPackage;
use PUGX\Bot\UseCase\MakeAPR;

class MakeAPRTest extends BaseTestCase
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
        $localPackage = new LocalPackage(null, '/tmp', $package);

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
                $this->equalTo(array('base' => 'master',
                        'head' => 'botrelli:cs_fixer',
                        'title' => '[CS] Coding Standard fixes',
                        'body' => '| Q             | A
| ------------- | ---
| Bug fix?      | no
| New feature?  | no
| BC breaks?    | no
| Deprecations? | no
| Tests pass?   | yes
| Fixed tickets |
| License       | MIT
| Doc PR        |

A funny message')));

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

        $command = new MakeAPR($client, $messageRepository, $this->mockEventDispatcher());

        $this->assertTrue($command->execute($localPackage));
    }
}
