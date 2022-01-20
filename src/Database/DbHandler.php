<?php

namespace Console\Database;

class DbHandler
{
    protected $db_host = 'localhost';
    protected $db_username = 'root';
    protected $db_password = '';
    protected $db_name = 'php-test';

    public $con = null;

    public function __construct()
    {
        $this->con = mysqli_connect($this->db_host, $this->db_username, $this->db_password, $this->db_name);

        if($this->con->connect_errno){
            die("Unable to connect database: " . $this->con->connect_errno);
        }
    }

    public function sanitize($data)
    {
        $data = $this->con->real_escape_string($data);
        $data = ucfirst(strtolower($data));
        return $data;
    }

    public function validateEmail($email)
    {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $email;
    }
}