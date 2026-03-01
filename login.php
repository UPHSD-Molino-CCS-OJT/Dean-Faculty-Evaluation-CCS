<?php
session_start();

// Database Connection
require_once __DIR__ . '/includes/config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $_POST['password'];

    $result = $conn->query("SELECT u.*, f.name as faculty_name FROM users u 
                           LEFT JOIN faculty f ON u.faculty_id = f.id 
                           WHERE u.username='$user'");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            // Check user role and redirect accordingly
            if ($row['role'] == 'faculty') {
                $_SESSION['faculty_logged_in'] = true;
                $_SESSION['faculty_id'] = $row['faculty_id'];
                $_SESSION['faculty_name'] = $row['faculty_name'];
                $_SESSION['user_id'] = $row['id'];
                header("Location: faculty/faculty_dashboard.php");
                exit();
            } else {
                // Admin login
                $_SESSION['admin_logged_in'] = true;
                header("Location: admin/dashboard.php");
                exit();
            }
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - UPHSD Evaluation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        .login-card {
            animation: fadeInUp 0.6s ease-out;
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
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }
        .btn-login {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <div class="floating-shapes">
        <div class="shape bg-white rounded-full w-96 h-96 absolute top-10 left-10"></div>
        <div class="shape bg-white rounded-full w-64 h-64 absolute bottom-10 right-20" style="animation-delay: -7s;"></div>
        <div class="shape bg-white rounded-full w-80 h-80 absolute top-1/3 right-10" style="animation-delay: -3s;"></div>
        <div class="shape bg-white rounded-full w-48 h-48 absolute bottom-1/4 left-1/3" style="animation-delay: -10s;"></div>
    </div>
    
    <div class="login-card bg-white p-8 md:p-12 rounded-3xl shadow-2xl w-full max-w-md relative z-10">
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Login</h2>
            <p class="text-sm text-gray-600 font-medium">College of Computer Studies - UPHSD Molino</p>
            <p class="text-xs text-gray-500 mt-1">Admin & Faculty Portal</p>
        </div>
        
        <?php if($error): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Username</label>
                <p class="text-xs text-gray-400 mb-3">Admin or Faculty username</p>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input type="text" name="username" required class="input-field w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:outline-none bg-gray-50 text-gray-700 font-medium">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-3 uppercase tracking-wide">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <input type="password" name="password" required class="input-field w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:outline-none bg-gray-50 text-gray-700 font-medium">
                </div>
            </div>
            <button type="submit" class="btn-login w-full text-white font-bold py-4 rounded-xl shadow-lg text-base uppercase tracking-wider">
                Sign In
            </button>
        </form>
        
        <p class="text-center text-xs text-gray-400 mt-6 leading-relaxed">
            Secure Faculty Evaluation System · Unified Login Portal
        </p>
    </div>
</body>
</html>