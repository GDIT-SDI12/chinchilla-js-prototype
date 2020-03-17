<?php

class DB
{
    public function getConnection()
    {
        $mysqli = mysqli_connect('SERVER', 'USER', 'PASSWORD', 'DB_NAME');
        $sql_msg = "";
        if ($mysqli === false) {
            die("ERROR: couldn't connect " . $mysqli->connect_error);
        }
        return $mysqli;
    }
}

?>