<?php
require_once("config.php");

$batch = $_GET["batch"];
$date = $_GET["date"];


$sql =  "select * from student where batch = '$batch' and reg not in (select reg_id from attendance where batch_id = '$batch' and date(timestamp ) = '$date')";
$result = mysqli_query($conn, $sql);

if($result->num_rows > 0){
    $count = 1;
    while ($row = $result->fetch_assoc()) {
        echo $count."  ".$row['reg']."".$row['name']."".$row['batch']."<br>";
        $count++;
    }
}


