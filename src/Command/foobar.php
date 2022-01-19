<?php
namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class foobar extends Command
{
    protected function configure()
    {
        $this->setName('printNumbers')
        ->setDescription('Shows current date and time')
        ->setHelp('This command prints the current date and time');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $numbers = range(1,100);
        $maxNumber = max($numbers);
        foreach ($numbers as $number){
            if(($number % 3 == 0) && ($number % 5 == 0)){
                if($number == $maxNumber){
                    echo "and foobar.";
                }else{
                    echo "foobar".', ';
                }
            }elseif ($number % 3 == 0){
                if($number == $maxNumber){
                    echo "and foo.";
                }else{
                    echo "foo". ', ';
                }
            }elseif ($number % 5 == 0){
                if($number == $maxNumber){
                    echo "and bar.";
                }else{
                    echo "bar".', ';
                }
            }else{
                if($number == $maxNumber){
                    echo "and".$number;
                }else{
                    echo $number.', ';
                }

            }
        }
        return Command::SUCCESS;
    }
}