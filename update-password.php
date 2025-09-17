<?php
session_start();
require 'config.php';

$token = $_GET['token'] ?? '';
if (!$token) {
    $_SESSION['error'] = 'Reset link is invalid or missing.';
    header('Location: Reset-Password.php');
    exit;
}

// Check token validity
$stmt = $conn->prepare("SELECT email FROM reset WHERE token=? AND expire > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = 'Reset link is Expired!';
    header('Location: Reset-Password.php');
    exit;
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link rel="icon" type="image/png" href="images/icon.png" sizes="256x256">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            padding: 0;
            margin: 0;
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
<body>
<div class="container">
    <div class="row vh-100">
        <div class="col-6 d-flex justify-content-center align-items-center">
            <img src="images/update.jpg" class="w-75" alt="Reset Password">
        </div>
        <div class="col-6 p-5 d-flex justify-content-center align-items-center">
            <div class="w-75 border p-3">
                <h2 class="text-center">Update Password</h2>
                <form method="POST">
                    <label class="form-label">Please Enter Your New Password</label>
                    <input class="form-control" type="password" name="password" placeholder="New Password" required>
                    <label class="form-label mt-2">Confirm Your Password</label>

                    <input class="form-control" type="password" name="confirm" placeholder="Confirm Password" required>
                    <button type="submit" class="btn btn-primary mt-3 border-0" style="background-color: #18449c;">Reset Password</button>
                </form>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
<script src="customModal_V2/resources/js/customModal@2.0.min.js"></script>
</body>
</html>