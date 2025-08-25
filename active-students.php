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
</head>
<body>
<div class="container p-5">
    <div class="row m-0 mb-4">
        <div class="col-1 p-0">
            <a class="btn btn-secondary btn-small" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
        <div class="col-10 p-0">
            <h2 class="text-center">Active Students</h2>
        </div>
        <div class="col-1 p-0">
            <button id="exportBtn" class="btn btn-success btn-small d-block float-end"><i
                    class="fa-solid fa-file-excel"></i>
                Export
            </button>
        </div>
    </div>

    <?php

    require_once "config.php";

    $sql = "SELECT * FROM student WHERE sStatus = 'active'";
    $result = $conn->query($sql);
    $rowIndex = 1;
    if (!$result) {
        echo "SQL Error: " . $conn->error;
        exit;
    }

    if ($result->num_rows > 0) {
        echo "<table id='tle' class='table w-100 table-bordered table-striped '>
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

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $rowIndex . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["reg"] . "</td>";
            echo "<td>" . $row['eid'] . "</td>";
            echo "<td>" . $row['batch'] . "</td>";
            echo "<td>" . $row['contact'] . "</td>";
            echo "<td>".$row["pStatus"]."</td></tr>";
            $rowIndex++;

        }
        echo "</tbody></table>";
    }
    ?>



</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

<script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
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
        XLSX.utils.book_append_sheet(workbook, worksheet, "Active Students");

        // Export workbook to file
        XLSX.writeFile(workbook, "Active Students.xlsx");
    });

</script>
</body>
</html>
