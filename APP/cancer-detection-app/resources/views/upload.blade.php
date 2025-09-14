<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image for Cancer Detection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .upload-area {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .upload-area:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .upload-area.drag-over {
            border-color: #3b82f6;
            background-color: #eff6ff;
            transform: scale(1.02);
        }

        .file-icon {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .progress-bar {
            transition: width 0.3s ease;
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .button-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .button-gradient:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4">

    <div class="bg-white/95 backdrop-blur-sm p-10 rounded-2xl shadow-2xl w-full max-w-lg">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Cancer Detection</h1>
            <p class="text-gray-600">Upload medical image for AI analysis</p>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <form action="/predict" method="POST" enctype="multipart/form-data" class="space-y-6" id="uploadForm">
            @csrf
            <!-- Patient Info Section -->
            <input type="hidden" name="type" value="{{ $type ?? 'colon' }}">
            <div class="bg-gray-50 p-6 rounded-xl shadow-inner space-y-4">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center space-x-2">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.306.535 6.121 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Patient Information</span>
                </h2>

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 p-2">
                </div>

                <!-- Age + Gender (Side by side) -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Age</label>
                        <input type="number" name="age" required min="1"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                        <select name="gender" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 p-2">
                            <option value="">Select</option>
                            <option value="Male">Male ♂️</option>
                            <option value="Female">Female ♀️</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Upload Area -->
            <div class="upload-area border-2 border-dashed border-gray-300 rounded-xl p-8 text-center bg-gray-50 hover:bg-gray-100 cursor-pointer relative overflow-hidden"
                id="uploadArea"
                onclick="document.getElementById('fileInput').click()">

                <!-- Background decoration -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-100/30 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-purple-100/30 rounded-full -ml-12 -mb-12"></div>

                <div class="relative z-10">
                    <div class="file-icon w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Drop your image here</h3>
                    <p class="text-gray-500 text-sm mb-4">or click to browse files</p>
                    <div class="text-xs text-gray-400">
                        <span class="bg-gray-200 px-2 py-1 rounded mr-1">JPG</span>
                        <span class="bg-gray-200 px-2 py-1 rounded mr-1">PNG</span>
                        <span class="bg-gray-200 px-2 py-1 rounded">DICOM</span>
                    </div>
                </div>

                <input type="file"
                    name="image"
                    id="fileInput"
                    accept=".jpg,.jpeg,.png,.dcm,image/*,application/dicom"
                    required
                    value="{{ $type ?? 'colon' }}"
                    class="hidden">
            </div>

            <!-- Selected File Display -->
            <div id="fileDisplay" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800" id="fileName"></p>
                        <p class="text-sm text-gray-500" id="fileSize"></p>
                    </div>
                    <button type="button"
                        onclick="clearFile()"
                        class="text-red-500 hover:text-red-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Progress Bar -->
            <div id="progressContainer" class="hidden">
                <div class="bg-gray-200 rounded-full h-2">
                    <div class="progress-bar bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full"
                        style="width: 0%"
                        id="progressBar"></div>
                </div>
                <p class="text-sm text-gray-600 mt-2 text-center">Processing image...</p>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    id="submitBtn"
                    class="w-full button-gradient text-white py-3 px-6 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <span>Analyze Image</span>
                    </span>
                </button>
            </div>
        </form>

        <!-- Information Panel -->
        <div class="mt-8 p-4 bg-amber-50 rounded-lg border-l-4 border-amber-400">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-amber-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h4 class="text-amber-800 font-semibold text-sm">Upload Guidelines</h4>
                    <ul class="text-amber-700 text-xs mt-1 space-y-1">
                        <li>• Use high-quality medical images for best results</li>
                        <li>• Supported formats: JPG, PNG, DICOM</li>
                        <li>• Maximum file size: 10MB</li>
                        <li>• Results are for professional medical use only</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-gray-500 text-sm">Secure • HIPAA Compliant • AI-Powered</p>
            <div class="flex justify-center items-center mt-2 space-x-2">
                <span class="pulse-animation w-2 h-2 bg-green-400 rounded-full"></span>
                <span class="text-xs text-gray-400">System Ready</span>
            </div>
        </div>
    </div>

    <script>
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        const fileDisplay = document.getElementById('fileDisplay');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const submitBtn = document.getElementById('submitBtn');
        const progressContainer = document.getElementById('progressContainer');
        const progressBar = document.getElementById('progressBar');
        const uploadForm = document.getElementById('uploadForm');

        // Drag and drop functionality
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('drag-over');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('drag-over');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('drag-over');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFileSelect(files[0]);
            }
        });

        // File input change
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });

        function handleFileSelect(file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please select a valid image file.');
                return;
            }

            // Validate file size (10MB limit)
            if (file.size > 10 * 1024 * 1024) {
                alert('File size must be less than 10MB.');
                return;
            }

            // Display file info
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            fileDisplay.classList.remove('hidden');

            // Enable submit button
            submitBtn.disabled = false;
        }

        function clearFile() {
            fileInput.value = '';
            fileDisplay.classList.add('hidden');
            submitBtn.disabled = true;
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Form submission with progress simulation
        uploadForm.addEventListener('submit', function(e) {
            if (!fileInput.files.length) {
                e.preventDefault();
                alert('Please select an image file first.');
                return;
            }

            // Show progress bar
            progressContainer.classList.remove('hidden');
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="flex items-center justify-center space-x-2">
                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Processing...</span>
                </span>
            `;

            // Simulate progress (remove this in production)
            let progress = 0;
            const progressInterval = setInterval(() => {
                progress += 10;
                progressBar.style.width = progress + '%';

                if (progress >= 100) {
                    clearInterval(progressInterval);
                }
            }, 200);
        });

        // Initialize
        submitBtn.disabled = true;
    </script>

</body>

</html>