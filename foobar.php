<?php
for($number=1; $number<=100;$number++){
    if(($number % 3 == 0) && ($number % 5 == 0)){
        echo "foobar".', ';
    }elseif ($number % 3 == 0){
        echo "foo". ', ';
    }elseif ($number % 5 == 0){
        echo "bar".', ';
    }else{
        echo $number.', ';
    }
}
echo "<br/>";
echo "<br/>";

$numbers = range(1,100);
$maxNumber = max($numbers);
//echo $maxNumber;
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
