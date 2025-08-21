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
    }
    $stmt->close();

    $stmt_insert = $conn->prepare("INSERT INTO attendance (reg_id, batch_id,timestamp,addedBy) VALUES(?, ?,?,?)");
    $time = time();
    $user = "System";

    $stmt_insert->bind_param("ssss", $reg, $batch, $time,$user);
    if($stmt_insert->execute()){
        echo "Ok";
    }
    else{
        echo "failed";
    }

    $stmt_insert->close();
    $conn->close();



}