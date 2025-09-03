window.addEventListener('DOMContentLoaded', () => {
    new DataTable('#tle');
});

const deleteStudent = (button) => {

    let reg = button.getAttribute("data-reg");

    showCustomConfirm("You Are about to delete this student <br><br>Reg Number: <span class='text-primary'>00" + reg + "</span><br><br>All the records realted to this<br>student will be <strong>deleted</strong><br><br>Are You Sure?", function (result) {
        if (result) {

        }
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
            updates += "<small>name was Updated to <span class='text-primary'>"+sNAme.value+"</span></small><br>";
        }

    //check batch
    if(oldStudent.batch !== sBatch.value){
        updates += "<small>Batch was Updated to <span class='text-primary'>"+sBatch.value+"</span></small><br>";
    }

    //check student contact
    if(oldStudent.contact !==sContact.value){
        updates += "<small>Contact was Updated to <span class='text-primary'>"+sContact.value+"</span></small><br>";
    }

    //check parent contact
    if(oldStudent.pStatus!==pContact.value){
        updates += "<small>Parent Contact was Updated to <span class='text-primary'>"+pContact.value+"</span></small><br>";
    }

    //check status
    if(oldStudent.sStatus!==sStatus.value){
        updates += "<small>Status was Updated to <span class='text-primary'>"+sStatus.value+"</span></small><br>";
    }

    return updates;

}

const updateStudent = ()=>{

    let updates = checkUpdateStudent();
    console.log(updates);
    if(updates===""){
        showCustomModal("No Updates Found!","info");
    }
    else{
        showCustomConfirm("You are About to Update this Student  <br><br>Following Changes Detected! <br><br>"+updates+"<br>Are You Sure?",function(result){
            if(result){
                let formData = new FormData();
                formData.append("reg", oldStudent.reg);
                formData.append("name",sNAme.value);
                formData.append("batch",sBatch.value);
                formData.append("contact",sContact.value);
                formData.append("pContact",pContact.value);
                formData.append("status",sStatus.value);


            }
        });
    }
}