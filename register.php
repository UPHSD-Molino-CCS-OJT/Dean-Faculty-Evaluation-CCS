<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty_evaluation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $_POST['password'];
    
    // Hash the password for security
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Check if table exists, create if not
    $conn->query("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )");

    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='bg-green-100 text-green-700 p-3 rounded mb-4'>Admin account '$user' created! <a href='login.php' class='underline font-bold'>Login here</a></div>";
    } else {
        $message = "<div class='bg-red-100 text-red-700 p-3 rounded mb-4'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Temp Register - UPHSD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-96 border-t-4 border-blue-600">
        <h2 class="text-xl font-bold mb-4">Create Admin Account</h2>
        <p class="text-xs text-gray-500 mb-6">Use this to regain access to your dashboard.</p>
        
        <?php echo $message; ?>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Username</label>
                <input type="text" name="username" required class="w-full p-2 border rounded">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-bold mb-1">Password</label>
                <input type="password" name="password" required class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700">Create Account</button>
        </form>
    </div>
</body>
</html>