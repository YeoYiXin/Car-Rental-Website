<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "COMP1044_database";


    $conn = new mysqli($hostname, $username, $password, $dbname);

   
    if ($conn->connect_error) {
        die ($conn->connect_error);
    }
?>