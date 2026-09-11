<?php
$host = "localhost";
$username = "root";
$password = NULL;
$database = "sms";

$conn = new mysqli($host, $username, $password, $database);

if($conn->connect_error)
    {
        die("Not connected to DB".$conn->connect_error);
    }
?>