<?php

namespace PUGX\Bot\Tests\Infrastructure;

use \PUGX\Bot\Infrastructure\FunnyMessageRepository;

class FunnyMessageRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGetAFunnyMessage()
    {
        $this->markTestIncomplete();

        $messageRepository = new FunnyMessageRepository();
        $this->assertInstanceOf('\PUGX\Bot\Message\Message', $messageRepository->fetch());
    }
}
