<?php
require_once "config.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attendance Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/aquawolf04/font-awesome-pro@5cd1511/css/all.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/loader.css">
</head>
<body>
<div class="preloader w-100 min-vh-100">
    <div class="loader"></div>
</div>
<div class="container p-5">
    <h2 class="mb-3">Attendance Report</h2>
    <div class="row mb-4">
        <div class="col-12 col-lg-6 p-0">
            <div class="d-flex w-100">
                <input type="date" id="date" name="date" placeholder="Enter Your Reg Number" class="w-50 form-control">
                <select class="form-select w-50 ms-2" id="batch" name="batch">
                   <?php
                        echo "<option value='' disabled selected>Select Batch</option>";
                        $sql = "SELECT DISTINCT batch FROM student order by batch asc";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['batch'] . "'>" . $row['batch'] . "</option>";
                        }
                   ?>
                </select>
                <button type="button" id="btnAttendance" onclick="generateReport()" class="ms-2 btn btn-success text-white rounded-0">
                    Search
                </button>
                <button type="button" id="btnClear" class="btn btn-danger bg-red ms-2 rounded-0">X</button>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <button id="exportBtn" class="btn btn-secondary btn-small d-block float-end rounded-0"><i
                        class="fa-solid fa-file-excel"></i>
                Export
            </button>
        </div>
    </div>
    <table class="table table-striped table-hover table-sm" id="tblReport">
        <thead></thead>
        <tbody></tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
<script src="customModal_V2/resources/js/customModal@2.0.min.js"></script>
<script src="loader.js"></script>
<script src="external-table.js"></script>
<script src="report.js"></script>
</body>
</html>