<?php

namespace PUGX\Bot\Step;

use GitWrapper\GitWrapper;
use PUGX\Bot\Events\PackageClonedLocally;
use PUGX\Bot\LocalPackage;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use PUGX\Bot\Events\GitEventMade;
use PUGX\Bot\Events\StepsEvents;

class CloneLocally extends DispatcherStep
{
    /**
     * @var GitWrapper $gitWrapper
     */
    private $gitWrapper;

    /**
     * @param GitWrapper $gitWrapper
     */
    public function __construct(GitWrapper $gitWrapper, EventDispatcherInterface $dispatcher)
    {
        $this->gitWrapper = $gitWrapper;
        parent::__construct($dispatcher);
    }

    /**
     * @param LocalPackage $package
     *
     * @return GitWorkingCopy
     */
    public function execute(LocalPackage $package)
    {
        $git = $this->gitWrapper->cloneRepository($package->getForkSSHRepository(), $package->getFolder());

        $git
            ->config('user.name', 'BOTrelli')
            ->config('user.email', 'botrelli@gmx.com');

        $git->remote('add', 'upstream', $package->getRepository());
        $this->dispatchEvent(StepsEvents::GIT_REMOTE_ADDED, new GitEventMade($git));

        $git->checkout($package->getLocalBranch(), array('b'=>true));
        $this->dispatchEvent(StepsEvents::GIT_CHECKOUT_DONE, new GitEventMade($git));

        $git->fetch('upstream');
        $this->dispatchEvent(StepsEvents::GIT_FETCHED, new GitEventMade($git));

        $git->merge('upstream/master');
        $this->dispatchEvent(StepsEvents::GIT_MERGED, new GitEventMade($git));

        $git->rebase('master');
        $this->dispatchEvent(StepsEvents::GIT_MERGED, new GitEventMade($git));

        return $git;
    }
}
