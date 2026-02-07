<?php
session_start();

// 1. Security Check
if (!isset($_SESSION['faculty_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

// 2. Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty_evaluation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 3. Get ID from URL
if (!isset($_GET['id'])) {
    header("Location: faculty_dashboard.php");
    exit();
}

$id = $conn->real_escape_string($_GET['id']);
$faculty_name = $_SESSION['faculty_name'];

// 4. Get evaluation data and verify it belongs to this faculty
$sql = "SELECT * FROM evaluations WHERE id = '$id' AND faculty_name = '" . $conn->real_escape_string($faculty_name) . "'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Record not found or access denied.";
    exit();
}

$data = $result->fetch_assoc();

// Handle signature upload
if (isset($_POST['upload_signature'])) {
    $target_dir = "../signatures/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $file_extension = strtolower(pathinfo($_FILES["signature_file"]["name"], PATHINFO_EXTENSION));
    $faculty_slug = preg_replace('/[^a-z0-9]+/', '_', strtolower($faculty_name));
    $target_file = $target_dir . $faculty_slug . "_signature." . $file_extension;
    
    // Check if image file
    $check = getimagesize($_FILES["signature_file"]["tmp_name"]);
    if($check !== false && in_array($file_extension, ['png', 'jpg', 'jpeg'])) {
        if ($_FILES["signature_file"]["size"] < 2000000) { // Less than 2MB
            if (move_uploaded_file($_FILES["signature_file"]["tmp_name"], $target_file)) {
                // Update database with signature path and date
                $sig_path = "signatures/" . $faculty_slug . "_signature." . $file_extension;
                $sign_date = date('Y-m-d');
                $update_sql = "UPDATE faculty SET signature_path = '" . $conn->real_escape_string($sig_path) . "', signature_date = '" . $sign_date . "' WHERE name = '" . $conn->real_escape_string($faculty_name) . "'";
                $conn->query($update_sql);
                header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
                exit();
            }
        }
    }
}

// Handle signature removal
if (isset($_POST['remove_signature'])) {
    $sig_sql = "SELECT signature_path FROM faculty WHERE name = '" . $conn->real_escape_string($faculty_name) . "'";
    $sig_result = $conn->query($sig_sql);
    if ($sig_result && $sig_result->num_rows > 0) {
        $sig_row = $sig_result->fetch_assoc();
        if ($sig_row['signature_path']) {
            $file_to_delete = '../' . $sig_row['signature_path'];
            if (file_exists($file_to_delete)) {
                unlink($file_to_delete);
            }
            $update_sql = "UPDATE faculty SET signature_path = NULL, signature_date = NULL WHERE name = '" . $conn->real_escape_string($faculty_name) . "'";
            $conn->query($update_sql);
        }
    }
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
    exit();
}

// Fetch faculty signature
$signature_path = null;
$signature_date = null;
$sig_sql = "SELECT signature_path, signature_date FROM faculty WHERE name = '" . $conn->real_escape_string($faculty_name) . "'";
$sig_result = $conn->query($sig_sql);
if ($sig_result && $sig_result->num_rows > 0) {
    $sig_row = $sig_result->fetch_assoc();
    $signature_path = $sig_row['signature_path'];
    $signature_date = $sig_row['signature_date'];
}

// Fetch Specific Answers (Checklist)
$answers = [];
$sql_details = "SELECT question_code, rating FROM evaluation_details WHERE evaluation_id = '$id'";
$result_details = $conn->query($sql_details);
while($row = $result_details->fetch_assoc()) {
    $answers[$row['question_code']] = $row['rating'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Details - Faculty Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,600;0,700;1,700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .nav-gradient { 
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
        }
        @media print {
            @page { 
                margin: 0;
                size: auto;
            }
            .no-print { display: none !important; }
            body { 
                background: white;
                margin: 0;
                padding: 0.5in;
            }
            .py-10 { 
                padding: 0 !important; 
            }
            .max-w-5xl {
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            #printableArea {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                position: relative;
                min-height: 100vh;
                padding-bottom: 150px !important;
            }
            .print-footer-container {
                position: fixed;
                bottom: 0.5in;
                left: 0.5in;
                right: 0.5in;
                width: calc(100% - 1in);
            }
            /* Ensure Colors Print */
            .bg-red-50 { background-color: #fef2f2 !important; -webkit-print-color-adjust: exact; }
            .bg-red-100 { background-color: #fee2e2 !important; -webkit-print-color-adjust: exact; }
            .bg-gray-800 { background-color: #1f2937 !important; -webkit-print-color-adjust: exact; }
            .bg-gray-200 { background-color: #e5e7eb !important; -webkit-print-color-adjust: exact; }
            .text-red-900 { color: #7f1d1d !important; -webkit-print-color-adjust: exact; }
            .text-red-800 { color: #991b1b !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-teal-50">

    <nav class="nav-gradient text-white shadow-2xl sticky top-0 z-50 no-print">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="uppercase">
                        <div class="font-black text-xl tracking-tight leading-tight">Faculty Portal</div>
                        <div class="font-medium text-teal-200 text-xs tracking-wide">Evaluation Details</div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="faculty_dashboard.php" class="px-5 py-2 bg-white/20 hover:bg-white/30 rounded-lg font-bold text-sm transition">
                        ← Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-10 px-4">
        <div class="max-w-5xl mx-auto mb-4 flex justify-end no-print">
            <button onclick="window.print()" class="bg-red-800 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-900 transition shadow-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print Evaluation
            </button>
        </div>

        <div class="max-w-5xl mx-auto bg-white border border-gray-400 shadow-2xl p-6 md:p-10" id="printableArea">
            
            <div class="w-full border-b-2 border-red-800 pb-2 mb-6">
                <img src="../header-image.png" alt="University Header" class="w-full h-auto">
            </div>

            <h2 class="text-center text-xl font-black mb-8 uppercase tracking-widest text-gray-800">DEAN'S FACULTY EVALUATION</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs mb-8 border-b pb-6">
                <div class="space-y-3">
                    <p><strong>Faculty Name:</strong> <span class="ml-2 border-b border-gray-400 font-bold uppercase text-red-900"><?php echo htmlspecialchars($data['faculty_name']); ?></span></p>
                    <p><strong>College Dean:</strong> <span class="ml-2 border-b border-gray-400 font-bold">MS. MARIBEL SANDAGON</span></p>
                    <p><strong>College:</strong> <span class="ml-2 border-b border-gray-400 font-bold">CCS</span></p>
                </div>
                <div class="space-y-3">
                    <p><strong>Semester:</strong> <span class="ml-2 border-b border-gray-400 font-bold"><?php echo $data['semester'] ?? 'N/A'; ?></span></p>
                    <p><strong>School Year:</strong> <span class="ml-2 border-b border-gray-400 font-bold"><?php echo $data['school_year'] ?? 'N/A'; ?></span></p>
                    <p><strong>Total Units:</strong> <span class="ml-2 border-b border-gray-400 font-bold"><?php echo $data['total_units'] ?? '0'; ?></span></p>
                </div>
                <div class="bg-red-50 p-4 border-2 border-red-800 rounded-lg shadow-inner">
                    <div class="flex justify-between font-bold text-gray-700"><span>TOTAL POINTS:</span> <span><?php echo $data['total_points']; ?></span></div>
                    <div class="flex justify-between font-bold text-red-800 text-sm mt-2"><span>OVERALL RATING:</span> <span><?php echo number_format($data['overall_rating'], 2); ?></span></div>
                    <div class="flex justify-between text-[10px] mt-2 italic text-gray-500 uppercase tracking-tighter"><span>Date Submitted:</span> <span><?php echo date('M d, Y', strtotime($data['date_submitted'])); ?></span></div>
                </div>
            </div>

            <table class="w-full border-collapse border border-black text-xs mb-8">
                <thead>
                    <tr class="bg-gray-800 text-white font-bold">
                        <th class="p-3 border border-black text-left w-2/3">EVALUATION CRITERIA</th>
                        <th class="p-1 border border-black text-center w-8">5</th>
                        <th class="p-1 border border-black text-center w-8">4</th>
                        <th class="p-1 border border-black text-center w-8">3</th>
                        <th class="p-1 border border-black text-center w-8">2</th>
                        <th class="p-1 border border-black text-center w-8">1</th>
                    </tr>
                </thead>
                <?php
                // Define Sections (Exact same questions as index.php)
                $sections = [
                    'sec1' => [
                        'title' => 'I. Personal and Social Traits (10%)',
                        'items' => [
                            "Is innovative, enthusiastic, approachable and helpful.",
                            "Dresses appropriately for classroom instructions and projects a tone and manner that is pleasant and encouraging.",
                            "Uses courteous and appropriate verbal expressions and language while teaching."
                        ]
                    ],
                    'sec2' => [
                        'title' => 'II. Instructional Competence (60%)',
                        'items' => [
                            "Shows mastery of the subject matter and comes to class well prepared for the learning tasks/activities for the day.",
                            "Explains the lessons clearly and uses examples or illustrations for students to better understand the lesson and participate in the discussions or activities.",
                            "Relates lessons with other issues, concerns or developments which are of local, national or global significance.",
                            "Entertains and answers convincingly questions from students and encourages them to ask questions or seek clarification.",
                            "Evaluates students' performance through tests and other means of assessment.",
                            "Provides students with opportunities to think critically, creatively and reflectively.",
                            "Uses technology or teaching aids/devices to arouse and sustain student interest.",
                            "Makes use of varied strategies to develop the daily lesson and creates opportunities to address individual differences.",
                            "Provides the students with the course outline at the start of the semester and sees to it that all subject matter indicated are covered within the semester.",
                            "Gives follow-up work and further learning activities through assignments, reading, library work, projects and researches.",
                            "Is fair and impartial in grading students and gives constructive feedback to students on their performance through the teacher's availability for academic consultation."
                        ]
                    ],
                    'sec3' => [
                        'title' => 'III. Classroom Management (10%)',
                        'items' => [
                            "Starts and ends the class with a prayer.",
                            "Maintains order and discipline throughout the period for learning to take place.",
                            "Collects test papers, homeworks, projects, and returns them within a reasonable period of time.",
                            "Calls his students by name and manifests good rapport with them.",
                            "Keeps an accurate record of attendance, punctuality, quizzes, tests and other measures to assess student interest and performance."
                        ]
                    ],
                    'sec4' => [
                        'title' => 'IV. Conduct Towards School Authority (10%)',
                        'items' => [
                            "Renders due respect to immediate superior and College officials.",
                            "Manifests loyalty to his institution.",
                            "Fulfills properly his duties and obligations in the college/department.",
                            "Attends official functions and college-sponsored activities (Graduation, faculty meetings, opening of school year and academic functions)."
                        ]
                    ],
                    'sec5' => [
                        'title' => 'V. Professional Advancement (10%)',
                        'items' => [
                            "Seeks professional advancement through membership in organization and attendance/participation in seminar/workshops in line with the Faculty Development Program of the University.",
                            "Participates actively in research undertakings and in the presentation, dissemination and publication of research outputs."
                        ]
                    ]
                ];

                foreach ($sections as $sec_id => $sec_data) {
                    // Section Header
                    echo "<tr class='bg-gray-200 font-bold text-gray-800'><td colspan='6' class='p-2 border border-black'>{$sec_data['title']}</td></tr>";
                    
                    foreach ($sec_data['items'] as $index => $text) {
                        $qNum = $index + 1;
                        $key = "{$sec_id}_q{$qNum}";
                        $rating = $answers[$key] ?? 0;

                        echo "<tr>";
                        echo "<td class='p-2 border border-black'>$qNum. $text</td>";
                        
                        for ($v = 5; $v >= 1; $v--) {
                            // Using a simple unicode checkmark for clean print output
                            $mark = ($rating == $v) ? '&#10004;' : ''; 
                            $bg = ($rating == $v) ? 'bg-red-100 font-bold text-red-800' : '';
                            
                            echo "<td class='border border-black text-center $bg text-sm'>$mark</td>";
                        }
                        echo "</tr>";
                    }
                }
                ?>
            </table>

            <div class="text-xs mb-10">
                <p class="font-bold underline mb-2 italic">Additional Comments/Remarks:</p>
                <div class="p-5 border border-dashed border-gray-400 italic bg-gray-50 min-h-[80px] leading-relaxed">
                    <?php echo !empty($data['additional_comments']) ? nl2br(htmlspecialchars($data['additional_comments'])) : 'No additional comments provided by the Dean.'; ?>
                </div>
            </div>

            <div class="mt-16 flex justify-between items-end text-[11px] text-center px-10">
                <div class="w-64">
                    <?php if ($signature_path && file_exists('../' . $signature_path)): ?>
                        <img src="../<?php echo htmlspecialchars($signature_path); ?>" alt="Faculty Signature" class="h-16 mx-auto mb-2 border-b-2 border-transparent">
                    <?php else: ?>
                        <div class="h-16 flex items-center justify-center mb-2">
                            <button type="button" onclick="document.getElementById('sigUploadForm').classList.toggle('hidden')" class="no-print text-teal-700 hover:text-teal-900 text-xs underline">
                                + Upload E-Signature
                            </button>
                        </div>
                        <form id="sigUploadForm" method="POST" enctype="multipart/form-data" class="hidden no-print mb-2 p-3 bg-teal-50 rounded border border-teal-200">
                            <input type="file" name="signature_file" accept="image/png,image/jpeg,image/jpg" required class="text-xs mb-2 w-full">
                            <button type="submit" name="upload_signature" class="bg-teal-700 text-white px-3 py-1 rounded text-xs hover:bg-teal-800 w-full">Upload</button>
                        </form>
                    <?php endif; ?>
                    <p class="border-b-2 border-black font-bold uppercase pb-1"><?php echo htmlspecialchars($data['faculty_name']); ?></p>
                    <p class="mt-1">Faculty Member's Signature</p>
                    <?php if ($signature_path && file_exists('../' . $signature_path)): ?>
                        <button type="button" onclick="if(confirm('Remove your e-signature?')) document.getElementById('removeSigForm').submit();" class="no-print text-red-600 hover:text-red-800 text-[9px] underline mt-1">
                            Remove Signature
                        </button>
                        <form id="removeSigForm" method="POST" class="hidden">
                            <input type="hidden" name="remove_signature" value="1">
                        </form>
                    <?php endif; ?>
                    <p class="text-[9px] text-gray-500 italic">Date Signed: <?php echo $signature_date ? date('m/d/Y', strtotime($signature_date)) : '________________'; ?></p>
                </div>
                <div class="w-64">
                    <p class="border-b-2 border-black font-bold uppercase pb-1">MS. MARIBEL SANDAGON</p>
                    <p class="mt-1">Dean, College of Computer Studies</p>
                    <p class="text-[9px] text-gray-500 italic">Date Signed: <?php echo date('m/d/Y'); ?></p>
                </div>
            </div>

            <div class="mt-12 print-footer-container">
                <img src="../footer-image.png" alt="Evaluation Footer" class="w-full h-auto border-t-2 border-red-800 pt-2">
            </div>

        </div>
    </div>

</body>
</html>
