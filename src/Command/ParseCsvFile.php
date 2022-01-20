<?php
namespace Console\Command;

use Console\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Database\DbHandler;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class ParseCsvFile extends Command
{
    public $projectDir = __DIR__;

    protected static $defaultName = 'app:parse-file';

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Parse the csv file and insert data to the users table in the database.')
            ->setDefinition(
                new InputDefinition([
                   new InputOption('file', 'f', InputOption::VALUE_REQUIRED,"this is the name of the CSV to be parsed"),
                   new InputOption('dry_run', 'd', InputOption::VALUE_OPTIONAL,"this will be used with the --file directive in case we want to run the script but not insert into the DB. All other functions will be executed, but the database won't be altered","notNull"),
                   new InputOption('u', 'u', InputOption::VALUE_REQUIRED, "MySQL username"),
                   new InputOption('p', 'p', InputOption::VALUE_REQUIRED, "MySQL password"),
                   new InputOption('host','host', InputOption::VALUE_REQUIRED, "MySQL host"),
                ])
            )
            ->setHelp('This command allows you to parse the csv file.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputOptions = $input->getOptions();

        if(!empty($inputOptions['file'])){

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();

            if(file_exists("uploads/".$input->getOption('file'))){
                $spreadsheet = $reader->load("uploads/".$input->getOption('file'));
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                if($inputOptions['dry_run'] == null){
                    if (!empty($sheetData)) {
                        for ($i=1; $i<count($sheetData); $i++) { //skipping first row
                            $name = $sheetData[$i][0];
                            $surname = $sheetData[$i][1];
                            $email = $sheetData[$i][2];

                            $output->write($name. " ");
                            $output->write($surname. " ");
                            $output->write($email);
                            $output->writeln("\n------------------------------------");
                        }
                    }
                } else {
                    if (!empty($sheetData)) {
                        for ($i=1; $i<count($sheetData); $i++) { //skipping first row
                            $name = $sheetData[$i][0];
                            $surname = $sheetData[$i][1];
                            $email = $sheetData[$i][2];

                            $user = new User($name,$surname,$email);
                            $user->save();
                        }
                    }
                }
            }else{
                $output->writeln('please upload the file'.$input->getOption('file').' inside the uploads folder and try again.');
            }
        }
        return Command::SUCCESS;
    }
}