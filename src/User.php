<?php
namespace Console;
use Console\Database\DbHandler;

class User
{
    private $name;
    private $surname;
    private $email;

    public function __construct($name, $surname, $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }

    public function save()
    {
        $dbHandler = new DbHandler();

        $name = $dbHandler->sanitize($this->name);
        $surname = $dbHandler->sanitize($this->surname);

        $email = $dbHandler->sanitize($this->email);
        $email = $dbHandler->validateEmail($email);

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
            //echo "email is not valid";
            $msg = "Invalid email format \n";
            fwrite(STDOUT, $msg);
        }

    }
}

