<?php
namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Database\DbConnection;

class testCommand extends Command
{
    public $projectDir = __DIR__;

    protected static $defaultName = 'app:parse-file';

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Parse the csv file')
            ->addArgument('csvFileName', InputArgument::REQUIRED, 'Provide the name of the CSV to be parsed');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
//        $text = 'Hi '.$input->getArgument('csvFileName');


        $DbConnection = new DbConnection();

//        exec("php ./user_upload.php",$output);
//        print_r($output);
        return Command::SUCCESS;
    }



}