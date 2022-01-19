#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Console\Application;
use Console\Command\printNumbers;
use Console\Command\testCommand;

$app = new Application('Console App', 'v1.0.0');
$app->add(new printNumbers());
$app->add(new testCommand());
$app -> run();