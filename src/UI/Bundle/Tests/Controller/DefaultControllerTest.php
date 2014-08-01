<?php

namespace PUGX\Bot\UI\Bundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PUGX\Bot\Events\StepsEvents;
class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $eventDispatcher = $client->getContainer()->get('event_dispatcher');
        $prMade = new \PUGX\Bot\Events\PullRequestMade(1, 'pugx/botrelli', 'https://github.com/pugx/botrelli', 'feel the force', 'git...', 'active');

        $eventDispatcher->dispatch(StepsEvents::PULL_REQUEST_MADE, $prMade);
        $crawler = $client->request('GET', '/');
        $this->assertTrue($crawler->filter('html:contains("pugx")')->count() > 0);
    }
}
