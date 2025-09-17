<?php
session_start();
include_once "config.php";
include_once "getIP.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    //check user account exist
    $stmt_check = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    if($result->num_rows > 0) {
        //if exists send email and add record to database
        echo "OK";
    }
    else {
        echo "No User Account Found!";
    }

}

