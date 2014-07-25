<?php
namespace PUGX\Bot\Infrastructure\Bundle\Command;

use Packagist\Api\Client;
use PUGX\Bot\Bot;
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
            ->setName('fix:repo')
            ->setDescription('Make a Pull Request on the given repo')
            ->addArgument('repository', InputArgument::REQUIRED, 'Packagist repository name.')
            ->addOption('dry-run', 'dr', InputOption::VALUE_NONE, 'Execute without making the final PR')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bot = $this->getBot();

        $name = $input->getArgument('repository');
        $dryrun = $input->getOption('dry-run');

        $package  = $this->getPackageFromPackagist($name);

        $text = $bot->execute($package, $dryrun);
        $output->writeln($text);
    }

    private function getPackageFromPackagist($name)
    {
        $client = new Client();
        $repo = $client->get($name);

        if (!($repo instanceof \Packagist\Api\Result\Package)) {
            throw new \Exception('Repository name not valid');
        }

        $repo = Package::createFromPackage($repo);

        return $repo;
    }

    private function getBot()
    {
        $username = $this->getContainer()->getParameter('github_credential_username');
        $token =  $this->getContainer()->getParameter('github_credential_token');
        $privatePath =  $this->getContainer()->getParameter('private_key_path');

        return new Bot($username, $token, $privatePath);
    }
}
