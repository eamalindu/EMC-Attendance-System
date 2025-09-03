<?php

require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reg = $_POST['reg'];
    $name = $_POST['name'];
    $batch = $_POST['batch'];
    $contact = $_POST['contact'];
    $pContact = $_POST['pContact'];
    $status = $_POST['status'];

    $stmt = "UPDATE student SET name= ?, batch= ?, contact =?, pStatus = ?,sStatus = ? WHERE reg = ? ";
    $stmt -> bind_param("ssssss", $name, $batch, $contact, $pContact, $status, $reg);
    $stmt-> execute();

    if($stmt->execute()){
        echo "Ok";

    } else {
        echo "failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();


}