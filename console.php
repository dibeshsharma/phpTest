#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Console\Application;
use Console\Command\foobar;

$app = new Application('Console App', 'v1.0.0');
$app->add(new foobar());
$app -> run();