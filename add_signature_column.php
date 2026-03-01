<?php
// Quick script to add signature_path column to faculty table
require_once __DIR__ . '/includes/config.php';

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