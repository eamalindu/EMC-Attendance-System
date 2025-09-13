<?php
require_once "../config.php";
require_once "../getIP.php";

// ----- Force download as a text file -----
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="logs.txt"');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

$stmt = $conn->prepare("SELECT * FROM log ORDER BY created DESC");
$stmt->execute();
$result = $stmt->get_result();

// ---------- Format setup ----------
$col1 = 6;   // width for ID
$col2 = 20;  // width for User
$col3 = 50;  // width for Description
$col4 = 20;  // width for Created date

// Header line
$output  = str_pad("ID", $col1)
    . str_pad("User", $col2)
    . str_pad("Description", $col3)
    . str_pad("Created", $col4)
    . "\n";

// Underline
$output .= str_repeat("=", $col1 + $col2 + $col3 + $col4) . "\n";

// Rows
while ($row = $result->fetch_assoc()) {
    $output .= str_pad($row['id'], $col1)
        . str_pad($row['user'], $col2)
        . str_pad($row['description'], $col3)
        . str_pad($row['created'], $col4)
        . "\n";
}

// Send to browser
echo $output;
exit;

