<?php
header("Content-Type: application/json");

require_once "config.php";

if (isset($_GET["SelectedDate"]) && isset($_GET["SelectedBatch"])) {
    // Both selected
    $selectedDate = $_GET["SelectedDate"];
    $selectedBatch = $_GET["SelectedBatch"];

    $sql = "SELECT reg_id,batch_id,timestamp,addedBY FROM attendance WHERE batch_id = '$selectedBatch' AND DAY(timestamp) = '$selectedDate'";
} elseif (isset($_GET["SelectedDate"])) {
    // Date only
    $selectedDate = $_GET["SelectedDate"];
    $sql = "SELECT reg_id,batch_id,timestamp,addedBY FROM attendance WHERE DAY(timestamp) = '$selectedDate'";
} elseif (isset($_GET["SelectedBatch"])) {
    // Batch only
    $selectedBatch = $_GET["SelectedBatch"];
    $sql = "SELECT reg_id,batch_id,timestamp,addedBY FROM attendance WHERE batch_id = '$selectedBatch'";
} else {
    echo json_encode(["error" => "No parameters provided"]);
    exit;
}

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(["error" => "No student found"]);
}


?>