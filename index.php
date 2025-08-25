<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password); // "ss" = 2 strings
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $_SESSION['loggedIn'] = false;

    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Portal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <div class="left"></div>
    <div class="right">
        <div>
            <img id="mainLogo" src="https://payments.esoft.lk/images/esoft-logo.png" width="50%">

            <div class="login-form">
                <h1>Student Attendance</h1>
                <form action="" method="post">
                    <label>Please Enter Your Username</label>
                    <input type="text" placeholder="Your username" class="inputs" name="username" id="username" required autocomplete="off">
                    <label>Please Enter Your Password</label>
                    <input type="password" placeholder="********" class="inputs" name="password" id="password" required autocomplete="off">
                    <button class="btn">LOGIN</button>
                </form>
                <p style="color: gray;margin-top: 20px;text-decoration: underline;"><a>Forget Password?</a></p>
                <p style="color: gray;margin-top: 20px;position: fixed;bottom: 10px;left: 82%;"><small>Maintained by
                        @eamalindu</small></p>
            </div>
        </div>
    </div>
</div>
<script src="customModal_V2/resources/js/customModal@2.0.min.js"></script>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === false): ?>
    <script>
        showCustomModal('Login Failed', 'error');
    </script>
<?php endif; ?>

</body>
</html>