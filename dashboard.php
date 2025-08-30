<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: index.php");
    exit();
}
?>
<?php

require_once "config.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/aquawolf04/font-awesome-pro@5cd1511/css/all.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/loader.css">
</head>
<body>
<div class="preloader w-100 min-vh-100">
    <div class="loader"></div>
</div>
<div class="container p-4">
    <span class="mb-4 h3">Dashboard</span>
    <span class="float-end h3 text-capitalize">
         <?php echo "Hello, " . $_SESSION["username"]; ?> 👋
    </span>

    <p class="mt-4">Current Records</p>
    <div class="row">
        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
            <div class="card card-body border-0 card-green" onclick="window.location.href='active-students.php';">
                <div class="row h-100">
                    <div class="w-75 float-start text-white">
                        <h3>
                            <?php
                            $sql = "SELECT count(*) FROM student where sStatus = 'Active'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                            ?>
                        </h3>
                        Active Students
                    </div>
                    <div class="w-25 float-start d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user-check fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
            <div class="card card-body border-0 card-yellow">
                <div class="row h-100">
                    <div class="w-75 float-start text-white">
                        <h3>
                            <?php
                            $sql = "SELECT count(*) FROM student where sStatus = 'Postponed'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            echo "0" . $row[0];
                            ?>
                        </h3>
                        Postponed Students
                    </div>
                    <div class="w-25 float-start d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user-clock fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
            <div class="card card-body border-0 card-orange">
                <div class="row h-100">
                    <div class="w-75 float-start text-white">
                        <h3>
                            <?php
                            $sql = "SELECT count(*) FROM student where sStatus = 'Suspended'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            echo "0" . $row[0];
                            ?>
                        </h3>
                        Suspended Students
                    </div>
                    <div class="w-25 float-start d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user-slash fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
            <div class="card card-body border-0 card-red">
                <div class="row h-100">
                    <div class="w-75 float-start text-white">
                        <h3>
                            <?php
                            $sql = "SELECT count(*) FROM student where sStatus = 'Inactivated'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                            ?>
                        </h3>
                        Inactive Students
                    </div>
                    <div class="w-25 float-start d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user-xmark fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="mt-4">Quick Access </p>

    <div class="container-fluid p-0">
        <div class="card-footer pt-2 pb-2">
            <div class="row">
                <div class="col-lg-4 col-12 mb-3 mb-lg-0">
                    <a href="attendance.php" class="text-decoration-none">
                        <div class="card card-body rounded-0 h-100 pointer text-muted dashboard-widget-yellow">
                            <div class="row h-100">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <div class="d-flex align-items-center justify-content-center"
                                         style="border-radius: 50%;height: 60px;width: 60px;background: #fff7e5">
                                        <i aria-hidden="true" class="fa-solid fa-user-graduate"
                                           style="color:#FDE74C;font-size: 25px"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-around">
                                    <span class="text-uppercase">Mark Attendance</span>

                                </div>

                            </div>

                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-12 mb-3 mb-lg-0">
                    <a href="update-barcode.php" class="text-decoration-none">
                        <div class="card card-body rounded-0 h-100 pointer text-muted dashboard-widget-red">
                            <div class="row h-100">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <div class="d-flex align-items-center justify-content-center"
                                         style="border-radius: 50%;height: 60px;width: 60px;background: #f7dddd">
                                        <i aria-hidden="true" class="fa-solid fa-barcode"
                                           style="color:#fd4c4c;font-size: 25px"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-around">
                                    <span class="lh-1 text-uppercase">Update Barcode</span>


                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-12 mb-lg-0">
                    <a href="attendance-report.php" class="text-decoration-none">
                        <div class="card card-body rounded-0 h-100 text-muted dashboard-widget-green">
                            <div class="row h-100">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <div class="d-flex align-items-center justify-content-center"
                                         style="border-radius: 50%;height: 60px;width: 60px;background: #DDF6F7">
                                        <i aria-hidden="true" class="fa-solid fa-file-arrow-down"
                                           style="color:#1ec781;font-size: 25px"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-around">
                                    <span class="text-uppercase">Attendance Report</span>


                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-4 col-12 mb-3 mb-lg-0">
                    <a aria-controls="offcanvasRight" aria-current="page" class="text-decoration-none"
                       data-bs-target="#offCanvasInquiry" data-bs-toggle="offcanvas">
                        <div class="card card-body rounded-0 h-100 pointer text-muted dashboard-widget-blue">
                            <div class="row h-100">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <div class="d-flex align-items-center justify-content-center"
                                         style="border-radius: 50%;height: 60px;width: 60px;background: #c1eaff">
                                        <i aria-hidden="true" class="fa-solid fa-upload"
                                           style="color:#1e7bc7;font-size: 25px"></i>
                                    </div>
                                </div>
                                <div class="col-9 lh-1 d-flex align-items-center justify-content-center">
                                    <div class="lh-1">
                                        <span class="text-uppercase">Upload New Batch Details</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-12 mb-3 mb-lg-0">
                    <a aria-controls="offcanvasRight" aria-current="page" class="text-decoration-none"
                       data-bs-target="#offCanvasInquiry" data-bs-toggle="offcanvas">
                        <div class="card card-body rounded-0 h-100 pointer text-muted dashboard-widget-purple">
                            <div class="row h-100">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <div class="d-flex align-items-center justify-content-center"
                                         style="border-radius: 50%;height: 60px;width: 60px;background: #dfc1ff">
                                        <i aria-hidden="true" class="fa-solid fa-user-gear"
                                           style="color:rebeccapurple;font-size: 25px"></i>
                                    </div>
                                </div>
                                <div class="col-9 lh-1 d-flex align-items-center justify-content-center">
                                    <div class="lh-1">
                                        <span class="text-uppercase">Manage Students</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-12">
                    <a aria-controls="offcanvasRight" aria-current="page" class="text-decoration-none"
                       data-bs-target="#offCanvasInquiry" data-bs-toggle="offcanvas">
                        <div class="card card-body rounded-0 h-100 pointer text-muted dashboard-widget-orange">
                            <div class="row h-100">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <div class="d-flex align-items-center justify-content-center"
                                         style="border-radius: 50%;height: 60px;width: 60px;background: #ffddc1">
                                        <i aria-hidden="true" class="fa-solid fa-comment-sms"
                                           style="color:orange;font-size: 25px"></i>
                                    </div>
                                </div>
                                <div class="col-9 lh-1 d-flex align-items-center justify-content-center">
                                    <div class="lh-1">
                                        <span class="text-uppercase">SMS Portal</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>


    </div>
    <p class="mt-4">Class Schedule</p>

    <div class="row">
        <?php include "todayClassList.php"

        ?>


    </div>

</div>
<div class="logout">
    <button class="btn btn-danger btn-sm" onclick="logout()">Logout</button>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
<script src="customModal_V2/resources/js/customModal@2.0.min.js"></script>
<script src="js/logout.js"></script>
<script src="js/loader.js"></script>
</body>
</html>
