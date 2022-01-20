#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Console\Command\CreateUsersTableCommand;
use Symfony\Component\Console\Application;
use Console\Command\PrintNumbersCommand;
use Console\Command\ParseCsvFile;

$app = new Application('Console App', 'v1.0.0');

$parseCsvFileCommand = new ParseCsvFile();

// Register the commands
$app->add($parseCsvFileCommand);
//$app->setDefaultCommand($parseCsvFileCommand->getName(),true);
$app->add(new PrintNumbersCommand());
$app->add(new CreateUsersTableCommand());
$app -> run();