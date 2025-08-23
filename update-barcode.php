<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mark Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.css">
</head>
<body>
<div class="container p-5">
    <h2 class="mb-3">Update Barcode (Student Access Card)</h2>
    <div class="row mb-4">
        <div class="col p-0 input-group">
            <input type="text" id="search" name="search" placeholder="Enter Your Reg Number" class="w-75 form-control" onkeyup="getStudent()">
            <button type="button" id="btnMark" onclick="markAttendance()" class="w-25 btn btn-success">Mark</button>
        </div>
    </div>

</div>
</body>
</html>