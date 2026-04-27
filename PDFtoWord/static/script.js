document.addEventListener('DOMContentLoaded', () => {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const uploadContent = document.querySelector('.upload-content');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const removeBtn = document.getElementById('removeBtn');
    const convertBtn = document.getElementById('convertBtn');
    const progressContainer = document.getElementById('progressContainer');
    const progressFill = document.getElementById('progressFill');
    const statusText = document.getElementById('statusText');

    let currentFile = null;

    // Handle click to select file
    uploadArea.addEventListener('click', (e) => {
        if (e.target !== removeBtn && !fileInfo.contains(e.target)) {
            fileInput.click();
        }
    });

    // Handle drag events
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.add('dragover');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.remove('dragover');
        }, false);
    });

    // Handle file drop
    uploadArea.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    });

    // Handle file select
    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            if (file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf')) {
                currentFile = file;
                showFileInfo(file.name);
            } else {
                alert('Please upload a PDF file.');
            }
        }
    }

    function showFileInfo(name) {
        fileName.textContent = name;
        uploadContent.style.display = 'none';
        fileInfo.style.display = 'flex';
        convertBtn.disabled = false;
        uploadArea.style.cursor = 'default';
    }

    function hideFileInfo() {
        currentFile = null;
        fileInput.value = '';
        uploadContent.style.display = 'block';
        fileInfo.style.display = 'none';
        convertBtn.disabled = true;
        uploadArea.style.cursor = 'pointer';
        progressContainer.style.display = 'none';
        convertBtn.textContent = 'Convert Now';
    }

    removeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        hideFileInfo();
    });

    // Handle conversion
    convertBtn.addEventListener('click', async () => {
        if (!currentFile) return;

        const formData = new FormData();
        formData.append('file', currentFile);

        // Update UI for loading state
        convertBtn.disabled = true;
        convertBtn.textContent = 'Converting...';
        progressContainer.style.display = 'block';
        
        // Simulate progress for better UX
        let progress = 0;
        const progressInterval = setInterval(() => {
            if (progress < 90) {
                progress += Math.random() * 10;
                progressFill.style.width = `${Math.min(progress, 90)}%`;
            }
        }, 500);

        try {
            statusText.textContent = 'Uploading and processing...';
            
            const response = await fetch('/convert', {
                method: 'POST',
                body: formData
            });

            clearInterval(progressInterval);
            
            if (response.ok) {
                progressFill.style.width = '100%';
                statusText.textContent = 'Conversion complete! Downloading...';
                convertBtn.textContent = 'Success!';
                
                // Get filename from Content-Disposition header if available
                const contentDisposition = response.headers.get('Content-Disposition');
                let downloadName = currentFile.name.replace(/\.pdf$/i, '.docx');
                if (contentDisposition) {
                    const filenameMatch = contentDisposition.match(/filename="?([^"]+)"?/);
                    if (filenameMatch && filenameMatch[1]) {
                        downloadName = filenameMatch[1];
                    }
                }

                // Handle file download
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = downloadName;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                
                // Reset after 3 seconds
                setTimeout(() => {
                    hideFileInfo();
                    progressFill.style.width = '0%';
                }, 3000);
            } else {
                let errorMessage = `Lỗi Server (${response.status}: ${response.statusText})`;
                try {
                    const text = await response.text();
                    try {
                        const json = JSON.parse(text);
                        errorMessage = json.error || errorMessage;
                    } catch (e) {
                        // Nếu không phải JSON (ví dụ HTML của Nginx hoặc Vercel)
                        if (text.length < 100 && text.trim().length > 0) {
                            errorMessage += ` - ${text}`;
                        } else {
                            errorMessage += ` (Server trả về lỗi không xác định. Có thể do file quá lớn hoặc timeout)`;
                        }
                    }
                } catch (e) {
                    // Bỏ qua lỗi đọc text
                }
                throw new Error(errorMessage);
            }
        } catch (error) {
            clearInterval(progressInterval);
            statusText.textContent = `Error: ${error.message}`;
            statusText.style.color = '#ef4444';
            progressFill.style.background = '#ef4444';
            convertBtn.textContent = 'Try Again';
            convertBtn.disabled = false;
        }
    });
});
