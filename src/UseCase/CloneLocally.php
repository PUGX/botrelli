<?php

namespace PUGX\Bot\UseCase;

use GitWrapper\GitWrapper;
use PUGX\Bot\LocalPackage;

class CloneLocally
{
    /**
     * @var GitWrapper $gitWrapper
     */
    private $gitWrapper;

    /**
     * @param GitWrapper $gitWrapper
     */
    public function __construct(GitWrapper $gitWrapper)
    {
        $this->gitWrapper = $gitWrapper;
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
        $git->checkout($package->getLocalBranch(), array('b'=>true));

        $git->fetch('upstream');
        $git->merge('upstream/master');
        return $git->rebase('master');
    }
}
