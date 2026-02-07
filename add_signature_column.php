<?php
// Quick script to add signature_path column to faculty table
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty_evaluation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "ALTER TABLE faculty ADD COLUMN signature_path VARCHAR(255) NULL AFTER status";

if ($conn->query($sql) === TRUE) {
    echo "Column 'signature_path' added successfully to faculty table!\n";
} else {
    if (strpos($conn->error, "Duplicate column name") !== false) {
        echo "Column 'signature_path' already exists in faculty table.\n";
    } else {
        echo "Error: " . $conn->error . "\n";
    }
}

$conn->close();
?>