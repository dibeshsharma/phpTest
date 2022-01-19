<?php
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
