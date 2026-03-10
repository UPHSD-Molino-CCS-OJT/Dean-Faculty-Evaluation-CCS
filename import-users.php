<?php
/**
 * Import Users Data to Railway MySQL
 * Visit this page once to import all users
 * DELETE THIS FILE after successful import!
 */

require_once __DIR__ . '/includes/config.php';
set_time_limit(300);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Users Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">📥 Import Users Data</h1>
            
            <?php
            $errors = [];
            $success = [];
            
            // Check database connection
            if (!$conn || $conn->connect_error) {
                $errors[] = "Database connection failed: " . ($conn->connect_error ?? 'Unknown error');
            } else {
                $success[] = "✓ Connected to database: $dbname";
                
                // Drop existing users table if exists (to avoid conflicts)
                $conn->query("DROP TABLE IF EXISTS users");
                $success[] = "✓ Cleared old users table (if existed)";
                
                // Create users table
                $create_table = "CREATE TABLE `users` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `username` varchar(50) NOT NULL,
                  `password` varchar(255) NOT NULL,
                  `role` enum('admin','faculty') DEFAULT 'admin',
                  `faculty_id` int(11) DEFAULT NULL,
                  `full_name` varchar(255) DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  UNIQUE KEY `username` (`username`),
                  KEY `fk_faculty` (`faculty_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
                
                if ($conn->query($create_table)) {
                    $success[] = "✓ Created users table structure";
                } else {
                    $errors[] = "Failed to create users table: " . $conn->error;
                }
                
                // Insert users data
                $users = [
                    [1, 'admin', '$2y$10$8.0R.Y/1XU.L4U3fQO8fOe.hYk2C1X8x0fJ3J1r7Z5Z.X8f6W5e2q', 'admin', NULL, NULL],
                    [2, 'AdminCCSDeptEval', '$2y$10$b.doadelqn5.g1CmyG4h/OlogEMVVDVKS28rNw027RWflvKKoE9Aq', 'admin', NULL, NULL],
                    [3, 'val.fabregas', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 3, 'Val Patrick Fabregas'],
                    [4, 'roberto.malitao', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 4, 'Roberto Malitao'],
                    [5, 'homer.favenir', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 5, 'Homer Favenir'],
                    [6, 'fe.antonio', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 6, 'Fe Antonio'],
                    [7, 'marco.subion', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 7, 'Marco Antonio Subion'],
                    [8, 'luvim.eusebio', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 8, 'Luvim Eusebio'],
                    [9, 'rolando.quirong', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 9, 'Rolando Quirong'],
                    [10, 'arnold.galve', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 10, 'Arnold Galve'],
                    [11, 'edward.cruz', '$2y$10$.92bl9hLoYkfiAOGy7CTrOEuaXPS3qXm9WucpZkFjl0RFnd0dRE76', 'faculty', 11, 'Edward Cruz']
                ];
                
                $inserted = 0;
                foreach ($users as $user) {
                    $sql = "INSERT INTO users (id, username, password, role, faculty_id, full_name) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("isssss", $user[0], $user[1], $user[2], $user[3], $user[4], $user[5]);
                    
                    if ($stmt->execute()) {
                        $inserted++;
                    } else {
                        $errors[] = "Failed to insert user: " . $user[1] . " - " . $stmt->error;
                    }
                    $stmt->close();
                }
                
                if ($inserted > 0) {
                    $success[] = "✓ Inserted $inserted user accounts";
                }
                
                // Verify import
                $result = $conn->query("SELECT COUNT(*) as count FROM users");
                if ($result) {
                    $count = $result->fetch_assoc()['count'];
                    $success[] = "✓ Total users in database: $count";
                }
                
                // Display user list
                echo "<div class='mt-6'><h2 class='text-xl font-bold mb-2'>👥 Imported Users:</h2>";
                echo "<table class='w-full border-collapse border border-gray-300'>";
                echo "<thead class='bg-gray-100'>";
                echo "<tr><th class='border border-gray-300 px-4 py-2'>Username</th><th class='border border-gray-300 px-4 py-2'>Role</th><th class='border border-gray-300 px-4 py-2'>Full Name</th></tr>";
                echo "</thead><tbody>";
                
                $result = $conn->query("SELECT username, role, full_name FROM users ORDER BY role DESC, username");
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $role_badge = $row['role'] == 'admin' 
                            ? '<span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Admin</span>' 
                            : '<span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">Faculty</span>';
                        echo "<tr>";
                        echo "<td class='border border-gray-300 px-4 py-2 font-mono'>{$row['username']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>$role_badge</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>" . ($row['full_name'] ?? '-') . "</td>";
                        echo "</tr>";
                    }
                }
                
                echo "</tbody></table></div>";
                
                $conn->close();
            }
            
            // Display results
            if (count($success) > 0) {
                echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4'>";
                echo "<h3 class='font-bold mb-2'>✓ Success:</h3><ul class='list-disc list-inside'>";
                foreach ($success as $msg) {
                    echo "<li>$msg</li>";
                }
                echo "</ul></div>";
            }
            
            if (count($errors) > 0) {
                echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4'>";
                echo "<h3 class='font-bold mb-2'>✗ Errors:</h3><ul class='list-disc list-inside'>";
                foreach ($errors as $msg) {
                    echo "<li class='text-sm'>$msg</li>";
                }
                echo "</ul></div>";
            }
            
            if (count($errors) === 0 && count($success) > 0) {
                echo "<div class='bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mt-6'>";
                echo "<h3 class='font-bold mb-2'>🎉 Users Imported Successfully!</h3>";
                echo "<p class='mb-2'><strong>Next Steps:</strong></p>";
                echo "<ol class='list-decimal list-inside space-y-1'>";
                echo "<li>Test login with username: <code class='bg-gray-200 px-2 py-1'>admin</code> / password: <code class='bg-gray-200 px-2 py-1'>admin123</code></li>";
                echo "<li>Or faculty login: <code class='bg-gray-200 px-2 py-1'>val.fabregas</code> / password: <code class='bg-gray-200 px-2 py-1'>faculty123</code></li>";
                echo "<li><strong class='text-red-600'>DELETE THIS FILE (import-users.php) FOR SECURITY!</strong></li>";
                echo "</ol></div>";
                
                echo "<div class='bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mt-4'>";
                echo "<h3 class='font-bold mb-2'>📋 Default Credentials:</h3>";
                echo "<p><strong>Admin Accounts:</strong></p>";
                echo "<ul class='list-disc list-inside ml-4'>";
                echo "<li>admin / admin123</li>";
                echo "<li>AdminCCSDeptEval / admin123</li>";
                echo "</ul>";
                echo "<p class='mt-2'><strong>Faculty Accounts (all use password: faculty123):</strong></p>";
                echo "<ul class='list-disc list-inside ml-4'>";
                echo "<li>val.fabregas, roberto.malitao, homer.favenir, fe.antonio</li>";
                echo "<li>marco.subion, luvim.eusebio, rolando.quirong, arnold.galve, edward.cruz</li>";
                echo "</ul></div>";
            }
            ?>
            
            <div class="mt-6 text-center">
                <a href="/login.php" class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
                    Go to Login Page
                </a>
                <a href="/" class="inline-block bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 ml-2">
                    Go to Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>
