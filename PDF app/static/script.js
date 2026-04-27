document.addEventListener('DOMContentLoaded', () => {
    const uploadZone = document.getElementById('upload-zone');
    const fileInput = document.getElementById('file-input');
    const browseBtn = document.getElementById('browse-btn');
    const fileInfo = document.getElementById('file-info');
    const fileNameDisplay = document.getElementById('file-name');
    const removeBtn = document.getElementById('remove-btn');
    const convertBtn = document.getElementById('convert-btn');
    const spinner = document.getElementById('spinner');
    const btnText = convertBtn.querySelector('span');
    const statusMessage = document.getElementById('status-message');

    let currentFile = null;

    // Trigger file input dialog
    uploadZone.addEventListener('click', (e) => {
        // Prevent infinite bubbling loop
        if (e.target === fileInput) return;
        fileInput.click();
    });

    // Handle Drag & Drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadZone.addEventListener(eventName, () => uploadZone.classList.add('dragover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, () => uploadZone.classList.remove('dragover'), false);
    });

    uploadZone.addEventListener('drop', (e) => {
        let dt = e.dataTransfer;
        let files = dt.files;
        handleFiles(files);
    });

    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            if (file.type !== 'application/pdf') {
                showStatus('Please select a valid PDF file.', 'error');
                return;
            }
            if (file.size > 50 * 1024 * 1024) {
                showStatus('File is too large. Please select a file under 50MB.', 'error');
                return;
            }
            
            currentFile = file;
            fileNameDisplay.textContent = file.name;
            uploadZone.classList.add('hidden');
            fileInfo.classList.remove('hidden');
            convertBtn.disabled = false;
            showStatus('', '');
        }
    }

    removeBtn.addEventListener('click', () => {
        currentFile = null;
        fileInput.value = '';
        uploadZone.classList.remove('hidden');
        fileInfo.classList.add('hidden');
        convertBtn.disabled = true;
        showStatus('', '');
    });

    function showStatus(message, type) {
        statusMessage.textContent = message;
        statusMessage.className = 'status-message';
        if (type) statusMessage.classList.add(type);
    }

    convertBtn.addEventListener('click', async () => {
        if (!currentFile) return;

        // UI Loading State
        convertBtn.disabled = true;
        btnText.textContent = 'Processing...';
        spinner.classList.remove('hidden');
        showStatus('Converting PDF, please wait...', 'info');

        const formData = new FormData();
        formData.append('file', currentFile);

        try {
            const response = await fetch('/convert', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.error || 'An error occurred during conversion.');
            }

            // Get docx filename from headers or default
            let filename = currentFile.name.replace(/\.pdf$/i, '.docx');
            try {
                const disposition = response.headers.get('Content-Disposition');
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    const matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) { 
                        filename = matches[1].replace(/['"]/g, '');
                    }
                }
            } catch(e) {}

            // Blob download
            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            
            showStatus('Conversion successful! Download will start soon.', 'success');
            
            // Xoá file sau khi tải vài giây và khôi phục form? (Không cần thiết lắm vì người dùng dã hoàn tất)
        } catch (error) {
            showStatus('Error: ' + error.message, 'error');
        } finally {
            // Restore UI State
            convertBtn.disabled = false;
            btnText.textContent = 'Convert now';
            spinner.classList.add('hidden');
        }
    });
});
