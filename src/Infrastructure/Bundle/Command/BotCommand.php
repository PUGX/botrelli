<?php
namespace PUGX\Bot\Infrastructure\Bundle\Command;

use PUGX\Bot\Package;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class BotCommand  extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('botrelli:cs')
            ->setDescription('Make a Pull Request on the given repo')
            ->addArgument('repository', InputArgument::REQUIRED, 'Packagist repository name.')
            ->addOption('dry-run', 'dr', InputOption::VALUE_NONE, 'Execute without making the final PR')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bot = $this->getBot();
        $name = $input->getArgument('repository');
        $dryRun = $input->getOption('dry-run');

        $package  = $this->getPackageFromPackagist($name);

        $package = $bot->execute($package, $dryRun);
        $output->writeln('World is better now: '. $package->getRepository());
    }

    private function getPackageFromPackagist($name)
    {
        return $this
            ->getContainer()
            ->get('botrelli.package.repository')
            ->get($name)
        ;
    }

    private function getBot()
    {
        return $this->getContainer()->get('botrelli.bot');
    }
}
