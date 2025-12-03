let fileData = null;

const loadUploadedExcel = (e) => {
    const file = e.target.files[0];

    if (!file) {
        alert("No file selected");
        return;
    }

    const reader = new FileReader();

    reader.onload = (event) => {
        try {
            const data = new Uint8Array(event.target.result);
            const workbook = XLSX.read(data, { type: 'array' });

            // Get the first sheet
            const firstSheet = workbook.Sheets[workbook.SheetNames[0]];

            // Convert to JSON
            fileData = XLSX.utils.sheet_to_json(firstSheet);

            alert(`File loaded successfully! Found ${fileData.length} students.`);

            // Display preview
            displayPreview(fileData);

        } catch (error) {
            alert("Error reading file: " + error.message);
        }
    };

    reader.readAsArrayBuffer(file);
};

const displayPreview = (data) => {
    const resultDiv = document.getElementById('result');

    if (data.length === 0) {
        resultDiv.innerHTML = '<div class="alert alert-warning">No data found in file</div>';
        return;
    }

    // Create table
    let html = '<h5>Preview (first 5 rows):</h5>';
    html += '<div class="table-responsive"><table class="table table-bordered table-striped">';

    // Headers
    html += '<thead class="table-dark"><tr>';
    Object.keys(data[0]).forEach(key => {
        html += `<th>${key}</th>`;
    });
    html += '</tr></thead><tbody>';

    // Rows (max 5)
    data.slice(0, 5).forEach(row => {
        html += '<tr>';
        Object.values(row).forEach(value => {
            html += `<td>${value}</td>`;
        });
        html += '</tr>';
    });

    html += '</tbody></table></div>';
    resultDiv.innerHTML = html;
};

const uploadStudents = () => {
    if (!fileData) {
        alert("Please select and load a file first");
        return;
    }

    // Here you would typically send the data to your server
    console.log("Uploading students:", fileData);
    alert(`Ready to upload ${fileData.length} students!\n(Check console for data)`);

    // Example: Send to server
    // fetch('/api/upload-students', {
    //     method: 'POST',
    //     headers: { 'Content-Type': 'application/json' },
    //     body: JSON.stringify(fileData)
    // });
};

// Event listeners
document.getElementById('fileSelect').addEventListener('change', loadUploadedExcel);
document.getElementById('uploadBtn').addEventListener('click', uploadStudents);