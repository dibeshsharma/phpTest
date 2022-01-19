<?php

namespace Console;
use Console\Database\DbConnection;

class User
{
    public function save($name, $surname, $email)
    {
        $db = new DbConnection();
        $name = $db->con->real_escape_string($name);
        $surname = $db->con->real_escape_string($surname);
        $email = $db->con->real_escape_string($email);

        $name = ucfirst(strtolower($name));
        $surname = ucfirst(strtolower($surname));
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}