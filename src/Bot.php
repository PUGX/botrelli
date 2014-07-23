<?php

namespace PUGX\Bot;

use Github\Client;
use GitWrapper\GitWrapper;
use PUGX\Bot\Infrastructure\FunnyMessageRepository;
use PUGX\Bot\UseCase;

class Bot
{
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

    // @todo create a dir with the slugify of the package->getName()
    private function getLocallyDir($package)
    {
        return sys_get_temp_dir();
    }

    /**
     * @return Client
     */
    private function getAuthenticateGitHubClient()
    {
        $client = new Client();
        $client->authenticate('botrelli', '33ca8d0d2d362accbbd918f87f5ef2709505d362', Client::AUTH_URL_TOKEN);

        return $client;
    }

} 