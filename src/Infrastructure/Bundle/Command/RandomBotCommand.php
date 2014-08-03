<?php
namespace PUGX\Bot\Infrastructure\Bundle\Command;

use PUGX\Bot\Package;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RandomBotCommand  extends ContainerAwareCommand
{
    private $allPackages;

    protected function configure()
    {
        $this
            ->setName('botrelli:random')
            ->setDescription('Make a Pull Request on a random repo')
            ->addOption('dry-run', 'dr', InputOption::VALUE_NONE, 'Execute without making the final PR')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bot = $this->getBot();
        $dryRun = $input->getOption('dry-run');

        $package  = $this->getRandomPackageFromPackagist();

        $text = $bot->execute($package, $dryRun);
        $output->writeln('World is better now: '. $package->getRepository());
    }

    private function getRandomPackageFromPackagist()
    {
        return $this->getContainer()->get('botrelli.get_random_package')->getRandomPackage();
    }

    private function getBot()
    {
        return $this->getContainer()->get('botrelli.bot');
    }
}
