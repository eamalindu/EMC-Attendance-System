<?php

$serverName = "localhost";
$username = "root";
$password = "6254638";
$database = "attendance";
$port = "3308";


$conn = new mysqli($serverName, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection Failed : " . $conn->connect_error);

}
?>
