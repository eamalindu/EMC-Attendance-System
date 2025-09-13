<?php
require_once "config.php"; // your DB connection
date_default_timezone_set('Asia/Colombo');
$today = strtolower(date('l')); // 'monday', 'tuesday', etc.
$todayDate = date('Y-m-d');     // today's date

// Get batches conducting today
$sql = "SELECT * FROM batch WHERE $today = 1 ORDER BY startTime";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    $count = 0; // to keep track of how many cards are printed in current row

    echo "<div class='row'>"; // open the first row

    while ($row = $result->fetch_assoc()) {
        $batchName = $row['name'];

        // Total students in this batch
        $sqlTotal = "SELECT COUNT(*) AS total_students FROM student WHERE batch = '$batchName'";
        $resultTotal = $conn->query($sqlTotal);
        $rowTotal = $resultTotal->fetch_assoc();
        $totalStudents = $rowTotal['total_students'];

        // Present count (attendance today)
        $sqlAttendance = "SELECT COUNT(DISTINCT reg_id) AS total_attendance
                          FROM attendance
                          WHERE batch_id = '$batchName' AND DATE(timestamp) = '$todayDate'";
        $resultAttendance = $conn->query($sqlAttendance);
        $rowAttendance = $resultAttendance->fetch_assoc();
        $presentCount = $rowAttendance['total_attendance'];

        // Absent = total - present
        $absentCount = $totalStudents - $presentCount;

        // print the column
        echo "
            <div class='col-12 col-lg-4'>
                <div class='card card-body d-flex align-items-center justify-content-center'>
                    <div class='row w-100'>
                        <div class='col-6 text-center'>
                            <h3>{$batchName}</h3>
                            <p class='mb-0 text-muted'>{$row['startTime']} - {$row['endTime']}</p>
                        </div>
                        <div class='col-6 text-center'>
                            <div class='h-50 w-100 border-bottom border-start text-success d-flex align-items-center justify-content-center'>
                                <p class='mb-0'>Present : {$presentCount}</p>
                            </div>
                            <div class='h-50 w-100 border-start text-danger d-flex align-items-center justify-content-center'>
                                <p class='mb-0'>
                                  <a class='text-decoration-none text-danger' href='absent.php?batch={$batchName}&date={$todayDate}'>
                                    Absent : {$absentCount}
                                  </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";

        $count++;

        // after every 3 cards, close the row and start a new one (if more records remain)
        if ($count % 3 == 0 && $count < $result->num_rows) {
            echo "</div><div class='row mt-2'>";
        }
    }

    echo "</div>"; // close the last row
}

 else {
    echo "<p>No batches are conducting today.</p>";
}
?>
