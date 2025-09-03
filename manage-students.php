<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/aquawolf04/font-awesome-pro@5cd1511/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/loader.css">
</head>
<body>
<div class="preloader w-100 min-vh-100">
    <div class="loader"></div>
</div>
<div class="container p-5">
    <h2 class="mb-3">Manage Students</h2>
    <?php

    require_once "config.php";

    $sql = "SELECT * FROM student order by reg asc";
    $result = $conn->query($sql);
    $rowIndex = 1;
    if (!$result) {
        echo "SQL Error: " . $conn->error;
        exit;
    }

    if ($result->num_rows > 0) {
        echo "<table id='tle' class='table w-100 table-bordered table-striped text-center'>
            <thead class='text-center'>
                <tr class='text-center'>
                    <th class='text-center'>#</th>
                    <th class='text-center'>Name</th>
                    <th class='text-center'>Reg</th>
                    <th class='text-center'>EID</th>
                    <th class='text-center'>Batch</th>
                    <th class='text-center'>Contact</th>
                    <th class='text-center'>Parent Contact</th>
                    <th class='text-center'> Status</th>
                    <th class='text-center'>Action</th>
                </tr>
            </thead>
            <tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr class='text-center'>";
            echo "<td>" . $rowIndex . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["reg"] . "</td>";
            echo "<td>" . $row['eid'] . "</td>";
            echo "<td>" . $row['batch'] . "</td>";
            echo "<td class='text-center'>0" . $row['contact'] . "</td>";
            echo "<td class='text-center'>0" . $row["pStatus"] . "</td>";
            echo "<td class='text-center'>" . $row["sStatus"] . "</td>";
            echo "<td><button class='btn btn-success btn-sm' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasExample' aria-controls='offcanvasExample' onclick='getStudent(this)' data-reg='" . htmlspecialchars($row['reg']) . "'><i class='fa-solid fa-eye'></i></button>
                  <button class='btn btn-outline-danger btn-sm' onclick='deleteStudent(this)' data-reg='" . htmlspecialchars($row['reg']) . "'><i class='fa-solid fa-trash'></i></button>
                    </td>";
            $rowIndex++;

        }
        echo "</tbody></table>";
    }
    ?>
    <button class="btn btn-secondary mt-4 mx-auto d-block"><a href="dashboard.php"
                                                              class="text-white text-decoration-none">Back To
            Dashboard</a></button>
</div>

<!--offcanvas-->
<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="offcanvasExample"
     aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Manage Student Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="mb-2">
            <label for="sNAme" class="form-label">Student Name</label>
            <input type="text" class="form-control rounded-0" id="sNAme" placeholder="John Doe">
        </div>
        <div class="mb-2">
            <label for="sEID" class="form-label">Student EID</label>
            <input type="text" class="form-control rounded-0" id="sEID" placeholder="EXXXXXX">
        </div>
        <div class="mb-2">
            <label for="sREG" class="form-label">Student Registration</label>
            <input type="text" class="form-control rounded-0" id="sREG" placeholder="00XXXX">
        </div>
        <div class="mb-2">
            <label for="sBatch" class="form-label">Student Batch</label>
            <select class="form-select rounded-0" id="sBatch" name="sBatch">
                <?php
                echo "<option value='' disabled selected>Select Batch</option>";
                $sql = "SELECT DISTINCT name FROM batch order by name asc";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-2">
            <label for="sContact" class="form-label">Student Contact</label>
            <input type="text" class="form-control rounded-0" id="sContact" placeholder="07X-XXXX-XXXX">
        </div>
        <div class="mb-2">
            <label for="pContact" class="form-label">Parent Contact</label>
            <input type="text" class="form-control rounded-0" id="pContact" placeholder="07X-XXXX-XXXX">
        </div>
        <div class="mb-4">
            <label for="sBatch" class="form-label">Student Status</label>
            <select class="form-select rounded-0" id="sBatch" name="sBatch">
                <?php
                echo "<option value='' disabled selected>Select Status</option>";
                $sql = "SELECT DISTINCT sStatus FROM student order by sStatus asc";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['sStatus'] . "'>" . $row['sStatus'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-2 d-flex justify-content-between align-items-center ">
            <button class="btn btn-primary w-25" id="btnStudentRegister">Register</button>
            <button class="btn btn-warning text-white w-25" id="btnStudentUpdate">Update</button>
            <button class="btn btn-secondary w-25" id="btnStudentReset">Reset</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

<script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
<script src="customModal_V2/resources/js/customModal@2.0.min.js"></script>
<script src="js/loader.js"></script>
<script src="js/manageStudents.js"></script>
</body>
</html>
