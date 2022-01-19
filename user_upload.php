<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
$spreadsheet = $reader->load("uploads/users.csv");

$sheetData = $spreadsheet->getActiveSheet()->toArray();

if (!empty($sheetData)) {
    for ($i=1; $i<count($sheetData); $i++) { //skipping first row
        $name = $sheetData[$i][0];
        $surname = $sheetData[$i][1];
        $email = $sheetData[$i][2];

        $name = ucfirst(strtolower($name));
        $surname = ucfirst(strtolower($surname));
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format, ";
            fwrite(STDOUT, $emailErr);
        }else{
            $db->query("INSERT INTO USERS(name, surname, email) VALUES('$name', '$surname', '$email')");
        }

    }
}