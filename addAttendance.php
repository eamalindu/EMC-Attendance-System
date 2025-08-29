<?php

require_once "sms.php";
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reg = $_POST['reg'];
    $contact = $_POST['contact'];

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

    // Check if student has already marked attendance today
    $check_sql = "SELECT timestamp FROM attendance WHERE reg_id = ? AND DATE(timestamp) = CURDATE() LIMIT 1";

    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("s", $reg);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    $row = $result->fetch_assoc();
    if ($row) {
        // format timestamp
        $markedTime = date("h:i A", strtotime($row['timestamp']));
        echo "Duplicate entry detected!<br><br>Today’s attendance has already been <br><br>submitted at <span class='text-primary'>$markedTime.</span>";

    } else {
        // Insert new record
        $stmt_insert = $conn->prepare("INSERT INTO attendance (reg_id, batch_id, timestamp, addedBy) VALUES (?, ?, NOW(), ?)");

        $user = "System";
        $correctContact = "94" . ltrim($contact, "0");

        $msg = "Dear Parent, your child has attended today’s class.\nESOFT Nittambuwa";

        $stmt_insert->bind_param("sss", $reg, $batch, $user);

        if($stmt_insert->execute()){
            echo "Ok";
        } else {
            echo "failed: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
    $conn->close();


}