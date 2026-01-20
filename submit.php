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
    $semester     = $conn->real_escape_string($_POST['semester']);
    $school_year  = $conn->real_escape_string($_POST['school_year']);
    
    // 2. Capture Checklist and Comments
    $comments    = $conn->real_escape_string($_POST['comments']);
    $complaint   = isset($_POST['complaint']) ? $conn->real_escape_string($_POST['complaint']) : 'no';
    
    // Handle Exceptional Performance (Radio + Text Detail)
    $exceptional_radio = isset($_POST['exceptional']) ? $_POST['exceptional'] : 'no';
    $exceptional_details = isset($_POST['exceptional_details']) ? $conn->real_escape_string($_POST['exceptional_details']) : '';
    
    // Combine them if "yes" to store in one field, or just store the radio value
    $exceptional_final = ($exceptional_radio === 'yes' && !empty($exceptional_details)) 
                         ? "Yes: " . $exceptional_details 
                         : $exceptional_radio;

    // Subject Details
    $subj1 = $conn->real_escape_string($_POST['subj1']);

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

    // 3. Calculate Section Averages
    $sec1_avg = calculateSectionAvg($_POST, 'sec1', 3);
    $sec2_avg = calculateSectionAvg($_POST, 'sec2', 11);
    $sec3_avg = calculateSectionAvg($_POST, 'sec3', 5);
    $sec4_avg = calculateSectionAvg($_POST, 'sec4', 4);
    $sec5_avg = calculateSectionAvg($_POST, 'sec5', 2);

    // 4. Calculate Final Weighted Overall Rating
    // Formula: (S1*0.1) + (S2*0.6) + (S3*0.1) + (S4*0.1) + (S5*0.1)
    $overall_rating = ($sec1_avg * 0.10) + 
                      ($sec2_avg * 0.60) + 
                      ($sec3_avg * 0.10) + 
                      ($sec4_avg * 0.10) + 
                      ($sec5_avg * 0.10);

    // 5. Calculate Total Raw Points
    $total_points = 0;
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'sec') !== false && strpos($key, '_q') !== false) {
            $total_points += intval($value);
        }
    }

    // 6. Insert into Database
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
                '$exceptional_final'
            )";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Evaluation for $faculty_name submitted successfully!');
                window.location.href='dashboard.php';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>