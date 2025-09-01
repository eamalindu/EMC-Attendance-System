<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Student</title>
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
    <h2 class="mb-3">Manage Students</h2>
    <?php

    require_once "config.php";

    $sql = "SELECT * FROM student";
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
                    <th> Status</th>
                    <th>Action</th>
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
            echo "<td>".$row["pStatus"]."</td>";
            echo "<td>".$row["sStatus"]."</td>";
            echo "<td><button class='btn btn-secondary btn-sm'>View</button></td>";
            $rowIndex++;

        }
        echo "</tbody></table>";
    }
    ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
<script src="customModal_V2/resources/js/customModal@2.0.min.js"></script>
<script src="js/loader.js"></script>
</body>
</html>
