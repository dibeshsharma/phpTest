<?php

namespace Console\Command;

use Console\foobar;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class createUsersTable
{
    protected function configure()
    {
        $this->setName('--create_table')
            ->setDescription('Create the users table.')
            ->setHelp('This command creates the users table.');
    }

    protected function execute (InputInterface $input, OutputInterface $output)
    {
        $foobar = new foobar();
        $print = $foobar->printNumbers();
        return Command::SUCCESS;
    }

}