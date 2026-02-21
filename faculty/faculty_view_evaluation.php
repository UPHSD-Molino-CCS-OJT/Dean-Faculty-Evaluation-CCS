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

// Ensure faculty_action_plan column exists
$conn->query("ALTER TABLE evaluations ADD COLUMN IF NOT EXISTS faculty_action_plan TEXT DEFAULT NULL");

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

// Handle signature operations
if (isset($_POST['upload_signature'])) {
    // Upload signature to faculty profile (one-time)
    $target_dir = "../signatures/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $file_extension = strtolower(pathinfo($_FILES["signature_file"]["name"], PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["signature_file"]["tmp_name"]);
    
    if($check !== false && in_array($file_extension, ['png', 'jpg', 'jpeg'])) {
        if ($_FILES["signature_file"]["size"] < 2000000) {
            // Generate hash for deduplication
            $file_hash = md5_file($_FILES["signature_file"]["tmp_name"]);
            $hash_filename = "sig_" . $file_hash . "." . $file_extension;
            $target_file = $target_dir . $hash_filename;
            
            // Only save if doesn't exist
            if (!file_exists($target_file)) {
                move_uploaded_file($_FILES["signature_file"]["tmp_name"], $target_file);
            }
            
            // Save to faculty profile
            $sig_path = "signatures/" . $hash_filename;
            $sign_date = date('Y-m-d');
            $update_sql = "UPDATE faculty SET signature_path = '" . $conn->real_escape_string($sig_path) . "', signature_date = '" . $sign_date . "' WHERE name = '" . $conn->real_escape_string($faculty_name) . "'";
            $conn->query($update_sql);
            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
            exit();
        }
    }
}

if (isset($_POST['sign_evaluation'])) {
    // Apply faculty's saved signature to this evaluation
    $sig_sql = "SELECT signature_path FROM faculty WHERE name = '" . $conn->real_escape_string($faculty_name) . "'";
    $sig_result = $conn->query($sig_sql);
    if ($sig_result && $sig_result->num_rows > 0) {
        $sig_row = $sig_result->fetch_assoc();
        if ($sig_row['signature_path']) {
            $sign_date = date('Y-m-d');
            $update_sql = "UPDATE evaluations SET faculty_signature_path = '" . $conn->real_escape_string($sig_row['signature_path']) . "', faculty_signature_date = '" . $sign_date . "' WHERE id = '" . $id . "'";
            $conn->query($update_sql);
            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
            exit();
        }
    }
}

if (isset($_POST['remove_signature'])) {
    // Remove signature from faculty profile
    $sig_sql = "SELECT signature_path FROM faculty WHERE name = '" . $conn->real_escape_string($faculty_name) . "'";
    $sig_result = $conn->query($sig_sql);
    if ($sig_result && $sig_result->num_rows > 0) {
        $sig_row = $sig_result->fetch_assoc();
        if ($sig_row['signature_path']) {
            $file_path = $sig_row['signature_path'];
            
            // Clear from faculty profile
            $update_sql = "UPDATE faculty SET signature_path = NULL, signature_date = NULL WHERE name = '" . $conn->real_escape_string($faculty_name) . "'";
            $conn->query($update_sql);
            
            // Check if file is still used elsewhere before deleting
            $usage_check = $conn->query("SELECT COUNT(*) as count FROM evaluations WHERE 
                faculty_signature_path = '" . $conn->real_escape_string($file_path) . "' OR 
                dean_signature_path = '" . $conn->real_escape_string($file_path) . "'");
            $usage = $usage_check->fetch_assoc();
            
            if ($usage['count'] == 0) {
                $file_to_delete = '../' . $file_path;
                if (file_exists($file_to_delete)) {
                    unlink($file_to_delete);
                }
            }
        }
    }
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
    exit();
}

if (isset($_POST['unsign_evaluation'])) {
    // Remove signature from this evaluation only
    $update_sql = "UPDATE evaluations SET faculty_signature_path = NULL, faculty_signature_date = NULL WHERE id = '" . $id . "'";
    $conn->query($update_sql);
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
    exit();
}

// Fetch faculty's saved signature from profile
$faculty_stored_signature = null;
$faculty_stored_sig_date = null;
$fac_sig_sql = "SELECT signature_path, signature_date FROM faculty WHERE name = '" . $conn->real_escape_string($faculty_name) . "'";
$fac_sig_result = $conn->query($fac_sig_sql);
if ($fac_sig_result && $fac_sig_result->num_rows > 0) {
    $fac_sig_row = $fac_sig_result->fetch_assoc();
    $faculty_stored_signature = $fac_sig_row['signature_path'];
    $faculty_stored_sig_date = $fac_sig_row['signature_date'];
}

// Fetch signatures from THIS evaluation record
$signature_path = $data['faculty_signature_path'] ?? null;
$signature_date = $data['faculty_signature_date'] ?? null;
$dean_signature_path = $data['dean_signature_path'] ?? null;
$dean_signature_date = $data['dean_signature_date'] ?? null;

// Handle action plan submission
if (isset($_POST['save_action_plan'])) {
    $action_plan = $conn->real_escape_string($_POST['action_plan']);
    $conn->query("UPDATE evaluations SET faculty_action_plan = '$action_plan' WHERE id = '$id' AND faculty_name = '" . $conn->real_escape_string($faculty_name) . "'");
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
    exit();
}

// Fetch action plan
$faculty_action_plan = $data['faculty_action_plan'] ?? '';

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
        /* Screen styles */
        .print-page-header,
        .print-page-footer {
            display: none;
        }
        .print-spacer-table {
            width: 100%;
            border-collapse: collapse;
            border: none !important;
        }
        .print-spacer-table > thead > tr > td,
        .print-spacer-table > tfoot > tr > td,
        .print-spacer-table > tbody > tr > td {
            padding: 0;
            border: none !important;
        }
        .print-header-space,
        .print-footer-space {
            display: none;
        }

        @media print {
            /* Remove browser chrome (date, URL, page title) */
            @page { 
                size: auto;
                margin: 0;
            }
            body { 
                background: white;
                margin: 0;
                padding: 0;
            }

            /* Hide Web Elements */
            .no-print { display: none !important; }

            /* Hide inline header/footer (screen only) */
            .screen-only {
                display: none !important;
            }

            /* Fixed header - renders on every printed page */
            .print-page-header {
                display: block !important;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                padding: 15px 30px 5px;
                background: white;
                border-bottom: 2px solid #991b1b;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Fixed footer - renders on every printed page */
            .print-page-footer {
                display: block !important;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                padding: 5px 30px 15px;
                background: white;
                border-top: 2px solid #991b1b;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Spacer table ensures content doesn't overlap fixed header/footer */
            .print-spacer-table {
                width: 100%;
            }
            .print-header-space {
                display: block;
                height: 120px;
            }
            .print-footer-space {
                display: block;
                height: 90px;
            }

            .py-10 { 
                padding: 0 !important; 
            }
            .max-w-5xl {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 10px !important;
            }
            #printableArea {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
            }
            /* Prevent table rows from splitting across pages */
            tr {
                page-break-inside: avoid;
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
        <div class="max-w-5xl mx-auto mb-4 flex justify-between no-print">
            <a href="faculty_signature.php" class="bg-teal-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-teal-700 transition shadow-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
                Manage My Signature
            </a>
            <button onclick="window.print()" class="bg-red-800 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-900 transition shadow-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print Evaluation
            </button>
        </div>

        <!-- Fixed header/footer for print (repeats on every page) -->
        <div class="print-page-header">
            <img src="../header-image.png" alt="University Header" style="width:100%; height:auto; display:block;">
        </div>
        <div class="print-page-footer">
            <img src="../footer-image.png" alt="Evaluation Footer" style="width:100%; height:auto; display:block;">
        </div>

        <!-- Wrapper table: thead/tfoot spacers repeat on every page to prevent overlap -->
        <table class="print-spacer-table">
            <thead><tr><td><div class="print-header-space"></div></td></tr></thead>
            <tfoot><tr><td><div class="print-footer-space"></div></td></tr></tfoot>
            <tbody><tr><td>

        <div class="max-w-5xl mx-auto bg-white border border-gray-400 shadow-2xl p-6 md:p-10" id="printableArea">
            
            <div class="w-full border-b-2 border-red-800 pb-2 mb-6 screen-only">
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

            <div class="text-xs mb-4">
                <p class="font-bold underline mb-2 italic">Additional Comments/Remarks:</p>
                <div class="p-5 border border-dashed border-gray-400 italic bg-gray-50 min-h-[80px] leading-relaxed">
                    <?php echo !empty($data['additional_comments']) ? nl2br(htmlspecialchars($data['additional_comments'])) : 'No additional comments provided by the Dean.'; ?>
                </div>
            </div>

            <div class="text-xs mb-10 no-print">
                <p class="font-bold underline mb-2 italic">Faculty Action Plan / Response:</p>
                <?php if (!empty($faculty_action_plan)): ?>
                    <div class="p-5 border border-dashed border-teal-400 bg-teal-50 min-h-[80px] leading-relaxed">
                        <?php echo nl2br(htmlspecialchars($faculty_action_plan)); ?>
                    </div>
                <?php else: ?>
                    <div class="p-5 border border-dashed border-gray-300 bg-gray-50 min-h-[80px] leading-relaxed italic text-gray-400 print-only">
                        No action plan provided.
                    </div>
                <?php endif; ?>
                <form method="POST" class="no-print mt-3">
                    <textarea name="action_plan" rows="4" placeholder="Enter your action plan or response to the dean's remarks..." class="w-full border border-teal-300 rounded-lg p-3 text-xs focus:outline-none focus:ring-2 focus:ring-teal-400 resize-y"><?php echo htmlspecialchars($faculty_action_plan); ?></textarea>
                    <div class="flex justify-end mt-2">
                        <button type="submit" name="save_action_plan" class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-2 rounded-lg text-xs font-bold shadow transition">
                            Save Action Plan
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-16 flex justify-between items-end text-[11px] text-center px-10">
                <div class="w-64">
                    <?php if ($signature_path): ?>
                        <!-- Evaluation is signed -->
                        <img src="../<?php echo htmlspecialchars($signature_path); ?>" alt="Faculty Signature" class="h-16 mx-auto mb-2 border-b-2 border-transparent">
                        <div class="no-print mb-2">
                            <span class="text-xs text-green-700 font-semibold">✓ Signed</span>
                            <form method="POST" class="inline">
                                <button type="submit" name="unsign_evaluation" onclick="return confirm('Remove your signature from this evaluation?')" class="text-red-600 hover:text-red-800 text-[9px] underline ml-2">
                                    Unsign
                                </button>
                            </form>
                        </div>
                    <?php elseif ($faculty_stored_signature): ?>
                        <!-- Has stored signature but not signed this evaluation yet -->
                        <img src="../<?php echo htmlspecialchars($faculty_stored_signature); ?>" alt="Your Signature" class="h-16 mx-auto mb-2 border-b-2 border-transparent opacity-40">
                        <div class="no-print mb-2 space-y-1">
                            <form method="POST" class="inline-block">
                                <button type="submit" name="sign_evaluation" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded text-xs font-bold shadow-lg transition transform hover:scale-105">
                                    ✍️ Sign This Evaluation
                                </button>
                            </form>
                            <div>
                                <button type="button" onclick="document.getElementById('changeSignatureForm').classList.toggle('hidden')" class="text-gray-600 hover:text-gray-800 text-[9px] underline">
                                    Change My Signature
                                </button>
                            </div>
                        </div>
                        <form id="changeSignatureForm" method="POST" enctype="multipart/form-data" class="hidden no-print mb-2 p-3 bg-yellow-50 rounded border border-yellow-300">
                            <p class="text-[9px] text-gray-700 mb-2">Upload new signature (will update your profile)</p>
                            <input type="file" name="signature_file" accept="image/png,image/jpeg,image/jpg" required class="text-xs mb-2 w-full">
                            <button type="submit" name="upload_signature" class="bg-yellow-600 text-white px-3 py-1 rounded text-xs hover:bg-yellow-700 w-full">Update Signature</button>
                        </form>
                    <?php else: ?>
                        <!-- No signature uploaded to profile yet -->
                        <div class="h-16 flex items-center justify-center mb-2 border-2 border-dashed border-gray-300 rounded">
                            <span class="text-gray-400 text-xs italic">No signature</span>
                        </div>
                        <div class="no-print mb-2">
                            <button type="button" onclick="document.getElementById('firstSignatureForm').classList.toggle('hidden')" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1.5 rounded text-xs font-bold shadow">
                                📝 Upload My Signature
                            </button>
                        </div>
                        <form id="firstSignatureForm" method="POST" enctype="multipart/form-data" class="hidden no-print mb-2 p-3 bg-teal-50 rounded border border-teal-200">
                            <p class="text-[9px] text-gray-700 mb-2">Upload once, use for all evaluations</p>
                            <input type="file" name="signature_file" accept="image/png,image/jpeg,image/jpg" required class="text-xs mb-2 w-full">
                            <button type="submit" name="upload_signature" class="bg-teal-700 text-white px-3 py-1 rounded text-xs hover:bg-teal-800 w-full">Upload & Save</button>
                        </form>
                    <?php endif; ?>
                    <p class="border-b-2 border-black font-bold uppercase pb-1"><?php echo htmlspecialchars($data['faculty_name']); ?></p>
                    <p class="mt-1">Faculty Member's Signature</p>
                    <p class="text-[9px] text-gray-500 italic">Date Signed: <?php echo $signature_date ? date('m/d/Y', strtotime($signature_date)) : '________________'; ?></p>
                    <?php if ($faculty_stored_signature && !$signature_path): ?>
                        <p class="text-[8px] text-gray-400 italic mt-1 no-print">(Preview from your profile)</p>
                    <?php endif; ?>
                </div>
                <div class="w-64">
                    <?php if ($dean_signature_path && file_exists('../' . $dean_signature_path)): ?>
                        <img src="../<?php echo htmlspecialchars($dean_signature_path); ?>" alt="Dean Signature" class="h-16 mx-auto mb-2 border-b-2 border-transparent">
                    <?php else: ?>
                        <div class="h-16 flex items-center justify-center mb-2">
                            <span class="text-gray-400 text-xs italic">No dean signature</span>
                        </div>
                    <?php endif; ?>
                    <p class="border-b-2 border-black font-bold uppercase pb-1">MS. MARIBEL SANDAGON</p>
                    <p class="mt-1">Dean, College of Computer Studies</p>
                    <p class="text-[9px] text-gray-500 italic">Date Signed: <?php echo $dean_signature_date ? date('m/d/Y', strtotime($dean_signature_date)) : '________________'; ?></p>
                </div>
            </div>

            <div class="mt-12 screen-only">
                <img src="../footer-image.png" alt="Evaluation Footer" class="w-full h-auto border-t-2 border-red-800 pt-2">
            </div>

        </div>

            </td></tr></tbody>
        </table>
    </div>

</body>
</html>
