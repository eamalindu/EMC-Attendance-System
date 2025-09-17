<?php
session_start();
include_once "config.php";
include_once "getIP.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "OK";
}

