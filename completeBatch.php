<?php
session_start();
require_once "config.php";

$loggedInUser = $_SESSION["username"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $batch = $_POST['batch'];
    $status = 'Completed';

    $stmtCheck = $conn->prepare("SELECT * FROM batch WHERE name  = ? and status != ?");
    $stmtCheck->bind_param("ss", $batch, $status);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();
    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE batch SET status = ? WHERE name = ?");
        $stmt->bind_param("ss", $status, $batch);
        if ($stmt->execute()) {
            echo "OK";
        } else {
            echo "failed: " . $stmt->error;
        }
    } else {
        echo "Batch not found or already completed.";
    }


}
