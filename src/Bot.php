<?php

namespace PUGX\Bot;

use Github\Client;
use GitWrapper\GitWrapper;
use GitWrapper\GitWorkingCopy;
use PUGX\Bot\Infrastructure\FunnyMessageRepository;

class Bot
{
    private $githubUserName;
    private $githubToken;
    private $githubEmail;
    private $phpCsFixerBin;
    private $dispatcher;
    private $tempDirectory;

    public function __construct($dispatcher, $githubToken, $githubUserName, $githubEmail, $privateKeyPath, $tempDirectory = '/tmp', $phpCsFixerBin = null)
    {
        $this->dispatcher = $dispatcher;
        $this->githubToken = $githubToken;
        $this->githubUserName = $githubUserName;
        $this->githubEmail = $githubEmail;
        $this->privateKeyPath = $privateKeyPath;
        $this->tempDirectory = $tempDirectory;
        $this->phpCsFixerBin = $phpCsFixerBin;

        if (null === $this->phpCsFixerBin) {
            $this->phpCsFixerBin = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'php-cs-fixer';
        }
    }

    public function execute(Package $package, $dryRun = false)
    {

        $client  = $this->getAuthenticateGitHubClient();
        $gitWrapper = $this->getGitWrapper();

        $step = new Step\ForkPackage($client, $this->dispatcher);
        $repository = $step->execute($package);

        sleep(180);

        $localPackage =  new LocalPackage($repository, $this->sanitizeLocallyDir($package), $package);

        $step      = new Step\CloneLocally($gitWrapper, $this->dispatcher);
        $step->execute($localPackage);

        $step = new Step\ExecuteCSFixer($this->phpCsFixerBin, 4000, $this->dispatcher);
        $step->execute($localPackage);

         if (!$dryRun) {

            $step = new Step\CommitAndPush($this->dispatcher);
            $git =  $this->getGitWorking($gitWrapper, $localPackage);
            $step->execute($git, $localPackage);

            $step = new Step\MakeAPR($client, new FunnyMessageRepository(), $this->dispatcher);
            $step->execute($localPackage);
        }

        return $localPackage;
    }

    private function sanitizeLocallyDir($package)
    {
        return $this->getFolderNotExists($this->tempDirectory . DIRECTORY_SEPARATOR . $package->getName());
    }

    private function cleanDirectory($dir)
    {
        return preg_replace("[^\w\s\d\.\-_~,;:\[\]\(\]]", '', $dir);
    }

    private function getAuthenticateGitHubClient()
    {
        $client = new Client();
        $client->authenticate($this->githubUserName, $this->githubToken, Client::AUTH_URL_TOKEN);

        return $client;
    }

    private function getGitWrapper()
    {
        $wrapper = new GitWrapper();
        $wrapper->setPrivateKey($this->privateKeyPath);

        return $wrapper;
    }

    private function getGitWorking($gitWrapper, $package)
    {
        $git = new GitWorkingCopy($gitWrapper, $package->getFolder());
        $git
            ->config('user.name', $this->githubUserName)
            ->config('user.email', $this->githubEmail);

        return $git;
    }

    private function getFolderNotExists($folder, $i = 0)
    {
        $folder = $this->cleanDirectory($folder);
        $folderSuffix = $folder;

        if ($i != 0) {
            $folderSuffix .= '-'.$i.rand(0, PHP_INT_MAX);
        }

        if (file_exists($folderSuffix)) {
           return $this->getFolderNotExists($folder, ++$i);
        }

        return $folderSuffix;
    }
}
