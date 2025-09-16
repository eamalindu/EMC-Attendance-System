<?php
session_start();
require_once "config.php";

$loggedInUser = $_SESSION["username"];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $batch = $_POST['batch'];


}
