<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Portal Setup - CCS Evaluation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Faculty Portal Setup</h1>
            
            <?php
            require_once __DIR__ . '/../includes/config.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "<div class='space-y-4 mb-6'>";
                
                // Check if columns already exist
                $check_query = "SHOW COLUMNS FROM users LIKE 'role'";
                $result = $conn->query($check_query);
                
                if ($result->num_rows > 0) {
                    echo "<div class='bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded'>
                        ⚠️ Database already updated. Skipping schema changes.</div>";
                } else {
                    // Add columns to users table
                    $sql1 = "ALTER TABLE `users` 
                            ADD COLUMN `role` ENUM('admin', 'faculty') DEFAULT 'admin' AFTER `password`,
                            ADD COLUMN `faculty_id` INT(11) NULL AFTER `role`,
                            ADD COLUMN `full_name` VARCHAR(255) NULL AFTER `faculty_id`";
                    
                    if ($conn->query($sql1) === TRUE) {
                        echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded'>
                            ✓ Added new columns to users table</div>";
                    } else {
                        echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded'>
                            ✗ Error adding columns: " . $conn->error . "</div>";
                    }

                    // Update existing admin users
                    $sql2 = "UPDATE `users` SET `role` = 'admin' WHERE `id` IN (1, 2)";
                    $conn->query($sql2);
                    echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded'>
                        ✓ Updated existing admin users</div>";
                }

                // Check if faculty users already exist
                $check_faculty = "SELECT COUNT(*) as count FROM users WHERE role='faculty'";
                $faculty_result = $conn->query($check_faculty);
                $faculty_row = $faculty_result->fetch_assoc();
                
                if ($faculty_row['count'] > 0) {
                    echo "<div class='bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded'>
                        ⚠️ Faculty users already exist. Skipping user creation.</div>";
                } else {
                    // Create faculty users
                    $faculty_users = [
                        ['val.fabregas', 3, 'Val Patrick Fabregas'],
                        ['roberto.malitao', 4, 'Roberto Malitao'],
                        ['homer.favenir', 5, 'Homer Favenir'],
                        ['fe.antonio', 6, 'Fe Antonio'],
                        ['marco.subion', 7, 'Marco Antonio Subion'],
                        ['luvim.eusebio', 8, 'Luvim Eusebio'],
                        ['rolando.quirong', 9, 'Rolando Quirong'],
                        ['arnold.galve', 10, 'Arnold Galve'],
                        ['edward.cruz', 11, 'Edward Cruz']
                    ];

                    $password_hash = password_hash('faculty123', PASSWORD_DEFAULT);
                    $success_count = 0;
                    
                    foreach ($faculty_users as $user) {
                        $sql = "INSERT INTO `users` (`username`, `password`, `role`, `faculty_id`, `full_name`) 
                               VALUES ('" . $conn->real_escape_string($user[0]) . "', 
                                      '$password_hash', 
                                      'faculty', 
                                      " . $user[1] . ", 
                                      '" . $conn->real_escape_string($user[2]) . "')";
                        if ($conn->query($sql) === TRUE) {
                            $success_count++;
                        }
                    }
                    
                    echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded'>
                        ✓ Created $success_count faculty user accounts</div>";
                }

                // Add foreign key constraint
                $check_fk = "SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS 
                            WHERE TABLE_NAME = 'users' AND CONSTRAINT_NAME = 'fk_faculty'";
                $fk_result = $conn->query($check_fk);
                
                if ($fk_result->num_rows > 0) {
                    echo "<div class='bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded'>
                        ⚠️ Foreign key constraint already exists</div>";
                } else {
                    $sql_fk = "ALTER TABLE `users` 
                              ADD CONSTRAINT `fk_faculty` 
                              FOREIGN KEY (`faculty_id`) REFERENCES `faculty`(`id`) ON DELETE SET NULL";
                    
                    if ($conn->query($sql_fk) === TRUE) {
                        echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded'>
                            ✓ Added foreign key constraint</div>";
                    } else {
                        echo "<div class='bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded'>
                            ⚠️ Foreign key constraint may already exist or error occurred: " . $conn->error . "</div>";
                    }
                }

                echo "</div>";
                
                echo "<div class='bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mt-6'>
                    <strong>Setup Complete!</strong><br>
                    <ul class='list-disc list-inside mt-2'>
                        <li>Faculty portal is now ready to use</li>
                        <li>Default password for all faculty: <code class='bg-blue-200 px-2 py-1 rounded'>faculty123</code></li>
                        <li><a href='../login.php' class='underline font-bold'>Go to Login Page</a></li>
                    </ul>
                </div>";
            }

            $conn->close();
            ?>

            <?php if ($_SERVER["REQUEST_METHOD"] != "POST"): ?>
            <div class="bg-blue-50 border border-blue-300 text-blue-800 px-4 py-3 rounded mb-6">
                <h2 class="font-bold mb-2">This script will:</h2>
                <ul class="list-disc list-inside space-y-1 text-sm">
                    <li>Add role, faculty_id, and full_name columns to users table</li>
                    <li>Update existing admin users with admin role</li>
                    <li>Create faculty user accounts for all existing faculty members</li>
                    <li>Add foreign key constraint between users and faculty tables</li>
                    <li>Set default password 'faculty123' for all faculty accounts</li>
                </ul>
            </div>

            <form method="POST">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition">
                    Run Setup Now
                </button>
            </form>

            <div class="mt-6 p-4 bg-gray-50 rounded">
                <h3 class="font-bold mb-2 text-gray-700">Faculty User Credentials:</h3>
                <div class="text-xs text-gray-600 space-y-1">
                    <p><strong>Username:</strong> val.fabregas | <strong>Name:</strong> Val Patrick Fabregas</p>
                    <p><strong>Username:</strong> roberto.malitao | <strong>Name:</strong> Roberto Malitao</p>
                    <p><strong>Username:</strong> homer.favenir | <strong>Name:</strong> Homer Favenir</p>
                    <p><strong>Username:</strong> fe.antonio | <strong>Name:</strong> Fe Antonio</p>
                    <p><strong>Username:</strong> marco.subion | <strong>Name:</strong> Marco Antonio Subion</p>
                    <p><strong>Username:</strong> luvim.eusebio | <strong>Name:</strong> Luvim Eusebio</p>
                    <p><strong>Username:</strong> rolando.quirong | <strong>Name:</strong> Rolando Quirong</p>
                    <p><strong>Username:</strong> arnold.galve | <strong>Name:</strong> Arnold Galve</p>
                    <p><strong>Username:</strong> edward.cruz | <strong>Name:</strong> Edward Cruz</p>
                    <p class="mt-2 font-bold">All passwords: faculty123</p>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="mt-4 text-center text-sm text-gray-600">
            <p>⚠️ This script can be run multiple times safely - it checks for existing changes.</p>
            <p class="mt-2">After setup is complete, you can delete this file for security.</p>
        </div>
    </div>
</body>
</html>
