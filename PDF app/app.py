import os
import tempfile
from flask import Flask, render_template, request, send_file, jsonify
from werkzeug.utils import secure_filename
from pdf2docx import Converter

app = Flask(__name__)
# Giới hạn kích thước file upload 50MB
app.config['MAX_CONTENT_LENGTH'] = 50 * 1024 * 1024

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/convert', methods=['POST'])
def convert():
    if 'file' not in request.files:
        return jsonify({'error': 'Không tìm thấy file'}), 400
    
    file = request.files['file']
    if file.filename == '':
        return jsonify({'error': 'Nhập file không hợp lệ'}), 400
        
    if file and file.filename.lower().endswith('.pdf'):
        # Bảo mật tên file
        filename = secure_filename(file.filename)
        
        # Tạo thư mục tạm thời để lưu trữ file
        temp_dir = tempfile.mkdtemp()
        pdf_path = os.path.join(temp_dir, filename)
        
        # Lưu file PDF mà người dùng upload
        file.save(pdf_path)
        
        # Xác định tên cho file đầu ra docx
        docx_filename = os.path.splitext(filename)[0] + '.docx'
        docx_path = os.path.join(temp_dir, docx_filename)
        
        try:
            # Chuyển đổi PDF sang DOCX
            cv = Converter(pdf_path)
            cv.convert(docx_path, start=0, end=None)
            cv.close()
            
            # Gửi file lại cho người dùng
            return send_file(docx_path, as_attachment=True, download_name=docx_filename)
        except Exception as e:
            return jsonify({'error': str(e)}), 500
            
    return jsonify({'error': 'Vui lòng tải lên file định dạng PDF.'}), 400

if __name__ == '__main__':
    app.run(debug=True, port=5000)
