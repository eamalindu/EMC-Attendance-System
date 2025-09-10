window.addEventListener('DOMContentLoaded', () => {
    new DataTable('#tle');
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

        })
    //need to lock register button
    btnStudentRegister.classList.add('disabled');
}

const completeBatch = () => {

}

const updateBatch = () => {

}