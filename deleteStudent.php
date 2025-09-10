<?php
session_start();
require_once "config.php";

$loggedInUser = $_SESSION["username"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reg = $_POST['reg'];

    if ($loggedInUser == "admin") {
        $stmt = $conn->prepare("UPDATE student SET sStatus = 'Deleted' WHERE reg = ?");
        $stmt->bind_param("s", $reg);
        if ($stmt->execute()) {
            echo "OK";
        } else {
            echo "failed: " . $stmt->error;
        }
    } else {

        $stmt_log = $conn->prepare("INSERT INTO log (user,description,created) VALUES (?,?,NOW())");
        $log = "User try to Delete the Student ".$reg;
        $stmt_log->bind_param("ss", $loggedInUser, $log);
       if ($stmt_log->execute()) {
           echo "Sorry You are not authorized to<br>perform this action!<br><br>This attempt has been recorded";
       }
       else{
           echo "failed: " . $stmt_log->error;
       }


    }
}




