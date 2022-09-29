<?php

class DBConnect {
    function InitConnect() {
        $DB_SERVER='127.0.0.1';
        $DB_USERNAME='root';
        $DB_PASSWORD='hoanguzumaki123';
        $DB_NAME='classroom5a';
    
        $link = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    
        // check connection
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        } 
    
        return $link;
    }
}

