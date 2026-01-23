<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS Faculty Evaluation System - UPHSD Molino</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #0f766e 100%);
            animation: gradientShift 10s ease infinite;
            background-size: 200% 200%;
        }
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .portal-card {
            backdrop-filter: blur(10px);
            animation: fadeInUp 0.6s ease-out;
            transition: all 0.3s ease;
        }
        .portal-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 20s infinite ease-in-out;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }
        .btn-portal {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-portal::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        .btn-portal:hover::before {
            width: 300px;
            height: 300px;
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center relative overflow-hidden">
    <div class="floating-shapes">
        <div class="shape bg-white rounded-full w-96 h-96 absolute top-10 left-10"></div>
        <div class="shape bg-white rounded-full w-64 h-64 absolute bottom-10 right-20" style="animation-delay: -7s;"></div>
        <div class="shape bg-white rounded-full w-80 h-80 absolute top-1/3 right-10" style="animation-delay: -3s;"></div>
        <div class="shape bg-white rounded-full w-48 h-48 absolute bottom-1/4 left-1/3" style="animation-delay: -10s;"></div>
    </div>
    
    <div class="relative z-10 w-full max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="text-center mb-12 animate-fadeInUp">
            <div class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl">
                <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h1 class="text-5xl md:text-6xl font-black text-white mb-4 tracking-tight">Faculty Evaluation System</h1>
            <p class="text-xl text-white/90 font-medium">College of Computer Studies</p>
            <p class="text-lg text-white/70 mt-2">University of Perpetual Help System Dalta - Molino Campus</p>
        </div>

        <!-- Portal Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            <!-- Admin Portal -->
            <div class="portal-card bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 overflow-hidden">
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-8 text-white">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black mb-2">Admin Portal</h2>
                    <p class="text-blue-100 text-sm font-medium">Manage evaluations, faculty, and generate reports</p>
                </div>
                <div class="p-8">
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-3 text-gray-700">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">Create and manage faculty evaluations</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">View comprehensive reports and analytics</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">Manage faculty database</span>
                        </li>
                    </ul>
                    <a href="login.php" class="btn-portal block w-full bg-gradient-to-br from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white font-bold py-4 px-6 rounded-xl shadow-lg text-center text-lg">
                        Admin Login →
                    </a>
                </div>
            </div>

            <!-- Faculty Portal -->
            <div class="portal-card bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 overflow-hidden">
                <div class="bg-gradient-to-br from-teal-600 to-teal-800 p-8 text-white">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black mb-2">Faculty Portal</h2>
                    <p class="text-teal-100 text-sm font-medium">View your evaluation history and performance</p>
                </div>
                <div class="p-8">
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-3 text-gray-700">
                            <svg class="w-6 h-6 text-teal-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">View your evaluation results</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <svg class="w-6 h-6 text-teal-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">Track performance over time</span>
                        </li>
                        <li class="flex items-start gap-3 text-gray-700">
                            <svg class="w-6 h-6 text-teal-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">Download evaluation reports</span>
                        </li>
                    </ul>
                    <a href="login.php" class="btn-portal block w-full bg-gradient-to-br from-teal-600 to-teal-800 hover:from-teal-700 hover:to-teal-900 text-white font-bold py-4 px-6 rounded-xl shadow-lg text-center text-lg">
                        Faculty Login →
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-12 text-white/80 text-sm">
            <p class="font-medium">© 2026 University of Perpetual Help System Dalta - Molino Campus</p>
            <p class="mt-1">College of Computer Studies | Faculty Evaluation System</p>
        </div>
    </div>
</body>
</html>
