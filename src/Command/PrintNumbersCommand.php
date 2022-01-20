<?php
namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Foobar;

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