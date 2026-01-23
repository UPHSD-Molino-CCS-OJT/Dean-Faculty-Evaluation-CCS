<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty_evaluation";

$conn = new mysqli($servername, $username, $password, $dbname);

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $_POST['password'];

    $result = $conn->query("SELECT u.*, f.name as faculty_name FROM users u 
                           LEFT JOIN faculty f ON u.faculty_id = f.id 
                           WHERE u.username='$user' AND u.role='faculty'");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            $_SESSION['faculty_logged_in'] = true;
            $_SESSION['faculty_id'] = $row['faculty_id'];
            $_SESSION['faculty_name'] = $row['faculty_name'];
            $_SESSION['user_id'] = $row['id'];
            header("Location: faculty_dashboard.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Faculty account not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faculty Login - UPHSD Evaluation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
        }
        .login-card {
            backdrop-filter: blur(10px);
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
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
        }
        .btn-login {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(20, 184, 166, 0.4);
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
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body class="gradient-bg h-screen flex items-center justify-center relative overflow-hidden">
    <div class="floating-shapes">
        <div class="shape bg-white rounded-full w-64 h-64 absolute top-10 left-10"></div>
        <div class="shape bg-white rounded-full w-96 h-96 absolute bottom-10 right-10" style="animation-delay: -10s;"></div>
        <div class="shape bg-white rounded-full w-48 h-48 absolute top-1/2 left-1/2" style="animation-delay: -5s;"></div>
    </div>
    
    <div class="login-card bg-white/95 backdrop-blur-sm p-10 rounded-2xl shadow-2xl w-full max-w-md border border-white/20 relative z-10">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-br from-teal-600 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Faculty Portal</h2>
            <p class="text-sm text-gray-600 font-medium">College of Computer Studies - UPHSD Molino</p>
        </div>
        
        <?php if($error): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 text-sm flex items-center animate-pulse">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">
            <div>
                <label class="block text-xs font-bold uppercase text-gray-700 mb-2 tracking-wide">Faculty Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input type="text" name="username" required class="input-field w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 transition">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-gray-700 mb-2 tracking-wide">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <input type="password" name="password" required class="input-field w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 transition">
                </div>
            </div>
            <button type="submit" class="btn-login w-full text-white font-bold py-3.5 rounded-lg shadow-lg text-sm uppercase tracking-wider">
                Sign In to Faculty Portal
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <a href="login.php" class="text-sm text-teal-700 hover:text-teal-800 font-medium transition">
                Admin Login →
            </a>
            <span class="text-gray-400 mx-2">|</span>
            <a href="welcome.php" class="text-sm text-teal-700 hover:text-teal-800 font-medium transition">
                ← Back to Home
            </a>
        </div>
        
        <p class="text-center text-xs text-gray-500 mt-6">
            Secure Faculty Evaluation Portal
        </p>
    </div>
</body>
</html>
