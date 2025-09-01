window.addEventListener('DOMContentLoaded', () => {
    new DataTable('#tle');
});

const deleteStudent = (button) => {

    let reg = button.getAttribute("data-reg");
    console.log(reg);
    console.log(button);
}