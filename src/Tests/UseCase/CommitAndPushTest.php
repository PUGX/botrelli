<?php

namespace PUGX\Bot\Tests\Package;

use Packagist\Api\Result\Package;
use PUGX\Bot\LocalPackage;
use PUGX\Bot\UseCase\CommitAndPush;

class CommitAndPushTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToCommitAndPush()
    {
        $this->markTestIncomplete();

        $package = new LocalPackage('/tmp', new Package());

        $command = new CommitAndPush();
        $this->assertTrue($command->execute($package));
    }
}
