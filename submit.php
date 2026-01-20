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
    // 1. Capture Basic Info
    $faculty_name = $conn->real_escape_string($_POST['faculty_name']);
    $total_units  = isset($_POST['total_units']) ? intval($_POST['total_units']) : 0;
    $comments     = $conn->real_escape_string($_POST['comments']);
    $complaint    = isset($_POST['complaint']) ? $_POST['complaint'] : 'no';
    $exceptional  = isset($_POST['exceptional']) ? $_POST['exceptional'] : 'no';
    
    // Subject Details
    $subj1 = $conn->real_escape_string($_POST['subj1']);
    $days1 = $conn->real_escape_string($_POST['days1']);
    $time1 = $conn->real_escape_string($_POST['time1']);

    /**
     * Helper function to calculate average of a section
     * @param array $data The $_POST array
     * @param string $prefix The section prefix (e.g., 'sec1')
     * @param int $count Number of questions in that section
     */
    function calculateSectionAvg($data, $prefix, $count) {
        $sum = 0;
        for ($i = 1; $i <= $count; $i++) {
            $key = $prefix . "_q" . $i;
            $sum += isset($data[$key]) ? intval($data[$key]) : 0;
        }
        return ($count > 0) ? ($sum / $count) : 0;
    }

    // 2. Calculate Section Averages
    $sec1_avg = calculateSectionAvg($_POST, 'sec1', 3);  // 3 items
    $sec2_avg = calculateSectionAvg($_POST, 'sec2', 11); // 11 items
    $sec3_avg = calculateSectionAvg($_POST, 'sec3', 5);  // 5 items
    $sec4_avg = calculateSectionAvg($_POST, 'sec4', 4);  // 4 items
    $sec5_avg = calculateSectionAvg($_POST, 'sec5', 2);  // 2 items

    // 3. Calculate Final Weighted Overall Rating
    // Weights: 10%, 60%, 10%, 10%, 10%
    $overall_rating = ($sec1_avg * 0.10) + 
                     ($sec2_avg * 0.60) + 
                     ($sec3_avg * 0.10) + 
                     ($sec4_avg * 0.10) + 
                     ($sec5_avg * 0.10);

    // 4. Calculate Total Raw Points (Sum of all answers)
    $total_points = 0;
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'sec') !== false && strpos($key, '_q') !== false) {
            $total_points += intval($value);
        }
    }

    // 5. Insert into Database
    // Note: Ensure your table 'evaluations' has these columns or matches the query below
    $sql = "INSERT INTO evaluations (
                faculty_name, 
                total_units,
                subject_handled,
                sec1_avg, sec2_avg, sec3_avg, sec4_avg, sec5_avg,
                total_points, 
                overall_rating, 
                additional_comments, 
                official_complaint,
                exceptional_performance
            ) VALUES (
                '$faculty_name', 
                $total_units,
                '$subj1',
                $sec1_avg, $sec2_avg, $sec3_avg, $sec4_avg, $sec5_avg,
                $total_points, 
                $overall_rating, 
                '$comments', 
                '$complaint',
                '$exceptional'
            )";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Evaluation for $faculty_name submitted successfully! Total Score: $total_points');
                window.location.href='index.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>