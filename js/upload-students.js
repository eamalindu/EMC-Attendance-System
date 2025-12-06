let fileData = null;

const loadUploadedExcel = (e) => {
    const file = e.target.files[0];

    if (!file) {
        showCustomModal('No Files Uploaded', 'error');
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

            showCustomModal(`File loaded successfully! Found ${fileData.length} students.`, 'success');

            // Display preview
            displayPreview(fileData);

        } catch (error) {
            showCustomModal("Error reading file: " + error.message, 'error');
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
    html += `<p class="text-muted mt-2">Showing first 5 of ${data.length} total records</p>`;
    resultDiv.innerHTML = html;
};

const uploadStudents = () => {
    if (!fileData) {
        showCustomModal('Please select and load a file first', 'error');
        return;
    }

    // Disable upload button to prevent double-clicking
    const uploadBtn = document.getElementById('uploadBtn');
    uploadBtn.disabled = true;
    uploadBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Uploading...';

    fetch('add-students.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(fileData)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.errorCount > 0) {
                    // Some errors occurred
                    let errorDetails = '<br><br><strong>Errors:</strong><ul class="text-start">';
                    data.errors.forEach(error => {
                        errorDetails += `<li>Row ${error.row} (Reg: ${error.reg}): ${error.error}</li>`;
                    });
                    errorDetails += '</ul>';

                    showCustomModal(data.message + errorDetails, 'warning');
                } else {
                    // All successful
                    showCustomModal(data.message, 'success');

                    // Clear the file input and preview after successful upload
                    document.getElementById('fileSelect').value = '';
                    document.getElementById('result').innerHTML = '';
                    fileData = null;
                }
            } else {
                showCustomModal(data.message || 'Upload failed', 'error');
            }
        })
        .catch(error => {
            showCustomModal('Network error: ' + error.message, 'error');
        })
        .finally(() => {
            // Re-enable upload button
            uploadBtn.disabled = false;
            uploadBtn.innerHTML = 'Upload Students';
        });
};

// Event listeners
document.getElementById('fileSelect').addEventListener('change', loadUploadedExcel);
document.getElementById('uploadBtn').addEventListener('click', uploadStudents);