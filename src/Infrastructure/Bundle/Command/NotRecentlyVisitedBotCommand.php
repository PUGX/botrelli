<?php
namespace PUGX\Bot\Infrastructure\Bundle\Command;

use PUGX\Bot\Package;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class NotRecentlyVisitedBotCommand  extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('botrelli:not-recent:cs')
            ->setDescription('Make a Pull Request')
            ->addOption('dry-run', 'dr', InputOption::VALUE_NONE, 'Execute without making the final PR')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bot = $this->getBot();
        $dryRun = $input->getOption('dry-run');

        $package  = $this->getANotVisitedRecentlyPackage();

        if (null === $package) {
            $output->writeln("<error>No valid package found</error>");
            return;
        }

        $package = $bot->execute($package, $dryRun);
        $output->writeln('World is better now: '. $package->getRepository());
    }

    private function getANotVisitedRecentlyPackage()
    {
        return $this
            ->getContainer()
            ->get('botrelli.package.doctrine.repository')
            ->getANotVisitedRecentlyPackage()
        ;
    }

    private function getBot()
    {
        return $this->getContainer()->get('botrelli.bot');
    }
}
