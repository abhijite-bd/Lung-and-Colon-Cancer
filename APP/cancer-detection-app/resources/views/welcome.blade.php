<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancer Detection System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card-hover {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-gradient-1 {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        }

        .card-gradient-2 {
            background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
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
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4">

    <div class="bg-white/95 backdrop-blur-sm p-10 rounded-2xl shadow-2xl w-full max-w-2xl">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Cancer Detection</h1>
            <p class="text-gray-600 text-lg">AI-Powered Medical Diagnosis System</p>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Detection Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Colon Cancer Detection Card -->
            <div class="card-hover cursor-pointer" onclick="navigateTo('/colon')">
                <div class="card-gradient-1 p-6 rounded-xl text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Colon Cancer</h3>
                        <p class="text-white/90 text-sm mb-4">Advanced AI analysis for colorectal cancer detection using medical imaging</p>
                        <div class="flex items-center text-white/80 text-sm">
                            <span class="pulse-animation">●</span>
                            <span class="ml-2">Click to analyze</span>
                            <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lung Cancer Detection Card -->
            <div class="card-hover cursor-pointer" onclick="navigateTo('/lung')">
                <div class="card-gradient-2 p-6 rounded-xl text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Lung Cancer</h3>
                        <p class="text-white/90 text-sm mb-4">Comprehensive lung cancer screening using chest X-rays and CT scans</p>
                        <div class="flex items-center text-white/80 text-sm">
                            <span class="pulse-animation">●</span>
                            <span class="ml-2">Click to analyze</span>
                            <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="mt-8 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-400">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h4 class="text-blue-800 font-semibold text-sm">Important Notice</h4>
                    <p class="text-blue-700 text-xs mt-1">This system is designed for medical professionals. Always consult with a qualified healthcare provider for diagnosis and treatment decisions.</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-gray-500 text-sm">Powered by Advanced AI Technology</p>
            <div class="flex justify-center space-x-4 mt-4">
                <div class="flex items-center text-gray-400 text-xs">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Secure
                </div>
                <div class="flex items-center text-gray-400 text-xs">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                    </svg>
                    Accurate
                </div>
                <div class="flex items-center text-gray-400 text-xs">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                    Fast
                </div>
            </div>
        </div>
    </div>

    <script>
        function navigateTo(path) {
            // Add a subtle click animation
            event.currentTarget.style.transform = 'scale(0.98)';

            setTimeout(() => {
                // In a real application, you would use a router like React Router or Vue Router
                // For demonstration purposes, we'll show an alert and could redirect
                if (path === '/colon') {
                    alert('Navigating to Colon Cancer Detection Module...\n\nIn a real application, this would route to the colon cancer analysis page.');
                    window.location.href = '/colon'; // Uncomment for actual navigation
                } else if (path === '/lung') {
                    alert('Navigating to Lung Cancer Detection Module...\n\nIn a real application, this would route to the lung cancer analysis page.');
                    window.location.href = '/lung'; // Uncomment for actual navigation
                }

                // Reset the animation
                event.currentTarget.style.transform = '';
            }, 150);
        }

        // Add keyboard navigation
        document.addEventListener('keydown', function(event) {
            if (event.key === '1') {
                navigateTo('/colon');
            } else if (event.key === '2') {
                navigateTo('/lung');
            }
        });

        // Add loading animation on page load
        window.addEventListener('load', function() {
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';

                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 200 + (index * 100));
            });
        });
    </script>

</body>

</html>