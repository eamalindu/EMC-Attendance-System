window.addEventListener('DOMContentLoaded', () => {
    let inputDate = document.getElementById('date');

    const today = new Date();
    inputDate.max = today.toISOString().slice(0, 10);
})

const generateReport = ()=>{

    let selectedDate = date.value;
    let selectedBatch = batch.value;

    if(selectedBatch!=="" || selectedDate!=="") {

        if(selectedDate!=="" && selectedBatch!==""){
            //both selected
            console.log("Both Selected");
        }

        if(selectedDate!=="" && selectedBatch===""){
            //only date
            console.log("Date Selected");
        }

        if(selectedDate==="" && selectedBatch!==""){
            //only batch
            console.log("Batch Selected");
        }

    }
    else{
        showCustomModal("Please select date or batch","warning");
    }



}

document.querySelector('#btnClear').addEventListener('click', ()=>{
    date.value = "";
    batch.value = "";
});