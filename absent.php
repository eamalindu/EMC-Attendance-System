<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/aquawolf04/font-awesome-pro@5cd1511/css/all.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="css/loader.css">
</head>
<body>
<div class="preloader w-100 min-vh-100">
    <div class="loader"></div>
</div>
<div class="container p-5">
    <div class="row m-0 mb-4">
        <div class="col-1 p-0">
            <a class="btn btn-secondary btn-small" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
        <div class="col-10 p-0">
            <h2 class="text-center">Absent Students</h2>
        </div>
        <div class="col-1 p-0">
            <button id="exportBtn" class="btn btn-success btn-small d-block float-end"><i
                    class="fa-solid fa-file-excel"></i>
                Export
            </button>
        </div>
    </div>


<?php
require_once("config.php");

$batch = $_GET["batch"];
$date = $_GET["date"];


$sql =  "select * from student where batch = '$batch' and reg not in (select reg_id from attendance where batch_id = '$batch' and date(timestamp ) = '$date')";
$result = mysqli_query($conn, $sql);

if($result->num_rows > 0){
    $count = 1;
    while ($row = $result->fetch_assoc()) {

    }
}

?>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

<script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="customModal_V2/resources/js/customModal@2.0.min.js"></script>
<script>
    new DataTable('#tle')
</script>

<script src="loader.js"></script>
</body>
</html>
