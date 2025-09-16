window.addEventListener('DOMContentLoaded', () => {
    new DataTable('#tle');
    newBatch = {};
});


const refreshBatch = () => {

}

const getBatch = (button) => {
    let batchName = button.getAttribute("data-reg");
    fetch(`getBatch.php?batch=${encodeURIComponent(batchName)}`, {
        method: 'GET', headers: {'Accept': 'application/json'}
    })
        .then(response => response.json())
        .then(data => {
            btnStudentUpdate.classList.remove('disabled');
            console.log(data);
            oldBatch = data;

            bNAme.value = data.name;
            bNAme.disabled = true;
            bStartTime.value = data.startTime;
            bEndTime.value = data.endTime;

            //check schedule
            if (data.monday === "1") {
                bMonday.checked = true;
            } else {
                bMonday.checked = false;
            }

            if (data.tuesday === "1") {
                bTuesday.checked = true;
            } else {
                bTuesday.checked = false;
            }

            if (data.wednesday === "1") {
                bWednesday.checked = true;
            } else {
                bWednesday.checked = false;
            }

            if (data.thursday === "1") {
                bThursday.checked = true;
            } else {
                bThursday.checked = false;
            }

            if (data.friday === "1") {
                bFriday.checked = true;
            } else {
                bFriday.checked = false;
            }

            if (data.saturday === "1") {
                bSaturday.checked = true;
            } else {
                bSaturday.checked = false;
            }

            if (data.sunday === "1") {
                bSunday.checked = true;
            } else {
                bSunday.checked = false;
            }

            if(data.status==="Completed"){
                btnStudentUpdate.classList.add('disabled');
            }

        })
    //need to lock register button
    btnStudentRegister.classList.add('disabled');
}

const completeBatch = (button) => {
    let batchName = button.getAttribute("data-reg");
    showCustomConfirm("You Are About to Complete This batch<br><br>Once completed,<br>attendance can no longer be marked<br><br>Are You Sure?", function (result) {
        if(result){
            formData = new FormData();
            formData.append("batch", batchName);
            fetch("completeBatch.php",{
                method: "POST",
                body:formData
            })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    if (data.trim() === "OK") {
                        // Success action
                        showCustomModal('Batch Completed Successfully', 'success');
                        //click offcanvas close btn
                        setTimeout(() => {
                            location.reload();
                        }, 3000);


                    } else {
                        showCustomModal(data, 'error');
                    }
                })
                .catch(error => console.log(error));
        }
    })

}

const updateBatch = () => {

    let updates = checkUpdateBatch();
    console.log(updates);
    if(updates===""){
        showCustomModal("No Updates Found!","info");
    }
    else {
        showCustomConfirm("You are About to Update this Batch  <br><br>Following Changes Detected! <br><br>" + updates + "<br>Are You Sure?", function (result) {
            if (result) {

            }
        });
    }


}

const checkUpdateBatch = () => {
    let updates = "";

    let days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

    days.forEach(day => {
        test(day); // update newBatch values

        // compare with oldBatch
        if (oldBatch[day.toLowerCase()] !== newBatch[day.toLowerCase()]) {
            if (newBatch[day.toLowerCase()] === "1") {
                updates += "<span class='text-primary'>"+day + "</span> was <b>Added</b> to the class Schedule<br>";
            } else {
                updates += "<span class='text-primary'>"+day + "</span> was <b>Removed</b> from the class Schedule<br>";
            }
        }
    });

    if(oldBatch.startTime !== bStartTime.value){
        updates +="Start Time was updated to <span class='text-primary'>"+bStartTime.value+"</span><br>";
    }

    if(oldBatch.endTime !== bEndTime.value){
        updates +="End Time was updated to <span class='text-primary'>"+bEndTime.value+"</span><br>";
    }

    return updates;
};

const test = (day) => {
    let element = document.getElementById("b" + day);
    if (element && element.checked) {
        newBatch[day.toLowerCase()] = "1";
    } else {
        newBatch[day.toLowerCase()] = "0";
    }
};
