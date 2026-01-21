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

    $result = $conn->query("SELECT * FROM users WHERE username='$user'");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: dashboard.php");
            exit();
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
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-xl w-96 border-t-4 border-blue-800">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Login</h2>
            <p class="text-sm text-gray-600">College of Computer Studies</p>
        </div>
        
        <?php if($error): ?>
            <div class="bg-blue-100 text-blue-700 p-2 rounded mb-4 text-sm text-center"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Username</label>
                <input type="text" name="username" requiblue class="w-full p-2 border rounded focus:outline-blue-800">
            </div>
            <div class="mb-6">
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Password</label>
                <input type="password" name="password" requiblue class="w-full p-2 border rounded focus:outline-blue-800">
            </div>
            <button type="submit" class="w-full bg-blue-800 text-white font-bold py-2 rounded hover:bg-blue-900 transition">LOGIN</button>
        </form>
    </div>
</body>
</html>