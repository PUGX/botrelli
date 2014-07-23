<?php

namespace PUGX\Bot;

use PUGX\Bot\UseCase;
use PUGX\Bot\Infrastructure\FunnyMessageRepository;

class Bot
{
   public function execute()
   {
       $useCase = new UseCase\GetANeverVisitedPackage();
       $package = $useCase->execute();

       $useCase = new UseCase\ForkPackage();
       $useCase->execute($package);

       $useCase = new UseCase\CloneLocally();
       $localPackage = $useCase->execute($package, $this->getLocallyDir($package));

       $phpCsFixerBin = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'php-cs-fixer';

       $useCase = new UseCase\ExecuteCSFixer($phpCsFixerBin, 4000);
       $useCase->execute($localPackage);

       $useCase = new UseCase\CommitAndPush();
       $useCase->execute($localPackage);

       $useCase = new UseCase\MakeAPR(new FunnyMessageRepository());
       $useCase->execute($localPackage);
   }

    // @todo create a dir with the slugify of the package->getName()
    private function getLocallyDir($package)
    {
        return sys_get_temp_dir();
    }

} 