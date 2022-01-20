<?php

namespace Console\Command;

use Console\Database\DbHandler;
use Console\foobar;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUsersTableCommand extends Command
{
    protected function configure()
    {
        $this->setName('create_table')
            ->setDescription('Create the users table.')
            ->setHelp('This command creates the users table.');
    }

    protected function execute (InputInterface $input, OutputInterface $output)
    {
        $dbHandler = new DbHandler();
        $sql = "CREATE TABLE `php-test`.`users` ( `name` VARCHAR(255) NOT NULL , `surname` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , UNIQUE `email` (`email`)) ENGINE = InnoDB";
        if ($dbHandler->con->query($sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $dbHandler->con->error;
        }
        return Command::SUCCESS;
    }

}