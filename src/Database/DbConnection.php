<?php

namespace Console\Database;

class DbConnection
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
        echo "Connection Successfull";
    }
}