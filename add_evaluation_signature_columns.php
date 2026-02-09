<?php
// Add signature columns to evaluations table for per-evaluation signatures
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty_evaluation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h2>Adding Signature Columns to Evaluations Table</h2>";

// Add dean signature columns
$sql1 = "ALTER TABLE evaluations 
         ADD COLUMN dean_signature_path VARCHAR(255) NULL AFTER date_submitted,
         ADD COLUMN dean_signature_date DATE NULL AFTER dean_signature_path";

if ($conn->query($sql1) === TRUE) {
    echo "✓ Dean signature columns added successfully!<br>";
} else {
    if (strpos($conn->error, "Duplicate column name") !== false) {
        echo "✓ Dean signature columns already exist.<br>";
    } else {
        echo "Error adding dean columns: " . $conn->error . "<br>";
    }
}

// Add faculty signature columns
$sql2 = "ALTER TABLE evaluations 
         ADD COLUMN faculty_signature_path VARCHAR(255) NULL AFTER dean_signature_date,
         ADD COLUMN faculty_signature_date DATE NULL AFTER faculty_signature_path";

if ($conn->query($sql2) === TRUE) {
    echo "✓ Faculty signature columns added successfully!<br>";
} else {
    if (strpos($conn->error, "Duplicate column name") !== false) {
        echo "✓ Faculty signature columns already exist.<br>";
    } else {
        echo "Error adding faculty columns: " . $conn->error . "<br>";
    }
}

echo "<br><strong>Migration complete! Signatures are now stored per evaluation.</strong>";

$conn->close();
?>
