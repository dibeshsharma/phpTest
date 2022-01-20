<?php
/*
 * This code is written by
 * Programmer/Web Developer
 * Dibesh Sharma <https://github.com/dibeshsharma>
 */
namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Foobar;

/*
 * printing the numbers command
 * Type the command below to execute:
 * php console.php printNumbers
 */
class PrintNumbersCommand extends Command
{
    protected function configure()
    {
        $this->setName('printNumbers')
        ->setDescription('Print the numbers')
        ->setHelp('This command prints the numbers');
    }

    protected function execute (InputInterface $input, OutputInterface $output)
    {
        $foobar = new Foobar();
        $print = $foobar->printNumbers();
        return Command::SUCCESS;
    }
}