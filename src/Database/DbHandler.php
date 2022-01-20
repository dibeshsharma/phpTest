<?php
/*
 * This code is written by
 * Programmer/Web Developer
 * Dibesh Sharma <https://github.com/dibeshsharma>
 */

namespace Console\Database;

class DbHandler
{
    /*
     * Set your database credentials in this section
     */
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

    public function authenticate($supplied_host, $supplied_username, $supplied_password)
    {
        if($supplied_host == $this->db_host && $supplied_username == $this->db_username && $supplied_password == $this->db_password)
        {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Data sanitization and modification before inserting to the database
     */
    public function sanitize($data)
    {
        $data = $this->con->real_escape_string($data);
        $data = strtolower($data);
        return $data;
    }

    /*
     * To check if the email is in correct format
     */
    public function validateEmail($email)
    {
        // Remove all illegal characters from email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Validate e-mail
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $email;
    }
}