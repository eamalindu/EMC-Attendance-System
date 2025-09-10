<?php
session_start();
header("Content-Type: application/json");

require_once "config.php";

if (isset($_GET['batch'])) {
    $batch = $conn->real_escape_string($_GET['batch']);
    $_SESSION['batch'] = $batch;

    // Use the correct table and column names
    $sql = "SELECT * FROM batch WHERE name = '$batch'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo json_encode($result->fetch_assoc());
        } else {
            echo json_encode(["error" => "No student found"]);
        }
    } else {
        echo json_encode(["error" => "SQL error: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Missing student reg"]);
}

$conn->close();

?>
