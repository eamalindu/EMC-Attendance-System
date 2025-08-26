window.addEventListener('DOMContentLoaded', () => {
    readOnly();
    noResult.classList.add('d-none');
});


const readOnly = () => {
    let inputs = document.querySelectorAll('input');
    inputs.forEach((element) => {
        element.disabled = true;
    });

    search.disabled = false
}

const getStudent = () => {
    let studentREG = document.getElementById("search").value;


    fetch(`getStudent.php?reg=${encodeURIComponent(studentREG)}`, {
        method: 'GET', headers: {'Accept': 'application/json'}
    })
        .then(response => response.json())
        .then(data => {
            let infoDiv = document.getElementById("studentInfo");

            if (data.error) {
                noResult.classList.remove('d-none');
                result.classList.add('d-none');

                profile.src = "images/img.png";

            } else {
                noResult.classList.add('d-none');
                result.classList.remove('d-none');

                sName.value = data.name;
                sEID.value = data.eid;
                sBatch.value = data.batch;
                sContact.value = "0" + data.contact;
                sPContact.value = "0" + data.pStatus;
                sStatus.value = data.sStatus;
                if (data.sStatus == "Active") {
                    sStatus.classList.remove('text-danger');
                    sStatus.classList.add('text-success');
                } else {
                    sStatus.classList.remove('text-success');
                    sStatus.classList.add('text-danger');
                }

                getGender(data.nic);


            }
        })
        .catch(error => {
            console.error("Fetch error:", error);

        });
};


const getGender = (nic) => {
    let nicValue = (nic).toString();

    let genderValue = nicValue.substring(4, 7);

    if (parseInt(genderValue) < 500) {
        profile.src = "images/male.png";
    } else {
        profile.src = "images/female.png";
    }

    console.log(genderValue);

}

const goToHistory = () => {
    let studentREG = document.getElementById("search").value;

    if (studentREG === "") {
        showCustomModal('Please Enter a Valid Registration Number', 'warning');
    } else {
        window.location.href = 'attendance-history.php?reg=' + encodeURIComponent(studentREG);
    }
}

const markAttendance = () => {
    let studentREG = document.getElementById("search").value;
    if (studentREG === "") {
        showCustomModal('Please Enter a Valid Registration Number', 'warning');
    } else {

        showCustomConfirm("You are about to mark attendance for<br><br>following registration <span class='text-primary'>00" + studentREG + "</span><br><br>Are You Sure?", function (result) {
            if (result) {
                let formData = new FormData();
                formData.append("reg", studentREG);

                fetch("addAttendance.php", {
                    method: "POST", body: formData,
                })
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim() === "Ok") {
                            // Success action
                            search.value="";
                            showCustomModal('Attendance Added Successfully', 'success');
                        } else {
                            showCustomModal(data, 'error');
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });

            }
        });

    }

}