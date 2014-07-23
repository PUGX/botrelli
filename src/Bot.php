<?php

namespace PUGX\Bot;

use PUGX\Bot\UseCase;
use PUGX\Bot\Infrastructure\FunnyMessageRepository;

class Bot
{
   public function execute()
   {
       $useCase = new UseCase\GetANeverVisitedPackage();//--
       $package = $useCase->execute();

       $useCase = new UseCase\ForkPackage(\stdClass);
       $useCase->execute($package);

       $useCase = new UseCase\CloneLocally();//
       $localPackage = $useCase->execute($package, $this->getLocallyDir($package));

       $useCase = new UseCase\ExecuteCSFixer();
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