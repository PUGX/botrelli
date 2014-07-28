<?php

namespace PUGX\Bot\Events;


class StepsEvents
{
    const REPOSITORY_FORKED = 'repository_forked';
    const PACKAGE_CLONED = 'package_cloned';

    const GIT_PUSHED = 'git_pushed';
    const GIT_ADDED = 'git_added';
    const GIT_COMMITTED = 'git_commited';

    const CS_FIXER_EXECUTED = 'cs_fixer_executed';

    const PULL_REQUEST_MADE = 'pull_request_made';
} 