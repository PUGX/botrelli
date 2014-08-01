<?php

namespace PUGX\Bot\Tests\Step;

use PUGX\Bot\Package;
use PUGX\Bot\LocalPackage;
use PUGX\Bot\Step\ExecuteCSFixer;

class ExecuteCSFixerTest extends BaseTestCase
{
    private $fileToFix;

    public function setUp()
    {
        $this->fileToFix = $this->prepareWrongFileToFix();
    }

    /**
     * @test
     */
    public function shouldBeAbleToRunCsFixForAPackage()
    {
        $before    = $this->getFileMD5($this->fileToFix);

        $package = new LocalPackage(array(), $this->fileToFix, new Package());
        $command = new ExecuteCSFixer($this->csFixBin(), 100, $this->mockEventDispatcher());

        $this->assertEquals(1, $command->execute($package));

        $after = $this->getFileMD5($this->fileToFix);
        $this->assertNotEquals($before, $after);
    }

    /**
     * @test
     */
    public function shouldNotBeAbleToRunCsFixWithTheWrongBinaryFile()
    {
        $this->setExpectedException('\InvalidArgumentException', ' is not executable!');
        new ExecuteCSFixer('', 100, $this->mockEventDispatcher());
    }

    /**
     * @test
     */
    public function shouldNotThrowNoExceptionsWithTheCorrectPhpCsBinary()
    {
        new ExecuteCSFixer($this->csFixBin(), 100, $this->mockEventDispatcher());
    }

    public function tearDown()
    {
        unlink($this->fileToFix);
    }

    private function prepareWrongFileToFix()
    {
        $destinationFile = '/tmp/WrongClass.php';
        copy(__DIR__ . '/../WrongClass.php', $destinationFile);

        return $destinationFile;
    }

    private function csFixBin()
    {
        return __DIR__ . '/../../../bin/php-cs-fixer';
    }

    private function getFileMD5($filename)
    {
        return md5(file_get_contents($filename));
    }
}

