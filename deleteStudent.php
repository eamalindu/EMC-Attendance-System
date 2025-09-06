<?php
session_start();
require_once "config.php";

$loggedInUser = $_SESSION["username"];

if ($loggedInUser == "admin") {
    echo "Service Not implemented";
}
else{
    echo "Sorry You are not authorized to<br>perform this action!<br><br>This attempt has been recorded";
}




