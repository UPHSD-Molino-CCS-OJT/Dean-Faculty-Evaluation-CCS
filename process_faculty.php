<?php
include 'header.php';

if (isset($_POST['add_faculty'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $dept = $conn->real_escape_string($_POST['department']);

    $sql = "INSERT INTO faculty (name, department) VALUES ('$name', '$dept')";
    
    if ($conn->query($sql)) {
        header("Location: dashboard.php?view=faculty&status=success");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>