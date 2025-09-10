<?php
session_start();
require_once "config.php";

$username = $_SESSION['username'];
$stmt_log = $conn->prepare("INSERT INTO log (user,description,created) VALUES (?,?,NOW())");
$log = "User Logged Out ";
$stmt_log->bind_param("ss", $username, $log);
$stmt_log->execute();


// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();


// Redirect to login page
header("Location: index.php");
exit();
?>
