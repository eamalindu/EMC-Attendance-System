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
        }
    )
    //need to lock register button
    //need to disable or readonly Registration and EID

    //fill data

}