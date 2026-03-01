<?php
/**
 * Database Configuration File
 * Central database connection settings for the Faculty Evaluation System
 * Updated for Railway.com deployment with environment variable support
 */

// Database Connection Settings - Environment Variables with localhost fallback
$servername = getenv('DB_HOST') ?: (getenv('MYSQLHOST') ?: 'localhost');
$username = getenv('DB_USER') ?: (getenv('MYSQLUSER') ?: 'root');
$password = getenv('DB_PASSWORD') ?: (getenv('MYSQLPASSWORD') ?: '');
$dbname = getenv('DB_NAME') ?: (getenv('MYSQLDATABASE') ?: 'faculty_evaluation');
$port = getenv('DB_PORT') ?: (getenv('MYSQLPORT') ?: '3306');

// Create global database connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/**
 * Legacy function for backward compatibility
 * @return mysqli Database connection object
 * @deprecated Use global $conn instead
 */
function getDbConnection() {
    global $conn;
    return $conn;
}
?>
