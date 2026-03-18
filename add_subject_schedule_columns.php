<?php
// Add days and time columns to evaluations table
require_once __DIR__ . '/includes/config.php';

echo "<h2>Adding Subject Schedule Columns to Evaluations Table</h2>";

$queries = [
    "ALTER TABLE evaluations ADD COLUMN days VARCHAR(100) NULL AFTER subject_handled",
    "ALTER TABLE evaluations ADD COLUMN time VARCHAR(100) NULL AFTER days"
];

foreach ($queries as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "✓ Executed: <code>" . htmlspecialchars($sql) . "</code><br>";
    } else {
        if (strpos($conn->error, "Duplicate column name") !== false) {
            echo "✓ Column already exists for: <code>" . htmlspecialchars($sql) . "</code><br>";
        } else {
            echo "✗ Error on: <code>" . htmlspecialchars($sql) . "</code><br>";
            echo "Error: " . htmlspecialchars($conn->error) . "<br>";
        }
    }
}

echo "<br><strong>Migration complete.</strong>";

$conn->close();
?>
