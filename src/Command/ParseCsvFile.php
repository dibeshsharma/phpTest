<?php
/*
 * This code is written by
 * Programmer/Web Developer
 * Dibesh Sharma <https://github.com/dibeshsharma>
 */

namespace Console\Command;

error_reporting(0);

use Console\User;
use mysqli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

/*
 * Command to parse the csv file and insert it to the database:
 * php console.php app:parse-file --file users.csv -u username -p password --host localhost
 *
 * Command to parse the csv file without altering the database
 * php console.php app:parse-file --file user.csv --dry-run
 *
 * for blank password use
 * php console.php app:parse-file --file users.csv -u username -p " " --host localhost
 */

class ParseCsvFile extends Command
{
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

        /*
         * checks if:
         * --file [file-name] exists in the upload folder
         * --file [file-name] is followed by --dry_run, if yes it only runs the script and doesn't insert csv values to the database
         * --file [file-name] -u username -p password --host localhost, correct credentials are provided
         */

        if(!empty($inputOptions['file'])){

            $reader = new Csv();

            if(file_exists("uploads/".$input->getOption('file'))){
                $spreadsheet = $reader->load("uploads/".$input->getOption('file'));
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                /*
                 * --file [file-name] is followed by --dry_run, only run the script
                 */
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
                    /*
                     * --file [file-name] -u username -p password --host localhost
                     * script for no --dry_run
                     */
                    $username = null;
                    $password = null;
                    $host = null;

                    if(!empty($inputOptions['u'])){
                        $username = $inputOptions['u'];
                    }

                    /*
                     * Sometimes password can be blank
                     * Valid for blank password or supplied password
                     */

                    if(!empty($inputOptions['p'])){
                        if (ctype_space($inputOptions['p'])){
                            $password = "";
                        }else{
                            $password = $inputOptions['p'];
                        }
                    }

                    if(!empty($inputOptions['host'])){
                        $host = $inputOptions['host'];
                    }

                    /*
                     * for correct inputs, parse the csv file and insert it to the database                     *
                     */
                    if(mysqli_connect($host, $username, $password, "php-test")){
                        if (!empty($sheetData)) {
                            for ($i=1; $i<count($sheetData); $i++) { //skipping first row
                                $name = $sheetData[$i][0];
                                $surname = $sheetData[$i][1];
                                $email = $sheetData[$i][2];

                                $user = new User($name,$surname,$email);
                                $user->save();
                            }
                        }
                    } else{
                        /*
                         * if the supplied input doesn't match the db credentials
                         */
                        die($output->write("Failed to connect to MySQL: Please check the credentials."));
                    }
                }
            }else{
                // if file doesn't exist in uploads folder display the message
                $output->writeln('please upload the file'.$input->getOption('file').' inside the uploads folder and try again.');
            }
        }
        return Command::SUCCESS;
    }
}