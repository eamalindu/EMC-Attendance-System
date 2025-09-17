<?php
require 'config.php';

$token = $_GET['token'] ?? '';
if (!$token) {
    die("Invalid token.");
}

// Check token validity
$stmt = $conn->prepare("SELECT email FROM reset WHERE token=? AND expire > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Invalid or expired token.");
}

$row = $result->fetch_assoc();
$email = $row['email'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        echo "Passwords do not match.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Update user's password
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
        $stmt->bind_param("ss", $hash, $email);
        $stmt->execute();

        // Delete token
        $stmt = $conn->prepare("DELETE FROM reset WHERE token=?");
        $stmt->bind_param("s", $token);
        $stmt->execute();

        echo "Password has been reset successfully.";
        exit;
    }
}
?>

<!-- HTML Form -->
<form method="POST">
    <input type="password" name="password" placeholder="New Password" required>
    <input type="password" name="confirm" placeholder="Confirm Password" required>
    <button type="submit">Reset Password</button>
</form>
