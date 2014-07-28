<?php

namespace PUGX\Bot\Tests\Step;

use PUGX\Bot\Step\PullPackagistList;

class PullPackagistListTest extends BaseTestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToFetchAListOfPackages()
    {
        $this->markTestSkipped('');

        $client = $this->getMockBuilder('Packagist\Api\Client')
            ->disableOriginalConstructor()
            ->getMock();

        $provider = $this->getMockBuilder('PUGX\Bot\Package\ProviderInterface')
            ->getMock();

        $packages = array(
            'pugx/pinco',
            'pugx/pallino'
        );

        $client
            ->expects($this->once())
            ->method('all')
            ->will($this->returnValue($packages));

        $provider
            ->expects($this->once())
            ->method('setAllPackages')
            ->with($packages)
            ->will($this->returnValue(true));

        $command = new PullPackagistList($client, $provider, $this->mockEventDispatcher());
        $this->assertTrue($command->execute());
    }
}
