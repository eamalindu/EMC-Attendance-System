<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Barcode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.css">
</head>
<body>
<div class="container p-5">
    <h2 class="mb-3">Update Barcode (Student Access Card)</h2>
    <div class="row mb-4">
        <div class="col-6 p-0 ">
            <div class="input-group w-100">
                <input type="text" id="search" name="search" placeholder="Enter Your Reg Number" class="w-25 form-control" onkeyup="getStudent()">
                <input type="text" id="barcode" name="barcode" placeholder="Scan Bar Code" class="w-25 form-control">
                <button type="button" id="updateBar" onclick="" class="btn btn-warning text-white">Update</button>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 p-0 col-lg-6" style="height: 400px">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div class="h-100 d-flex justify-content-center align-items-center d-none" id="noResult">
                        <h3 class="text-muted"> No Results Found!</h3>
                    </div>
                    <div class="w-100" id="result">

                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">Student Name</span>
                            <input type="text" class="form-control fw-bold" id="sName" placeholder="John Doe"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">Student EID</span>
                            <input type="text" class="form-control fw-bold" id="sEID" placeholder="Exxxxxx"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">Student Batch</span>
                            <input type="text" class="form-control fw-bold" id="sBatch" placeholder="L4-DiSE-01"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">Student Contact</span>
                            <input type="text" class="form-control fw-bold" id="sContact" placeholder="07x xxxx xxx"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">Parent contact</span>
                            <input type="text" class="form-control fw-bold" id="sPContact" placeholder="Paid"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">Student Status</span>
                            <input type="text" class="form-control fw-bold" id="sStatus" placeholder="Paid"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card h-100 d-flex justify-content-center align-items-center bg-secondary-subtle border-0">
                <div class="esoft-card d-flex">
                    <div class="w-50 h-100">
                        <img src="images/img.png" id="profile" width="90%" class="d-block mx-auto mt-2">
                        <h3 class="text-center mt-3">E12345</h3>
                    </div>
                    <div class="w-75 h-100">
                        <div class="d-flex justify-content-center align-items-center h-100">

                            <div class="text-center">
                                <img src="images/esoft-logo.png" alt="" width="90%" class="d-block mx-auto mt-2">

                                <p>00012345</p>
                                <p>00012345</p>
                                <p>0705368016</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
<script src="customModal_V2/resources/js/customModal@2.0.min.js"></script>
<script src="app.js"></script>
<script src="update-barcode.js"></script>
</body>
</html>