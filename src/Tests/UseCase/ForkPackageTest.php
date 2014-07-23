<?php

namespace PUGX\Bot\Tests\Package;

use Github\Client;
use PUGX\Bot\Package;
use PUGX\Bot\UseCase\ForkPackage;

class ForkPackageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToForkAPackage()
    {
        $package = new Package();
        $package->fromArray(array('name'=>'PUGX/botrelli'));
        $command = new ForkPackage($this->getAuthenticateGitHubClient());
        $percent = 0;
        similar_text(file_get_contents(__DIR__.'/../fixtures/github-repository.serialized'),
            serialize($command->execute($package)), $percent);
        $this->assertGreaterThan(80, $percent);
    }

    public function getHttpClientMock(array $methods = array())
    {
        $methods = array_merge(
            array('get', 'post', 'patch', 'put', 'delete', 'request', 'setOption', 'setHeaders', 'authenticate'),
            $methods
        );

        return $this->getMock('Github\HttpClient\HttpClientInterface', $methods);
    }

    private function getAuthenticateGitHubClient()
    {
        $client = new Client();
        $client->authenticate('33ca8d0d2d362accbbd918f87f5ef2709505d362', 'Zs8K7yzy', Client::AUTH_URL_TOKEN);

        return $client;
    }

}
