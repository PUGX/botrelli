<?php

namespace PUGX\Bot\Events;


class StepsEvents
{
    const REPOSITORY_FORKED = 'repository_forked';
    const GIT_REMOTE_ADDED = 'git_remote_added';
    const GIT_CHECKOUT_DONE = 'git_checkout_done';
    const GIT_FETCHED = 'git_fetched';
    const GIT_MERGED = 'git_merged';
    const GIT_REBASED = 'git_rebased';

    const PACKAGE_CLONED = 'package_cloned';

    const GIT_PUSHED = 'git_pushed';
    const GIT_ADDED = 'git_added';
    const GIT_COMMITTED = 'git_commited';

    const CS_FIXER_EXECUTED = 'cs_fixer_executed';

    const PULL_REQUEST_MADE = 'pull_request_made';
} 