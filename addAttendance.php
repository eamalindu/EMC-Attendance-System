<?php

require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reg = $_POST['reg'];

// prepare query
    $stmt = $conn->prepare("SELECT batch FROM student WHERE reg = ? LIMIT 1");
    $stmt->bind_param("s", $reg); // "s" = string

    $stmt->execute();
    $resultBatch = $stmt->get_result();

    if ($resultBatch->num_rows > 0) {
        $row = $resultBatch->fetch_assoc();
        $batch = $row['batch'];
    } else {
        $batch = null;
    }

    $stmt->close();



}