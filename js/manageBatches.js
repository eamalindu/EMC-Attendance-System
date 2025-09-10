window.addEventListener('DOMContentLoaded', () => {
    new DataTable('#tle');
});


const refreshBatch = ()=>{

}

const getBatch = (button)=>{
    let batchName = button.getAttribute("data-reg");
    fetch(`getBatch.php?reg=${encodeURIComponent(batchName)}`, {
        method: 'GET', headers: {'Accept': 'application/json'}
    })
        .then(response => response.json())
        .then(
            data=> {
                console.log(data);
            })
}

const completeBatch = ()=>{

}

const updateBatch = ()=>{

}