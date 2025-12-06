<?php
session_start();
date_default_timezone_set('Asia/Colombo');
require_once "config.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get JSON data from request
    $json = file_get_contents('php://input');
    $students = json_decode($json, true);

    if (!$students || !is_array($students)) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid data format'
        ]);
        exit;
    }

    $addedBy = $_SESSION['username'] ?? 'System';

    $successCount = 0;
    $errorCount = 0;
    $errors = [];

    foreach ($students as $index => $student) {
        try {
            // Validate required fields
            if (empty($student['reg']) || empty($student['name'])) {
                throw new Exception("Missing required fields (reg or name)");
            }

            $reg = trim($student['reg']);
            $name = trim($student['name']);
            $contact = trim($student['contact'] ?? '');
            $batch = trim($student['batch'] ?? '');
            $email = trim($student['email'] ?? '');

            // Check if student already exists
            $stmt = $conn->prepare("SELECT reg FROM student WHERE reg = ? LIMIT 1");
            $stmt->bind_param("s", $reg);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Update existing student
                $stmt_update = $conn->prepare("UPDATE student SET name = ?, contact = ?, batch = ?, email = ?, addedBy = ? WHERE reg = ?");
                $stmt_update->bind_param("ssssss", $name, $contact, $batch, $email, $addedBy, $reg);

                if ($stmt_update->execute()) {
                    $successCount++;
                } else {
                    throw new Exception($stmt_update->error);
                }

                $stmt_update->close();

            } else {
                // Insert new student
                $stmt_insert = $conn->prepare("INSERT INTO student (reg, name, contact, batch, email, addedBy, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
                $stmt_insert->bind_param("ssssss", $reg, $name, $contact, $batch, $email, $addedBy);

                if ($stmt_insert->execute()) {
                    $successCount++;
                } else {
                    throw new Exception($stmt_insert->error);
                }

                $stmt_insert->close();
            }

            $stmt->close();

        } catch (Exception $e) {
            $errorCount++;
            $errors[] = [
                'row' => $index + 1,
                'reg' => $student['reg'] ?? 'N/A',
                'error' => $e->getMessage()
            ];
        }
    }

    $conn->close();

    // Send response
    if ($errorCount === 0) {
        echo json_encode([
            'success' => true,
            'message' => "Successfully uploaded $successCount students"
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'message' => "Uploaded $successCount students with $errorCount errors",
            'successCount' => $successCount,
            'errorCount' => $errorCount,
            'errors' => $errors
        ]);
    }

} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
?>