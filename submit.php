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
    
    // NEW FIELDS CAPTURED HERE
    $semester    = $conn->real_escape_string($_POST['semester']);
    $school_year = $conn->real_escape_string($_POST['school_year']);
    
    $comments     = $conn->real_escape_string($_POST['comments']);
    $complaint    = isset($_POST['complaint']) ? $_POST['complaint'] : 'no';
    $exceptional  = isset($_POST['exceptional']) ? $_POST['exceptional'] : 'no';
    
    // Subject Details
    $subj1 = $conn->real_escape_string($_POST['subj1']);
    $days1 = $conn->real_escape_string($_POST['days1']);
    $time1 = $conn->real_escape_string($_POST['time1']);

    /**
     * Helper function to calculate average of a section
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
    $sec1_avg = calculateSectionAvg($_POST, 'sec1', 3);
    $sec2_avg = calculateSectionAvg($_POST, 'sec2', 11);
    $sec3_avg = calculateSectionAvg($_POST, 'sec3', 5);
    $sec4_avg = calculateSectionAvg($_POST, 'sec4', 4);
    $sec5_avg = calculateSectionAvg($_POST, 'sec5', 2);

    // 3. Calculate Final Weighted Overall Rating ($overall_rating$)
    // Formula: (S1 * 0.1) + (S2 * 0.6) + (S3 * 0.1) + (S4 * 0.1) + (S5 * 0.1)
    $overall_rating = ($sec1_avg * 0.10) + 
                      ($sec2_avg * 0.60) + 
                      ($sec3_avg * 0.10) + 
                      ($sec4_avg * 0.10) + 
                      ($sec5_avg * 0.10);

    // 4. Calculate Total Raw Points
    $total_points = 0;
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'sec') !== false && strpos($key, '_q') !== false) {
            $total_points += intval($value);
        }
    }

    // 5. Insert into Database (Updated with semester and school_year)
    $sql = "INSERT INTO evaluations (
                faculty_name, 
                semester,
                school_year,
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
                '$semester',
                '$school_year',
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
        // Redirect to dashboard so the Dean can see the result immediately
        echo "<script>
                alert('Evaluation for $faculty_name submitted successfully!');
                window.location.href='dashboard.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>