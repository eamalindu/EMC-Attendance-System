window.addEventListener('DOMContentLoaded', () => {
    let inputDate = document.getElementById('date');

    const today = new Date();
    inputDate.max = today.toISOString().slice(0, 10);
})

const generateReport = ()=>{

    let selectedDate = date.value;
    let selectedBatch = batch.value;

    if(selectedBatch!=="" && selectedDate!=="") {

    }
    else{
        showCustomModal("Please select date or batch","warning");
    }



}

document.querySelector('#btnClear').addEventListener('click', ()=>{
    date.value = "";
    batch.value = "";
});