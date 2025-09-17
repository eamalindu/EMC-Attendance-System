<?php
session_start();
date_default_timezone_set('Asia/Colombo');
include_once "config.php";
include_once "getIP.php";
include_once "mailTemplate.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    //check user account exist
    $stmt_check = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $stmt = $conn->prepare("INSERT INTO reset (email, token, expire) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $token, $expiry);

        //check if there is any old reset links if present delete before adding the new record
        $stmt_Delete = $conn->prepare("DELETE FROM reset WHERE email = ?");
        $stmt_Delete->bind_param("s", $email);
        $stmt_Delete->execute();

        if ($stmt->execute()) {

            $link = "http://192.168.1.3/Attendance/update-password.php?token=" . $token;

            if(sendPasswordResetMail($email, $link)=="OK"){
                //if exists send email and add record to database
                echo "OK";
            }
            else{
                echo "Please Try Again Later";
            }

        } else {
            echo "ERROR" . $stmt->error;
        }


    } else {
        echo "No User Account Found!";
    }

}

