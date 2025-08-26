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

}




?>