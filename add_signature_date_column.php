<?php
// Add signature_date column to faculty table
require_once __DIR__ . '/includes/config.php';

$sql = "ALTER TABLE faculty ADD COLUMN signature_date DATE NULL AFTER signature_path";

if ($conn->query($sql) === TRUE) {
    echo "Column 'signature_date' added successfully to faculty table!\n";
} else {
    if (strpos($conn->error, "Duplicate column name") !== false) {
        echo "Column 'signature_date' already exists in faculty table.\n";
    } else {
        echo "Error: " . $conn->error . "\n";
    }
}

$conn->close();
?>