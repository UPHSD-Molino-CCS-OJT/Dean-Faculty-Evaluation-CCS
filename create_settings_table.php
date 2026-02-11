<?php
// Create settings table for dean signature
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty_evaluation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Settings table created successfully!\n";
    
    // Insert default settings records
    $insert = "INSERT IGNORE INTO settings (setting_key, setting_value) VALUES 
               ('dean_signature_path', NULL), 
               ('dean_signature_date', NULL),
               ('header_image_path', 'header-image.png'),
               ('footer_image_path', 'footer-image.png')";
    if ($conn->query($insert)) {
        echo "Default settings added (dean signature + header/footer images)!\n";
    }
} else {
    echo "Error: " . $conn->error . "\n";
}

$conn->close();
?>