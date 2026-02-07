<?php
/**
 * Database Configuration File
 * Central database connection settings for the Faculty Evaluation System
 */

// Database Connection Settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'faculty_evaluation');

/**
 * Get Database Connection
 * @return mysqli Database connection object
 */
function getDbConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}
?>
