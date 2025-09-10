window.addEventListener('DOMContentLoaded', () => {
    new DataTable('#tle');
});


const refreshBatch = ()=>{

}

const getBatch = (button)=>{
    let batchName = button.getAttribute("data-reg");
    fetch(`getBatch.php?batch=${encodeURIComponent(batchName)}`, {
        method: 'GET', headers: {'Accept': 'application/json'}
    })
        .then(response => response.json())
        .then(
            data=> {
                console.log(data);
                oldBatch = data;

                bNAme.value = data.name;
                bStartTime.value = data.startTime;
                bEndTime.value = data.endTime;

            })
}

const completeBatch = ()=>{

}

const updateBatch = ()=>{

}