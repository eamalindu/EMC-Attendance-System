window.addEventListener('DOMContentLoaded', () => {
    let inputDate = document.getElementById('date');

    const today = new Date();
    inputDate.max = today.toISOString().slice(0, 10);

    fetch(`generateReport.php?SelectedDate=${encodeURIComponent(today.toISOString().slice(0, 10))}`, {
        method: 'GET', headers: {'Accept': 'application/json'}
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            displayListDate = [{property: 'reg_id', dataType: 'text'}, {
                property: 'batch_id',
                dataType: 'text'
            }, {property: 'timestamp', dataType: 'text'}, {property: 'addedBY', dataType: 'text'}];
            JsonToTable(data, tblReport, displayListDate);
            if (data.length !== 0) {
                $('#tblReport').dataTable();
            }
        })
});

    const generateReport = () => {

        let selectedDate = date.value;
        let selectedBatch = batch.value;

        if (selectedBatch !== "" || selectedDate !== "") {

            if (selectedDate !== "" && selectedBatch !== "") {
                //both selected
                console.log("Both Selected");
                fetch(`generateReport.php?SelectedDate=${encodeURIComponent(selectedDate)}&SelectedBatch=${encodeURIComponent(selectedBatch)}`, {
                    method: 'GET', headers: {'Accept': 'application/json'}
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        displayListDate = [{property: 'reg_id', dataType: 'text'}, {
                            property: 'batch_id',
                            dataType: 'text'
                        }, {property: 'timestamp', dataType: 'text'}, {property: 'addedBY', dataType: 'text'}];

                        if ($.fn.DataTable.isDataTable('#tblReport')) {
                            $('#tblReport').DataTable().clear().destroy();
                        }
                        JsonToTable(data, tblReport, displayListDate);
                        if (data.length !== 0) {
                            $('#tblReport').DataTable();
                        }
                    })
            }

            if (selectedDate !== "" && selectedBatch === "") {
                //only date
                console.log("Date Selected");
                fetch(`generateReport.php?SelectedDate=${encodeURIComponent(selectedDate)}`, {
                    method: 'GET', headers: {'Accept': 'application/json'}
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data)
                        displayListDate = [{property: 'reg_id', dataType: 'text'}, {
                            property: 'batch_id',
                            dataType: 'text'
                        }, {property: 'timestamp', dataType: 'text'}, {property: 'addedBY', dataType: 'text'}];

                        if ($.fn.DataTable.isDataTable('#tblReport')) {
                            $('#tblReport').DataTable().clear().destroy();
                        }
                        JsonToTable(data, tblReport, displayListDate);
                        if (data.length !== 0) {
                            $('#tblReport').DataTable();
                        }
                    })

            }

            if (selectedDate === "" && selectedBatch !== "") {
                //only batch
                console.log("Batch Selected");
                fetch(`generateReport.php?SelectedBatch=${encodeURIComponent(selectedBatch)}`, {
                    method: 'GET', headers: {'Accept': 'application/json'}
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        displayListDate = [{property: 'reg_id', dataType: 'text'}, {
                            property: 'batch_id',
                            dataType: 'text'
                        }, {property: 'timestamp', dataType: 'text'}, {property: 'addedBY', dataType: 'text'}];

                        if ($.fn.DataTable.isDataTable('#tblReport')) {
                            $('#tblReport').DataTable().clear().destroy();
                        }
                        JsonToTable(data, tblReport, displayListDate);
                        if (data.length !== 0) {
                            $('#tblReport').DataTable();
                        }
                    })

            }

        } else {
            showCustomModal("Please select date or batch", "warning");
        }


    }

    document.querySelector('#btnClear').addEventListener('click', () => {
        date.value = "";
        batch.value = "";
    });