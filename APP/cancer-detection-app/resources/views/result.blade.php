<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancer Detection Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .result-card {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .confidence-bar {
            animation: fillBar 1.5s ease-out 0.5s both;
        }

        @keyframes fillBar {
            from {
                width: 0%;
            }
        }

        .image-container {
            position: relative;
            overflow: hidden;
        }

        .image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            animation: shimmer 2s infinite;
            z-index: 1;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .pulse-dot {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.7;
                transform: scale(1.05);
            }
        }

        .button-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .button-gradient:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(102, 126, 234, 0.4);
        }

        .status-positive {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .status-negative {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .status-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4">

    <div class="result-card max-w-2xl mx-auto bg-white/95 backdrop-blur-sm p-8 rounded-2xl shadow-2xl">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2 capitalize">{{ $type }} Cancer Analysis</h1>
            <p class="text-gray-600">AI-Powered Detection Results</p>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Image and Results Container -->
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <!-- Image Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-700 text-center">Analyzed Image</h3>
                <div class="image-container relative rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/' . $imagePath) }}"
                        alt="Medical Image for Analysis"
                        class="w-full h-64 object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-medium text-gray-600">
                            Medical Image
                        </span>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-sm text-gray-500">Image processed successfully</p>
                    <div class="flex justify-center items-center mt-2 space-x-2">
                        <span class="pulse-dot w-2 h-2 bg-green-400 rounded-full"></span>
                        <span class="text-xs text-gray-400">Analysis Complete</span>
                    </div>
                </div>
            </div>

            <!-- Results Section -->
            <div class="space-y-6">

                <!-- Classification Result -->
                <div class="bg-gray-50 rounded-xl p-6 border-l-4 border-blue-500">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Classification Result</h3>

                    <!-- Status Badge -->
                    <div class="mb-4">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-white font-semibold text-sm
                            @if(strtolower($result['class'] ?? '') == 'normal' || strtolower($result['class'] ?? '') == 'benign')
                                status-positive
                            @elseif(strtolower($result['class'] ?? '') == 'malignant' || strtolower($result['class'] ?? '') == 'cancer')
                                status-negative
                            @else
                                status-warning
                            @endif">
                            @if(strtolower($result['class'] ?? '') == 'normal' || strtolower($result['class'] ?? '') == 'benign')
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            @elseif(strtolower($result['class'] ?? '') == 'malignant' || strtolower($result['class'] ?? '') == 'cancer')
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            @else
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @endif
                            {{ $result['class'] ?? 'N/A' }}
                        </span>
                    </div>

                    <!-- Confidence Score -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-600">Confidence Level</span>
                            <span class="text-lg font-bold text-gray-800">
                                {{ number_format($result['confidence'] ?? 0, 2) }}%
                            </span>
                        </div>
                        <!-- Confidence Bar -->
                        <div class="w-full bg-red-700 rounded-full h-4">
                            <div class="confidence-bar h-4 rounded-full bg-gradient-to-r from-blue-500 to-purple-500"
                                style="width: {{ $result['confidence'] ?? 0 }}%">
                            </div>
                        </div>

                        <div class="flex justify-between text-xs text-gray-500">
                            <span>Low</span>
                            <span>Medium</span>
                            <span>High</span>
                        </div>
                    </div>
                </div>

                <!-- AI Model Info -->
                <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-blue-800 text-sm">AI Model Analysis</h4>
                            <p class="text-blue-600 text-xs">Deep Learning Neural Network</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ url('/') }}"
                class="flex-1 button-gradient text-white py-3 px-6 rounded-xl font-semibold text-center hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                <span class="flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <span>Analyze Another Image</span>
                </span>
            </a>
            <form action="{{ route('generate.report') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $patient->id }}">
                <input type="hidden" name="result" value="{{ json_encode($result) }}">
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="hidden" name="imagePath" value="{{ $imagePath }}">

                <button type="submit"
                    class="flex-1 button-gradient text-white py-3 px-6 rounded-xl font-semibold text-center hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Download Report</span>
                    </span>
                </button>
            </form>

            <!-- <button
                class="flex-1 bg-white border-2 border-gray-300 text-gray-700 py-3 px-6 rounded-xl font-semibold hover:border-gray-400 hover:bg-gray-50 transition-all duration-300">
                <span class="flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Download Report</span>
                </span>
            </button> -->
        </div>

        <!-- Medical Disclaimer -->
        <div class="mt-6 p-4 bg-amber-50 rounded-lg border-l-4 border-amber-400">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-amber-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h4 class="text-amber-800 font-semibold text-sm">Medical Disclaimer</h4>
                    <p class="text-amber-700 text-xs mt-1">This AI analysis is for medical professional use only and should not replace clinical diagnosis. Always consult with qualified healthcare providers for medical decisions.</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6 pt-4 border-t border-gray-100">
            <p class="text-gray-500 text-sm">Analysis completed with advanced AI technology</p>
            <p class="text-gray-400 text-xs mt-1">Report generated on {{ date('F j, Y \a\t g:i A') }}</p>
        </div>
    </div>

    <script>
        // Add entrance animation
        window.addEventListener('load', function() {
            const elements = document.querySelectorAll('.result-card > *');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    el.style.transition = 'all 0.6s ease-out';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, 100 + (index * 100));
            });
        });

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            notification.innerHTML = `
<div class="flex items-center space-x-2">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
    </svg>
    <span>${message}</span>
</div>
`;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    </script>

</body>

</html>