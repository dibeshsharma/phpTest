<?php
/*
 * This code is written by
 * Programmer/Web Developer
 * Dibesh Sharma <https://github.com/dibeshsharma>
 */

namespace Console;

class Foobar
{
    /*
     * Output the numbers from 1 to 100
     * Where the number is divisible by three (3) output the word “foo”
     * Where the number is divisible by five (5) output the word “bar”
     * Where the number is divisible by three (3) and (5) output the word “foobar”
     */

    public function printNumbers()
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
    }

}