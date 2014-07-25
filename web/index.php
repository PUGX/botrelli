#!/usr/bin/env php
<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;


$loader = require_once __DIR__.'/../app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/../app/AppKernel.php';


$githubUsername = 'botrelli';
$githubToken = '66d27b3ea53eda58ad7f71253dc2338b08efe4c4';


$bot = new \PUGX\Bot\Bot($githubUsername, $githubToken, '/home/liuggio/.ssh/botrelli_rsa');

$package = new \PUGX\Bot\Package();
$package->fromArray(['name'=>'pugx/botrelli', 'repository' => 'https://github.com/PUGX/botrelli']);

$bot->execute($package);