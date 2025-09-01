window.addEventListener('DOMContentLoaded', () => {
    new DataTable('#tle');
});

const deleteStudent = (button) => {

    let reg = button.getAttribute("data-reg");
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

}