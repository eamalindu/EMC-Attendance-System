<?php
session_start();
require_once "config.php";

$loggedInUser = $_SESSION["username"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reg = $_POST['reg'];

    if ($loggedInUser == "admin") {
        echo "Service Not implemented";

        $stmt = $conn->prepare("UPDATE student SET sStatus = 'Deleted' WHERE reg = ?");
        $stmt->bind_param("s", $reg);
        if ($stmt->execute()) {
            echo "OK";
        }
        else{
            echo "failed: " . $stmt->error;
        }
    } else {
        echo "Sorry You are not authorized to<br>perform this action!<br><br>This attempt has been recorded";
    }
}




