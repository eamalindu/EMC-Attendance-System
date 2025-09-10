<?php
session_start();
header("Content-Type: application/json");

require_once "config.php";

if (isset($_GET['batch'])) {
    $reg = $conn->real_escape_string($_GET['batch']);
    $_SESSION['batch'] = $reg;

}
