<?php

namespace PUGX\Bot\Tests\Package;

use Packagist\Api\Result\Package;
use PUGX\Bot\LocalPackage;
use PUGX\Bot\UseCase\ExecuteCSFixer;

class ExecuteCSFixerTest extends \PHPUnit_Framework_TestCase
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

        $package = new LocalPackage($this->fileToFix, new Package());
        $command = new ExecuteCSFixer($this->csFixBin());

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
        new ExecuteCSFixer('');
    }

    /**
     * @test
     */
    public function shouldNotThrowNoExceptionsWithTheCorrectPhpCsBinary()
    {
        new ExecuteCSFixer($this->csFixBin());
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

