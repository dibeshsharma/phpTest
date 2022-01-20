#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Console\Command\CreateUsersTableCommand;
use Symfony\Component\Console\Application;
use Console\Command\PrintNumbersCommand;
use Console\Command\ParseCsvFile;

$app = new Application('Console App', 'v1.0.0');

/*
 * Register the commands
 * commands are registered here and full commands are:
 * php console.php PrintNumbers
 * php console.php create_table
 * php console.php app:parse-file --file users.csv --dry_run
 * php console.php app:parse-file --file users.csv -u root -p " " --host localhost
 */

$app->add(new PrintNumbersCommand());
$app->add(new CreateUsersTableCommand());
$app->add(new ParseCsvFile());
$app -> run();