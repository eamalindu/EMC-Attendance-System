<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: index.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mark Attendance</title>
    <link rel="icon" type="image/png" href="images/icon.png" sizes="256x256">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/loader.css">
</head>
<body>
<div class="preloader w-100 min-vh-100">
    <div class="loader"></div>
</div>
<div class="container p-5">
    <h2 class="mb-3">Mark Attendance</h2>
    <div class="row mb-4">
        <div class="col-12 p-0 input-group">
            <input type="text" id="search" name="search" placeholder="Enter Your Reg Number - [Example: 224586]" class="w-75 form-control"
                   onkeyup="getStudent()">
            <button type="button" id="btnMark" onclick="markAttendance()" class="w-25 btn btn-success">Mark</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-0 col-lg-7" style="height: 400px">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div class="h-100 d-flex justify-content-center align-items-center d-none" id="noResult">
                        <h3 class="text-muted"> No Results Found!</h3>
                    </div>
                    <div class="w-100" id="result">

                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">Student Name</span>
                            <input type="text" class="form-control fw-bold" id="sName" placeholder="John Doe"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">Student EID</span>
                            <input type="text" class="form-control fw-bold" id="sEID" placeholder="Exxxxxx"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">Student Batch</span>
                            <input type="text" class="form-control fw-bold" id="sBatch" placeholder="L4-DiSE-01"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">Student Contact</span>
                            <input type="text" class="form-control fw-bold" id="sContact" placeholder="07x xxxx xxx"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">Parent contact</span>
                            <input type="text" class="form-control fw-bold" id="sPContact" placeholder="Paid"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">Student Status</span>
                            <input type="text" class="form-control fw-bold" id="sStatus" placeholder="Paid"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <a class="text-muted text-center d-block mx-0 cursor-pointer" onclick="goToHistory()"
                           target="_blank">Attendance History</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-12 p-1"></div>
        <div class="col-lg-4 col-12 p-0">
            <div class="card h-100 d-flex justify-content-center align-items-center">
                <img src="images/img.png" id="profile" width="75%">
            </div>
        </div>
    </div>
        <button class="btn btn-secondary mt-4 mx-auto d-block"><a href="dashboard.php" class="text-white text-decoration-none">Back To Dashboard</a></button>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
<script src="customModal_V2/resources/js/customModal@2.0.min.js"></script>
<script src="js/app.js"></script>
<script src="js/loader.js"></script>
</body>
</html>
