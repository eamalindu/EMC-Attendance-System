<?php
session_start();
require_once "config.php";

$loggedInUser = $_SESSION["username"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //TODO: need to check whether batch is available and if already completed
    $batch = $_POST['batch'];

    $stmt = $conn->prepare("UPDATE batch SET status = ? WHERE name = ?");
    $status = 'Completed';
    $stmt->bind_param("ss", $status, $batch);
    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "failed: " . $stmt->error;
    }


}
