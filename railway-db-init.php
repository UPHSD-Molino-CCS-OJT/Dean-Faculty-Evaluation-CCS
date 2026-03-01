<?php
/**
 * Railway Database Initialization Script
 * 
 * This script automatically initializes the database schema for Railway deployment.
 * Run this ONCE after deploying to Railway to set up all required tables.
 * 
 * IMPORTANT: Delete this file after successful initialization for security!
 */

// Database Connection
require_once __DIR__ . '/includes/config.php';

// Set longer execution time for large SQL imports
set_time_limit(300);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Railway Database Initialization</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">
                🚀 Railway Database Initialization
            </h1>
            
            <?php
            $errors = [];
            $success = [];
            $warnings = [];
            
            // Check if database connection is successful
            if (!$conn || $conn->connect_error) {
                $errors[] = "Database connection failed. Check your Railway environment variables.";
            } else {
                $success[] = "✓ Database connection successful";
                
                // Check if tables already exist
                $tables_to_check = ['evaluations', 'evaluation_details', 'faculty', 'users', 'settings'];
                $existing_tables = [];
                
                foreach ($tables_to_check as $table) {
                    $result = $conn->query("SHOW TABLES LIKE '$table'");
                    if ($result && $result->num_rows > 0) {
                        $existing_tables[] = $table;
                    }
                }
                
                if (count($existing_tables) > 0) {
                    $warnings[] = "⚠️ Some tables already exist: " . implode(', ', $existing_tables);
                    $warnings[] = "This script will skip creating existing tables to preserve your data.";
                }
                
                // Read and execute SQL file
                $sql_file = __DIR__ . '/sql/faculty_evaluation.sql';
                
                if (!file_exists($sql_file)) {
                    $errors[] = "SQL file not found at: $sql_file";
                } else {
                    $success[] = "✓ SQL file found";
                    
                    // Read SQL file
                    $sql_content = file_get_contents($sql_file);
                    
                    if ($sql_content === false) {
                        $errors[] = "Failed to read SQL file";
                    } else {
                        // Remove SQL comments and split by semicolon
                        $sql_content = preg_replace('/--.*$/m', '', $sql_content);
                        $sql_content = preg_replace('/\/\*.*?\*\//s', '', $sql_content);
                        
                        // Split queries
                        $queries = array_filter(
                            array_map('trim', explode(';', $sql_content)),
                            function($query) {
                                return !empty($query) && strlen($query) > 5;
                            }
                        );
                        
                        $success[] = "✓ Found " . count($queries) . " SQL statements to execute";
                        
                        // Execute queries
                        $executed = 0;
                        $skipped = 0;
                        $failed = 0;
                        
                        // Disable foreign key checks temporarily
                        $conn->query("SET FOREIGN_KEY_CHECKS=0");
                        
                        foreach ($queries as $query) {
                            // Skip certain statements
                            if (
                                stripos($query, 'SET SQL_MODE') === 0 ||
                                stripos($query, 'SET time_zone') === 0 ||
                                stripos($query, 'START TRANSACTION') === 0 ||
                                stripos($query, 'COMMIT') === 0 ||
                                stripos($query, '/*!') === 0
                            ) {
                                $skipped++;
                                continue;
                            }
                            
                            // Execute query
                            if ($conn->query($query)) {
                                $executed++;
                            } else {
                                // Check if error is due to existing table/data
                                if (
                                    stripos($conn->error, 'already exists') !== false ||
                                    stripos($conn->error, 'Duplicate entry') !== false ||
                                    stripos($conn->error, 'Duplicate key') !== false
                                ) {
                                    $skipped++;
                                } else {
                                    $failed++;
                                    $errors[] = "Query failed: " . substr($query, 0, 100) . "... | Error: " . $conn->error;
                                }
                            }
                        }
                        
                        // Re-enable foreign key checks
                        $conn->query("SET FOREIGN_KEY_CHECKS=1");
                        
                        if ($executed > 0) {
                            $success[] = "✓ Successfully executed $executed SQL statements";
                        }
                        if ($skipped > 0) {
                            $warnings[] = "⚠️ Skipped $skipped statements (already exist or not applicable)";
                        }
                        if ($failed > 0) {
                            $errors[] = "✗ Failed to execute $failed statements (see errors above)";
                        }
                    }
                }
                
                // Verify table creation
                echo "<div class='mt-6'><h2 class='text-xl font-bold mb-2'>📊 Database Tables Status:</h2>";
                echo "<table class='w-full border-collapse border border-gray-300'>";
                echo "<thead class='bg-gray-100'>";
                echo "<tr><th class='border border-gray-300 px-4 py-2'>Table</th><th class='border border-gray-300 px-4 py-2'>Status</th><th class='border border-gray-300 px-4 py-2'>Rows</th></tr>";
                echo "</thead><tbody>";
                
                foreach ($tables_to_check as $table) {
                    $result = $conn->query("SHOW TABLES LIKE '$table'");
                    if ($result && $result->num_rows > 0) {
                        $count_result = $conn->query("SELECT COUNT(*) as count FROM `$table`");
                        $count = $count_result ? $count_result->fetch_assoc()['count'] : 0;
                        echo "<tr>";
                        echo "<td class='border border-gray-300 px-4 py-2'>$table</td>";
                        echo "<td class='border border-gray-300 px-4 py-2 text-green-600'>✓ Exists</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>$count</td>";
                        echo "</tr>";
                    } else {
                        echo "<tr>";
                        echo "<td class='border border-gray-300 px-4 py-2'>$table</td>";
                        echo "<td class='border border-gray-300 px-4 py-2 text-red-600'>✗ Missing</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>-</td>";
                        echo "</tr>";
                    }
                }
                
                echo "</tbody></table></div>";
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
            
            if (count($warnings) > 0) {
                echo "<div class='bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mt-4'>";
                echo "<h3 class='font-bold mb-2'>⚠️ Warnings:</h3><ul class='list-disc list-inside'>";
                foreach ($warnings as $msg) {
                    echo "<li>$msg</li>";
                }
                echo "</ul></div>";
            }
            
            if (count($errors) > 0) {
                echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4'>";
                echo "<h3 class='font-bold mb-2'>✗ Errors:</h3><ul class='list-disc list-inside'>";
                foreach ($errors as $msg) {
                    echo "<li class='text-sm break-all'>$msg</li>";
                }
                echo "</ul></div>";
            }
            
            if (count($errors) === 0 && count($success) > 0) {
                echo "<div class='bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mt-6'>";
                echo "<h3 class='font-bold mb-2'>🎉 Database Initialization Complete!</h3>";
                echo "<p class='mb-2'>Your faculty evaluation system is ready to use.</p>";
                echo "<p class='mb-2'><strong>Next Steps:</strong></p>";
                echo "<ol class='list-decimal list-inside space-y-1'>";
                echo "<li>Test admin login at <a href='/login.php' class='text-blue-600 underline'>/login.php</a>";
                echo " (username: <code>admin</code>, password: <code>admin123</code>)</li>";
                echo "<li>Change the default admin password immediately</li>";
                echo "<li>Configure faculty accounts</li>";
                echo "<li><strong class='text-red-600'>DELETE THIS FILE (railway-db-init.php) FOR SECURITY!</strong></li>";
                echo "</ol></div>";
            }
            
            // Display database connection info (for debugging)
            echo "<div class='bg-gray-100 border border-gray-300 text-gray-700 px-4 py-3 rounded mt-6'>";
            echo "<h3 class='font-bold mb-2'>📝 Connection Details:</h3>";
            echo "<ul class='list-disc list-inside text-sm'>";
            echo "<li>Host: " . ($servername ?? 'Not set') . "</li>";
            echo "<li>Database: " . ($dbname ?? 'Not set') . "</li>";
            echo "<li>Username: " . ($username ?? 'Not set') . "</li>";
            echo "<li>Port: " . ($port ?? 'Not set') . "</li>";
            echo "</ul></div>";
            
            $conn->close();
            ?>
            
            <div class="mt-6 text-center">
                <a href="/" class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
                    Go to Home Page
                </a>
                <a href="/login.php" class="inline-block bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 ml-2">
                    Go to Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>
