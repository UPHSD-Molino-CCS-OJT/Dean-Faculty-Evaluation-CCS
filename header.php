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

// Set Dynamic Content based on page
if ($current_page == 'index.php') {
    $page_title = "New Evaluation - CCS";
    $nav_heading = "UPHSD | CCS Faculty Evaluation";
    $nav_button = '<a href="dashboard.php" class="bg-white text-red-800 px-4 py-2 rounded font-bold text-sm hover:bg-gray-200 transition">View Dashboard</a>';
} else {
    $page_title = "Admin Dashboard - CCS";
    $nav_heading = "UPHSD | CCS Admin Dashboard";
    $nav_button = '<a href="index.php" class="bg-white text-red-800 px-4 py-2 rounded font-bold text-sm hover:bg-gray-200 transition">+ New Evaluation</a>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-red-800 text-white p-4 shadow-lg">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="font-bold text-lg tracking-wide"><?php echo $nav_heading; ?></h1>
            
            <div class="flex gap-4 items-center">
                <?php echo $nav_button; ?>
                <a href="logout.php" class="text-xs hover:underline opacity-80">Logout</a>
            </div>
        </div>
    </nav>