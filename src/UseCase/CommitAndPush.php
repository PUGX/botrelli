<?php

namespace PUGX\Bot\UseCase;

use PUGX\Bot\LocalPackage;
use GitWrapper\GitWrapper;
use GitWrapper\GitWorkingCopy;


class CommitAndPush
{
    private $git;

    public function initGit(GitWorkingCopy $gitWorkingCopy)
    {
        $this->git = $gitWorkingCopy;
    }

    public function execute(LocalPackage $package)
    {

        if($this->git === null) {
            $gitWrapper = new GitWrapper();
            $this->git = new GitWorkingCopy($gitWrapper, $package->getFolder());
        }

        $result = $this->git
            ->add('.')
            ->commit('CS Fixes')
            ->push('origin', 'master');

        return strpos($result, 'error: ') === false;
    }
} 