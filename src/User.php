<?php
/*
 * This code is written by
 * Programmer/Web Developer
 * Dibesh Sharma <https://github.com/dibeshsharma>
 */
namespace Console;
use Console\Database\DbHandler;

class User
{
    private $name;
    private $surname;
    private $email;

    /*
     * Initialize the property
     */

    public function __construct($name, $surname, $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }

    /*
     * sanitize the data
     * validate the email
     * for non-validated email skip the entry
     * save to the database
     */

    public function save()
    {
        $dbHandler = new DbHandler();

        $name = $dbHandler->sanitize($this->name);
        $surname = $dbHandler->sanitize($this->surname);

        $email = $dbHandler->sanitize($this->email);
        $email = $dbHandler->validateEmail($email);
        $email = strtolower($email);

        if($email){
            $stmt = $dbHandler->con->prepare("Insert into users(name, surname, email) values (?,?,?) ");
            $stmt->bind_param("sss", $name, $surname, $email);
            if($stmt->execute()){
                $msg = "Data inserted successfully \n";
            }else{
                $msg = $stmt->error;
            }
            fwrite(STDOUT, $msg);
        } else {
            $msg = "Invalid email format \n";
            fwrite(STDOUT, $msg);
        }

    }
}

