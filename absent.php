<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absent Students</title>
    <link rel="icon" type="image/png" href="images/icon.png" sizes="256x256">
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
    <h2 class="mb-3">Absent Report</h2>
    <div class="row mb-4">
        <div class="col-12 col-lg-6 p-0">
            <div class="d-flex w-100">
                <input type="date" id="date" name="date" placeholder="Enter Your Reg Number"
                       class="w-50 form-control" <?php echo "value='" . (isset($_GET['date']) ? htmlspecialchars($_GET['date']) : '') . "'"; ?>>
                <select class="form-select w-50 ms-2" id="batch" name="batch">
                    <?php
                    require_once("config.php");
                    $sql = "SELECT DISTINCT batch FROM student order by batch asc";
                    $result = mysqli_query($conn, $sql);
                    echo "<option value='' disabled selected>Select Batch</option>";
                    while ($row = mysqli_fetch_assoc($result)) {

                        if (isset($_GET) && $_GET['batch'] == $row['batch']) {
                            echo "<option value='" . $row['batch'] . "' selected>" . $row['batch'] . "</option>";
                        } else {
                            echo "<option value='" . $row['batch'] . "'>" . $row['batch'] . "</option>";
                        }
                    }

                    ?>
                </select>
                <button type="button" id="btnAttendance"
                        class="ms-2 btn btn-success text-white rounded-0">
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


    <?php
    if (isset($_GET['date']) && isset($_GET['batch'])) {
        $batch = $_GET["batch"];
        $date = $_GET["date"];

        $sql = "SELECT * FROM student WHERE batch = '$batch' 
            AND reg NOT IN (
                SELECT reg_id FROM attendance 
                WHERE batch_id = '$batch' AND DATE(timestamp) = '$date'
            )";
        $result = mysqli_query($conn, $sql);

        echo "<table id='tle' class='table w-100 table-bordered table-striped'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Registration Number</th>
                    <th>EID</th>
                    <th>Batch</th>
                    <th>Contact</th>
                    <th>Parent Contact</th>
                </tr>
            </thead>
            <tbody>";

        if ($result && $result->num_rows > 0) {
            $count = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$count}</td>
                    <td>" . htmlspecialchars($row["name"]) . "</td>
                    <td>" . htmlspecialchars($row["reg"]) . "</td>
                    <td>" . htmlspecialchars($row['eid']) . "</td>
                    <td>" . htmlspecialchars($row['batch']) . "</td>
                    <td>" . htmlspecialchars($row['contact']) . "</td>
                    <td>" . htmlspecialchars($row["pStatus"]) . "</td>
                  </tr>";
                $count++;
            }
        }

        echo "</tbody></table>";

    } else {
        // Empty table if date or batch not set
        echo "<table id='tle' class='table w-100 table-bordered table-striped'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Registration Number</th>
                    <th>EID</th>
                    <th>Batch</th>
                    <th>Contact</th>
                    <th>Parent Contact</th>
                </tr>
            </thead>
            <tbody></tbody>
          </table>";
    }
    ?>

    <button class="btn btn-secondary mt-4 mx-auto d-block"><a href="dashboard.php"
                                                              class="text-white text-decoration-none">Back To
            Dashboard</a></button>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

<script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
<script src="customModal_V2/resources/js/customModal@2.0.min.js"></script>
<script>
    new DataTable('#tle')
</script>
<script>
    document.getElementById('exportBtn').addEventListener('click', function () {
        // Get the table element
        let table = document.getElementById('tle');

        if (!table) {
            alert("Table not found!");
            return;
        }

        // Convert HTML table to a worksheet
        let workbook = XLSX.utils.book_new();
        let worksheet = XLSX.utils.table_to_sheet(table);

        // Add worksheet to workbook
        XLSX.utils.book_append_sheet(workbook, worksheet, "Absent");

        // Export workbook to file
        XLSX.writeFile(workbook, "absent-list " + batch.value + " (" + date.value + ").xlsx");
    });

</script>
<script src="js/loader.js"></script>
<script>
    document.getElementById("btnAttendance").addEventListener('click', function () {
        if (batch.value !== "" && date.value !== "") {
            window.location.href = "absent.php?batch=" + batch.value + "&date=" + date.value;
        } else {
            showCustomModal("Both Batch and Date is Required!", "warning");
        }
    })
</script>
</body>
</html>
