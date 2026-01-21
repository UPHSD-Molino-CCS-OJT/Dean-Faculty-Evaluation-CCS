<?php
session_start();

// 1. Security Check
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// 2. Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty_evaluation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 3. Detect Current Page
$current_page = basename($_SERVER['PHP_SELF']);
$is_dashboard = ($current_page == 'dashboard.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS Faculty Evaluation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,600;0,700;1,700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .nav-blue { background-color: #1a3578; } 
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="nav-blue text-white shadow-lg no-print">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            
            <div class="flex items-center gap-3">
                <div class="uppercase">
                    <span class="font-black text-xl tracking-tight">College of Computer Studies</span>
                    <span class="font-bold italic text-blue-300 ml-1 text-lg">- UPHSD MOLINO</span>
                </div>
            </div>
            
            <div class="flex items-center gap-6">
                
                <?php if ($current_page !== 'index.php'): ?>
                    <a href="index.php" class="bg-white/10 hover:bg-white/40 text-white border border-white/30 px-4 py-2 rounded-lg font-bold text-xs uppercase tracking-wider transition">
                        + New Evaluation
                    </a>
                <?php endif; ?>

                <a href="dashboard.php" class="font-bold text-sm hover:text-blue-200 transition <?php echo $is_dashboard ? 'text-white' : 'text-gray-400'; ?>">Dashboard</a>
                
                <a href="logout.php" class="bg-[#ff4d4d] hover:bg-red-600 text-white px-6 py-2 rounded-xl font-bold text-sm transition shadow-md">
                    Logout
                </a>
            </div>
        </div>
    </nav>