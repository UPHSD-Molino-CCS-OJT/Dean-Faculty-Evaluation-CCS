<?php
// Process faculty addition without including header (to allow redirects)
include '../includes/config.php';
$conn = getDbConnection();

if (isset($_POST['add_faculty'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $dept = $conn->real_escape_string($_POST['department']);

    $sql = "INSERT INTO faculty (name, department) VALUES ('$name', '$dept')";
    
    if ($conn->query($sql)) {
        header("Location: dashboard.php?view=faculty&status=success");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    header("Location: dashboard.php?view=faculty");
    exit();
}
?>