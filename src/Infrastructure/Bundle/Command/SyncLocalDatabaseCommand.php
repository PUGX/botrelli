<?php
namespace PUGX\Bot\Infrastructure\Bundle\Command;

use Packagist\Api\Client;
use PUGX\Bot\Package;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncLocalDatabaseCommand  extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('botrelli:sync')
            ->setDescription('Synchronize the local database with the latest packages.json from Packagist')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client();
        $repository = $this->getContainer()->get('botrelli.package.doctrine.repository');

        $packages = $client->all();
        $packagesAdded = 0;
        $output->writeln("Number 5 is Analyzing Packagist packages... be patient or die, human.");
        $progress = new ProgressBar($output, count($packages));
        $progress->setRedrawFrequency(100);
        $progress->start();

        foreach ($packages as $package) {
            $localPackage = $repository->get($package);
            if (null === $localPackage) {
                $localPackage = Package::create($package);
                $repository->add($localPackage);
                $packagesAdded++;
            }
            $progress->advance();
        }
        $progress->finish();
        $output->writeln("Number 5 added $packagesAdded missing packages to the local Database.");
    }
}
