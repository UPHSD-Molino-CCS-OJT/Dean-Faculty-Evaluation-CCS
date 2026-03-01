<?php
/**
 * Railway Deployment Test Page
 * Visit this page to diagnose deployment issues
 */

echo "<h1>Railway Deployment Diagnostics</h1>";
echo "<style>body { font-family: monospace; padding: 20px; } .ok { color: green; } .error { color: red; } pre { background: #f0f0f0; padding: 10px; }</style>";

// Test 1: PHP Version
echo "<h2>✓ PHP Version</h2>";
echo "<pre>" . phpversion() . "</pre>";

// Test 2: Required Extensions
echo "<h2>PHP Extensions</h2>";
$required = ['mysqli', 'gd', 'session', 'fileinfo'];
foreach ($required as $ext) {
    $status = extension_loaded($ext) ? '<span class="ok">✓ LOADED</span>' : '<span class="error">✗ MISSING</span>';
    echo "<div>$ext: $status</div>";
}

// Test 3: Environment Variables
echo "<h2>Environment Variables</h2>";
$env_vars = ['MYSQLHOST', 'MYSQLPORT', 'MYSQLUSER', 'MYSQLPASSWORD', 'MYSQLDATABASE', 
             'DB_HOST', 'DB_PORT', 'DB_USER', 'DB_PASSWORD', 'DB_NAME'];
$found = false;
foreach ($env_vars as $var) {
    $value = getenv($var);
    if ($value !== false) {
        $display = ($var === 'MYSQLPASSWORD' || $var === 'DB_PASSWORD') ? '***HIDDEN***' : $value;
        echo "<div class='ok'>$var = $display</div>";
        $found = true;
    } else {
        echo "<div class='error'>$var = NOT SET</div>";
    }
}

if (!$found) {
    echo "<div class='error'><strong>⚠️ NO DATABASE ENVIRONMENT VARIABLES FOUND!</strong></div>";
    echo "<p>Go to Railway Dashboard → MySQL Service → Copy Variables to PHP Service</p>";
}

// Test 4: Database Connection
echo "<h2>Database Connection Test</h2>";
$servername = getenv('DB_HOST') ?: (getenv('MYSQLHOST') ?: 'localhost');
$username = getenv('DB_USER') ?: (getenv('MYSQLUSER') ?: 'root');
$password = getenv('DB_PASSWORD') ?: (getenv('MYSQLPASSWORD') ?: '');
$dbname = getenv('DB_NAME') ?: (getenv('MYSQLDATABASE') ?: 'faculty_evaluation');
$port = getenv('DB_PORT') ?: (getenv('MYSQLPORT') ?: '3306');

echo "<div>Attempting connection to: <strong>$username@$servername:$port/$dbname</strong></div>";

try {
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    
    if ($conn->connect_error) {
        echo "<div class='error'>✗ Connection failed: " . htmlspecialchars($conn->connect_error) . "</div>";
        echo "<p><strong>Common fixes:</strong></p>";
        echo "<ul>";
        echo "<li>Verify MySQL service is running in Railway</li>";
        echo "<li>Check environment variables are set correctly</li>";
        echo "<li>Make sure PHP service references MySQL service</li>";
        echo "</ul>";
    } else {
        echo "<div class='ok'>✓ Database connection successful!</div>";
        
        // Check tables
        $tables = [];
        $result = $conn->query("SHOW TABLES");
        if ($result) {
            while ($row = $result->fetch_array()) {
                $tables[] = $row[0];
            }
            if (count($tables) > 0) {
                echo "<div class='ok'>✓ Found " . count($tables) . " tables: " . implode(', ', $tables) . "</div>";
            } else {
                echo "<div class='error'>⚠️ Database is empty. Run /railway-db-init.php to initialize.</div>";
            }
        }
        $conn->close();
    }
} catch (Exception $e) {
    echo "<div class='error'>✗ Exception: " . htmlspecialchars($e->getMessage()) . "</div>";
}

// Test 5: File System
echo "<h2>File System</h2>";
echo "<div>Current directory: <strong>" . getcwd() . "</strong></div>";
echo "<div>Signatures directory: ";
if (file_exists('signatures')) {
    echo "<span class='ok'>✓ EXISTS</span>";
    echo " (writable: " . (is_writable('signatures') ? '<span class="ok">YES</span>' : '<span class="error">NO</span>') . ")";
} else {
    echo "<span class='error'>✗ MISSING</span>";
}
echo "</div>";

echo "<hr><p><a href='/'>← Back to Home</a> | <a href='/login.php'>Login Page</a> | <a href='/railway-db-init.php'>Initialize Database</a></p>";
?>
