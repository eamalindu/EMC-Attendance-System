<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
</head>
<body>
<div class="container">
    <div class="row vh-100">
        <div class="col-6 d-flex justify-content-center align-items-center">
            <img src="images/reset.png" class="w-100" alt="Reset Password">
        </div>
        <div class="col-6 p-5 d-flex justify-content-center align-items-center">
            <div class="w-75 border p-3">
            <h2 class="text-center">Reset Password</h2>
                <form class="p-1" action="#">
                    <label class="form-label">Please Enter Your Email</label>
                    <input type="text" class="form-control" placeholder="Enter your email here" id="email" required autocomplete="off">
                    <button class="btn btn-primary mt-3 border-0" style="background-color: #18449c;" id="btnSend" type="button">Send Reset Link</button>
                </form>
                <a class="text-muted mt-2 d-block text-center" href="index.php">Back To Home</a>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
<script src="customModal_V2/resources/js/customModal@2.0.min.js"></script>
<script>
    document.getElementById("btnSend").addEventListener("click", function() {
        btnSend.innerHTML = '  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...';
        let email = document.getElementById("email");
        if(email.value !== ""){
            formData = new FormData();
            formData.append("email", email.value);
            fetch("processReset.php",{
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                console.log(data);
                if(data.trim()==="OK"){

                    showCustomModal("A password reset link has<br>been emailed to you.<br><br><i>Please check your inbox and follow the instructions provided</i>","success");
                    email.value = "";
                    btnSend.innerHTML = "Send Reset Link";
                }
                else{
                    showCustomModal(data, 'error');
                }

            })
                .catch(err => console.log(err));

        }
        else{
           showCustomModal("Please Enter Your Email Address","warning");
        }
    })
</script>
<?php
session_start();
if (isset($_SESSION['error'])) {
    echo '<script>showCustomModal("'.htmlspecialchars($_SESSION['error']).'","error")</script>';
    unset($_SESSION['error']); // clear after displaying
}

if (isset($_SESSION['success'])) {
    echo '<script>showCustomModal("' . ($_SESSION['success']) . '","success"); setTimeout(() => {
                                location.href = "index.php";
                            }, 5000);</script>';
    unset($_SESSION['success']); // clear after displaying
}

?>

</body>
</html>