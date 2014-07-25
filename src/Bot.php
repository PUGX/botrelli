<?php

namespace PUGX\Bot;

use Github\Client;
use GitWrapper\GitWrapper;
use PUGX\Bot\Infrastructure\FunnyMessageRepository;
use PUGX\Bot\UseCase;
use PUGX\Bot\Package;

class Bot
{
    private $githubUserName;
    private $githubToken;
    private $phpCsFixerBin;

    function __construct($githubToken, $githubUserName, $privateKeyPath, $phpCsFixerBin = null)
    {
        $this->githubToken = $githubToken;
        $this->githubUserName = $githubUserName;
        $this->privateKeyPath = $privateKeyPath;
        $this->phpCsFixerBin = $phpCsFixerBin;

        if (null === $this->phpCsFixerBin) {
            $this->phpCsFixerBin = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'php-cs-fixer';
        }
    }

    public function execute(Package $package, $dryrun = false)
    {
        $client  = $this->getAuthenticateGitHubClient();
        $gitWrapper = $this->getGitWrapper();

        $useCase = new UseCase\ForkPackage($client);
        $repository = $useCase->execute($package);

        $localPackage =  new LocalPackage($repository, $this->sanitizeLocallyDir($package), $package);

        $useCase      = new UseCase\CloneLocally($gitWrapper);
        $useCase->execute($localPackage);

        $useCase = new UseCase\ExecuteCSFixer($this->phpCsFixerBin, 4000);
        $useCase->execute($localPackage);

         if(!$dryrun){

            $useCase = new UseCase\CommitAndPush($gitWrapper);
            $useCase->execute($localPackage);

            $useCase = new UseCase\MakeAPR($client, new FunnyMessageRepository());
            $useCase->execute($localPackage);
        }

    }


    private function sanitizeLocallyDir($package)
    {
        return $this->getFolderNotExists(sys_get_temp_dir() . DIRECTORY_SEPARATOR . $package->getName());
    }

    private function cleanDirectory($dir)
    {
        return preg_replace("[^\w\s\d\.\-_~,;:\[\]\(\]]", '', $dir);
    }

    /**
     * @return Client
     */
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
            ->config('user.name', 'botrelli')
            ->config('user.email', 'botrelli@gmx.com');

        return $git;
    }

    /**
     * @param $package
     * @param $cleaned
     * @param $suffix
     * @return string
     */
    private function getFolderNotExists($folder, $i = 0)
    {
        $folder = $this->cleanDirectory($folder);
        $folderSuffix = $folder;

        if ($i != 0) {
            $folderSuffix .= '-'.$i;
        }

        if (file_exists($folderSuffix)) {
           return $this->getFolderNotExists($folder, ++$i);
        }

        return $folderSuffix;
    }

} 