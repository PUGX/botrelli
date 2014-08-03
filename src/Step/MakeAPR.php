<?php

namespace PUGX\Bot\Step;

use PUGX\Bot\LocalPackage;
use PUGX\Bot\Message\MessageRepositoryInterface;
use Github\Client;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use PUGX\Bot\Events\StepsEvents;
use PUGX\Bot\Events\PullRequestMade;

class MakeAPR extends DispatcherStep
{
    const PREFIX = <<< EOF
| Q             | A
| ------------- | ---
| Bug fix?      | no
| New feature?  | no
| BC breaks?    | no
| Deprecations? | no
| Tests pass?   | yes
| Fixed tickets |
| License       | MIT
| Doc PR        |

EOF;

    const SUFFIX = '


I\'m a [bot](http://botrelli.pugx.org)';

    private $messageRepository;
    private $client;

    public function __construct(Client $client, MessageRepositoryInterface $messageRepository, EventDispatcherInterface $dispatcher)
    {
        parent::__construct($dispatcher);
        $this->messageRepository = $messageRepository;
        $this->client = $client;
    }

    public function execute(LocalPackage $package)
    {
        $message = (string) $this->messageRepository->fetch();

        $pullRequest = $this->client
            ->api('pull_request')
            ->create( $package->getUsername(), $package->getRepoName(), array(
                'base' => 'master',
                'head' => 'botrelli:'.$package->getLocalBranch(),
                'title' => $this->getCommitTitle(),
                'body' => $this->getCommitMessageWithPrefix($message)
            ));

        $this->dispatchEvent(StepsEvents::PULL_REQUEST_MADE, PullRequestMade::createFromGithubResponse($pullRequest, $message, $package->getFolder()));

        return 201 === $this->client->getHttpClient()->getLastResponse()->getStatusCode();
    }

    private function getCommitMessageWithPrefix($message)
    {
        return self::PREFIX . $message  . self::SUFFIX;
    }

    private function getCommitTitle()
    {
        return '[CS] Coding Standard fixes';
    }
}
