<?php
    function mysqli_connection(){
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "spstore";

        $mysqli = new mysqli($host, $username, $password, $database);

        // Check connection
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        return $mysqli;
    }