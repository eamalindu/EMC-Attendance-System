window.addEventListener('DOMContentLoaded', () => {
    barcode.disabled = false;
});

const getStudentD = () => {
    let studentREG = document.getElementById("search").value;


    fetch(`getStudent.php?reg=${encodeURIComponent(studentREG)}`, {
        method: 'GET', headers: {'Accept': 'application/json'}
    })
        .then(response => response.json())
        .then(data => {
            let infoDiv = document.getElementById("studentInfo");

            if (data.error) {
                noResult.classList.remove('d-none');
                result.classList.add('d-none');
                esoft_card.classList.add('d-none');

                profile.src = "images/img.png";

            } else {
                noResult.classList.add('d-none');
                result.classList.remove('d-none');
                esoft_card.classList.remove('d-none');

                sName.value = data.name;
                sEID.value = data.eid;
                sBatch.value = data.batch;
                sContact.value = "0" + data.contact;
                sPContact.value = "0" + data.pStatus;
                sStatus.value = data.sStatus;

                cardName.innerHTML = "Name : "+data.name;
                cardContact.innerHTML = "Phone : 0"+data.contact;
                cardBatch.innerHTML = "Batch : "+data.batch;

                if (data.sStatus == "Active") {
                    sStatus.classList.remove('text-danger');
                    sStatus.classList.add('text-success');
                } else {
                    sStatus.classList.remove('text-success');
                    sStatus.classList.add('text-danger');
                }

                getGender(data.nic);


            }
        })
        .catch(error => {
            console.error("Fetch error:", error);

        });
};

const updateBarCode = ()=>{

}