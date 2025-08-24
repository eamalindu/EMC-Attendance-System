<?php
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reg = $_POST["reg"];
    $barcode = $_POST["barcode"];


    $stmt = $conn->prepare("UPDATE `student` SET `barcode`=? WHERE `reg`=?");
    $stmt->bind_param("ss", $barcode, $reg);

    if ($stmt->execute()) {
        echo "Ok";
    } else {
        echo "failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

}

?>