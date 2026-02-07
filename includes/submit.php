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
    // Note: Ensure your HTML input for the text details is named 'exceptional_details' if you want this to work, 
    // otherwise if it's just 'exceptional', this logic might need adjustment based on your exact HTML form.
    // Based on your previous code, you might just be using the radio value. I will keep your logic safe:
    $exceptional_final = $conn->real_escape_string($exceptional_radio);

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

    // 6. Insert into Database (Main Record)
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
        
        // 6b. NEW: Get the ID of the record we just created
        $evaluation_id = $conn->insert_id;

        // 6c. NEW: Loop through POST data again to save individual answers
        // Prepares statement for speed and security
        $stmt_detail = $conn->prepare("INSERT INTO evaluation_details (evaluation_id, question_code, rating) VALUES (?, ?, ?)");
        
        foreach ($_POST as $key => $value) {
            // Check if the key looks like "sec1_q1", "sec2_q10", etc.
            // We ensure it starts with 'sec' and contains '_q'
            if (strpos($key, 'sec') === 0 && strpos($key, '_q') !== false) {
                $rating = intval($value);
                // Bind params: i = integer, s = string, i = integer
                $stmt_detail->bind_param("isi", $evaluation_id, $key, $rating);
                $stmt_detail->execute();
            }
        }
        $stmt_detail->close();

        // Success Message
        echo "<script>
                alert('Evaluation for $faculty_name submitted successfully!');
                window.location.href='../admin/dashboard.php';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>