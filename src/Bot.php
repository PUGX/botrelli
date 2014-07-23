<?php

namespace PUGX\Bot;

use Github\Client;
use GitWrapper\GitWrapper;
use PUGX\Bot\Infrastructure\FunnyMessageRepository;
use PUGX\Bot\UseCase;

class Bot
{
    private $githubUserName;
    private $githubToken;

    function __construct($githubToken, $githubUserName)
    {
        $this->githubToken = $githubToken;
        $this->githubUserName = $githubUserName;
    }

    public function execute()
    {
        $client  = $this->getAuthenticateGitHubClient();

        $useCase = new UseCase\GetANeverVisitedPackage();
        $package = $useCase->execute();



        $useCase = new UseCase\ForkPackage($client);
        $useCase->execute($package);

        $useCase      = new UseCase\CloneLocally(new GitWrapper()); //
        $localPackage = $useCase->execute($package, $this->getLocallyDir($package));

       $phpCsFixerBin = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'php-cs-fixer';

       $useCase = new UseCase\ExecuteCSFixer($phpCsFixerBin, 4000);
       $useCase->execute($localPackage);

        $useCase = new UseCase\CommitAndPush();
        $useCase->execute($localPackage);

        $useCase = new UseCase\MakeAPR($client, new FunnyMessageRepository());
        $useCase->execute($localPackage);
    }


    private function getLocallyDir($package)
    {
        $name = preg_replace("[^\w\s\d\.\-_~,;:\[\]\(\]]", '', $package->getName());

        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . $name;
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

} 