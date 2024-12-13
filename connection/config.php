<?php

function connection() {
    $host = "localhost";
    $user = "root";
    $pw = "";
    $dbname = "itelect";

    $con = new mysqli($host, $user, $pw, $dbname);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    } else {
        return $con;
    }
}

?>