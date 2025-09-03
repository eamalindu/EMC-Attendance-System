window.addEventListener('DOMContentLoaded', () => {
    new DataTable('#tle');
});

const deleteStudent = (button) => {

    let reg = button.getAttribute("data-reg");

    showCustomConfirm("You Are about to delete this student <br><br>Reg Number: <span class='text-primary'>00" + reg + "</span><br><br>All the records realted to this<br>student will be <strong>deleted</strong><br><br>Are You Sure?", function (result) {

    });
    console.log(reg);
}

const getStudent= (button)=>{

    let reg = button.getAttribute("data-reg");
    fetch(`getStudent.php?reg=${encodeURIComponent(reg)}`, {
        method: 'GET', headers: {'Accept': 'application/json'}
    })
    .then(response => response.json())
    .then(
        data=>{
            console.log(data);
            //fill data
            sNAme.value = data.name;
            sEID.value = data.eid;
            sREG.value = data.reg;
            sBatch.value = data.batch;
            sContact.value = data.contact;
            pContact.value = data.pStatus;
            sStatus.value = data.sStatus;

            oldStudent = data;
        }
    )
    //need to lock register button
    btnStudentRegister.classList.add('disabled');
    //need to disable or readonly Registration and EID
    sEID.disabled = true;
    sREG.disabled = true;

}

const checkUpdateStudent = ()=>{

    let updates  = "";

    //check name
        if(oldStudent.name !== sNAme.value){
            updates += "Student <span class='text-primary'>name</span> Updated!<br>";
        }

    //check batch

    //check student contact

    //check parent contact

    //check status


    return updates;

}

const updateStudent = ()=>{

    let updates = checkUpdateStudent();
    console.log(updates);
    if(updates===""){

    }
    else{
        showCustomModal(updates,'warning');
    }
}