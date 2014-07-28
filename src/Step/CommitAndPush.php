<?php

namespace PUGX\Bot\Step;

use PUGX\Bot\LocalPackage;
use GitWrapper\GitWorkingCopy;
use PUGX\Bot\Events\GitEventMade;
use PUGX\Bot\Events\StepsEvents;

class CommitAndPush extends DispatcherStep
{

    public function execute(GitWorkingCopy $git, LocalPackage $package)
    {
        $git->add('.');
        $this->dispatchEvent(StepsEvents::GIT_ADDED, new GitEventMade($git));

        $git->commit($this->getCommitMessage($git));
        $this->dispatchEvent(StepsEvents::GIT_COMMITTED, new GitEventMade($git));

        $git->push('origin', $package->getLocalBranch(), array('f' => true));
        $this->dispatchEvent(StepsEvents::GIT_PUSHED, new GitEventMade($git));

        return (null === $git->getStatus())?true:false;
    }

    private function getCommitMessage(GitWorkingCopy $git)
    {
       return 'CS Fixes';
    }
} 