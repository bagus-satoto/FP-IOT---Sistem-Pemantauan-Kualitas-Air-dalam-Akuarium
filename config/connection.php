<?php
    $host = "localhost";
    $username = "root";
    $pass = "";
    $db_name = "db_monitoring";

    $connect = mysqli_connect($host, $username, $pass, $db_name);

    if(!$connect){
        die("Failed to connect database :".mysqli_connect_error());
    }

?>