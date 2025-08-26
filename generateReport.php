<?php
header("Content-Type: application/json");

require_once "config.php";


if(isset($_GET["SelectedDate"]) || isset($_GET["SelectedBatch"])) {

    if(isset($_GET["SelectedDate"])) {
        $selectedDate  = $_GET["SelectedDate"];
        $sqlDateOnly = "SELECT reg_id,batch_id,timestamp,addedBY From attendance where day(timestamp) = '$selectedDate'";
        $resultDateOnly = $conn->query($sqlDateOnly);

        if ($resultDateOnly) {
            if ($resultDateOnly->num_rows > 0) {
                echo json_encode($resultDateOnly->fetch_assoc());
            } else {
                echo json_encode(["error" => "No student found"]);
            }
        }

    }
    if(isset($_GET["SelectedBatch"])) {
        $selectedBatch  = $_GET["SelectedBatch"];
        $sqlBatchOnly = "SELECT reg_id,batch_id,timestamp,addedBY FROM attendance where batch_id = '$selectedBatch'";
        $resultBatchOnly = $conn->query($sqlBatchOnly);
        if ($resultBatchOnly) {
            if ($resultBatchOnly->num_rows > 0) {
                echo json_encode($resultBatchOnly->fetch_assoc());

            }
            else{
                echo json_encode(["error" => "No student found"]);
            }
        }
    }

    if(isset($_GET["SelectedDate"]) && isset($_GET["SelectedBatch"])) {
        $selectedDate  = $_GET["SelectedDate"];
        $selectedBatch  = $_GET["SelectedBatch"];

        $sqlBothSelected = "reg_id,batch_id,timestamp,addedBY FROM attendance where batch_id = '$selectedBatch'and day(timestamp) = '$selectedDate' ";
        $resultBothSelected = $conn->query($sqlBothSelected);
        if ($resultBothSelected) {
            if ($resultBothSelected->num_rows > 0) {
                echo json_encode($resultBothSelected->fetch_assoc());

            }
            else{
                echo json_encode(["error" => "No student found"]);
            }
        }
    }

}




?>