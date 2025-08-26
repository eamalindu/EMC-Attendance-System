const generateReport = ()=>{

    let selectedDate = date.value;
    let selectedBatch = batch.value;

    showCustomModal(selectedDate+" "+selectedBatch,'info');
}

document.querySelector('#btnClear').addEventListener('click', ()=>{
    date.value = "";
    batch.value = "";
});