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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CCS Evaluations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-red-800 text-white p-4 shadow-lg">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="font-bold text-lg tracking-wide">UPHSD | CCS Admin Dashboard</h1>
            <div class="flex gap-4 items-center">
                <a href="index.php" class="bg-white text-red-800 px-4 py-2 rounded font-bold text-sm hover:bg-gray-200 transition"> + New Evaluation</a>
                <a href="logout.php" class="text-xs hover:underline opacity-80">Logout</a>
            </div>
        </div>
    </nav>