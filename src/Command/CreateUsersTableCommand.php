<?php
/*
 * This code is written by
 * Programmer/Web Developer
 * Dibesh Sharma <https://github.com/dibeshsharma>
 */

namespace Console\Command;

use Console\Database\DbHandler;
use Console\foobar;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/*
 * Command to create the users table is:
 * php console.php create_table
 */

class CreateUsersTableCommand extends Command
{
    protected function configure()
    {
        $this->setName('create_table')
            ->setDescription('Create the users table.')
            ->setHelp('This command creates the users table.');
    }

    /*
     * Command execution goes here
     * if no users table in the database it will create the users table
     * else displays the error
     */

    protected function execute (InputInterface $input, OutputInterface $output)
    {
        $dbHandler = new DbHandler();
        $sql = "CREATE TABLE `php-test`.`users` ( `name` VARCHAR(255) NOT NULL , `surname` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , UNIQUE `email` (`email`)) ENGINE = InnoDB";
        if ($dbHandler->con->query($sql) === TRUE) {
            echo "Users table created successfully";
        } else {
            echo "Error creating users table: " . $dbHandler->con->error;
        }
        return Command::SUCCESS;
    }

}