<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty_evaluation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $faculty_name = $_POST['faculty_name'];
    $comments = $_POST['comments'];
    $complaint = $_POST['complaint'];
    
    // Example Calculation logic based on your Excel weighted averages
    // In a full version, you would sum all q1, q2, etc.
    $total_points = 115; // Example placeholder
    $overall_rating = 4.56; // Example placeholder

    $sql = "INSERT INTO evaluations (faculty_name, total_points, overall_rating, additional_comments, official_complaint)
            VALUES ('$faculty_name', '$total_points', '$overall_rating', '$comments', '$complaint')";

    if ($conn->query($sql) === TRUE) {
        echo "Evaluation submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>