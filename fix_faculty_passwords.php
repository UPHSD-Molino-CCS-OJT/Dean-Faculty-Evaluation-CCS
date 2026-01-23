<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fix Faculty Passwords</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Fix Faculty Passwords</h1>
            
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "faculty_evaluation";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4'>
                    <strong>Connection failed:</strong> " . $conn->connect_error . "</div>");
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "<div class='space-y-4 mb-6'>";
                
                // Generate correct password hash for 'faculty123'
                $correct_password_hash = password_hash('faculty123', PASSWORD_DEFAULT);
                
                // Update all faculty users with the correct password
                $sql = "UPDATE `users` SET `password` = '$correct_password_hash' WHERE `role` = 'faculty'";
                
                if ($conn->query($sql) === TRUE) {
                    $affected = $conn->affected_rows;
                    echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded'>
                        ✓ Successfully updated passwords for $affected faculty accounts</div>";
                    
                    echo "<div class='bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mt-4'>
                        <strong>Password Updated!</strong><br>
                        <ul class='list-disc list-inside mt-2'>
                            <li>All faculty accounts now use password: <code class='bg-blue-200 px-2 py-1 rounded font-bold'>faculty123</code></li>
                            <li><a href='faculty_login.php' class='underline font-bold'>Go to Faculty Login</a></li>
                            <li><a href='welcome.php' class='underline font-bold'>Go to Welcome Page</a></li>
                        </ul>
                    </div>";
                } else {
                    echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded'>
                        ✗ Error updating passwords: " . $conn->error . "</div>";
                }

                echo "</div>";
                
                // Show updated users
                $result = $conn->query("SELECT id, username, full_name, role FROM users WHERE role='faculty'");
                if ($result->num_rows > 0) {
                    echo "<div class='mt-6'>
                        <h3 class='font-bold mb-3'>Updated Faculty Accounts:</h3>
                        <table class='min-w-full bg-white border border-gray-300'>
                            <thead class='bg-gray-100'>
                                <tr>
                                    <th class='px-4 py-2 border'>Username</th>
                                    <th class='px-4 py-2 border'>Full Name</th>
                                    <th class='px-4 py-2 border'>Password</th>
                                </tr>
                            </thead>
                            <tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td class='px-4 py-2 border font-mono text-sm'>" . htmlspecialchars($row['username']) . "</td>
                            <td class='px-4 py-2 border'>" . htmlspecialchars($row['full_name']) . "</td>
                            <td class='px-4 py-2 border text-center'><code class='bg-green-100 px-2 py-1 rounded'>faculty123</code></td>
                        </tr>";
                    }
                    echo "</tbody></table></div>";
                }
            }

            $conn->close();
            ?>

            <?php if ($_SERVER["REQUEST_METHOD"] != "POST"): ?>
            <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 px-4 py-3 rounded mb-6">
                <h2 class="font-bold mb-2">⚠️ Password Reset</h2>
                <p class="text-sm">This script will update the password for all faculty accounts to: <code class='bg-yellow-200 px-2 py-1 rounded font-bold'>faculty123</code></p>
            </div>

            <form method="POST">
                <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-6 rounded-lg transition">
                    Fix Faculty Passwords Now
                </button>
            </form>

            <div class="mt-6 p-4 bg-gray-50 rounded">
                <h3 class="font-bold mb-2 text-gray-700">What this does:</h3>
                <ul class="text-sm text-gray-600 space-y-1 list-disc list-inside">
                    <li>Generates a new, correct password hash for "faculty123"</li>
                    <li>Updates all faculty user accounts with the correct hash</li>
                    <li>Does NOT affect admin accounts</li>
                    <li>Safe to run multiple times</li>
                </ul>
            </div>
            <?php endif; ?>
        </div>

        <div class="mt-4 text-center text-sm text-gray-600">
            <p>After fixing passwords, you can delete this file.</p>
        </div>
    </div>
</body>
</html>
