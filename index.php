<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database Connection
require_once __DIR__ . '/includes/config.php';

// Handle dean signature upload with hash-based deduplication
if (isset($_POST['upload_dean_signature']) && isset($_SESSION['admin_logged_in'])) {
    $target_dir = "signatures/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $file_extension = strtolower(pathinfo($_FILES["dean_signature_file"]["name"], PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["dean_signature_file"]["tmp_name"]);
    
    if($check !== false && in_array($file_extension, ['png', 'jpg', 'jpeg'])) {
        if ($_FILES["dean_signature_file"]["size"] < 2000000) {
            // Generate hash of file content to detect duplicates
            $file_hash = md5_file($_FILES["dean_signature_file"]["tmp_name"]);
            $hash_filename = "sig_" . $file_hash . "." . $file_extension;
            $target_file = $target_dir . $hash_filename;
            
            // Only move file if it doesn't already exist
            if (!file_exists($target_file)) {
                move_uploaded_file($_FILES["dean_signature_file"]["tmp_name"], $target_file);
            }
            
            $sig_path = "signatures/" . $hash_filename;
            $sign_date = date('Y-m-d');
            
            $update1 = "UPDATE settings SET setting_value = '" . $conn->real_escape_string($sig_path) . "' WHERE setting_key = 'dean_signature_path'";
            $update2 = "UPDATE settings SET setting_value = '" . $sign_date . "' WHERE setting_key = 'dean_signature_date'";
            
            $conn->query($update1);
            $conn->query($update2);
            
            header("Location: index.php");
            exit();
        }
    }
}

// Handle dean signature removal
if (isset($_POST['remove_dean_signature']) && isset($_SESSION['admin_logged_in'])) {
    $sig_sql = "SELECT setting_value FROM settings WHERE setting_key = 'dean_signature_path'";
    $sig_result = $conn->query($sig_sql);
    if ($sig_result && $sig_result->num_rows > 0) {
        $sig_row = $sig_result->fetch_assoc();
        if ($sig_row['setting_value']) {
            $file_to_delete = $sig_row['setting_value'];
            
            // Check if file is still used by any evaluation before deleting
            $usage_check = $conn->query("SELECT COUNT(*) as count FROM evaluations WHERE dean_signature_path = '" . $conn->real_escape_string($file_to_delete) . "'");
            $usage = $usage_check->fetch_assoc();
            
            // Only delete physical file if not used anywhere
            if ($usage['count'] == 0 && file_exists($file_to_delete)) {
                unlink($file_to_delete);
            }
        }
    }
    $conn->query("UPDATE settings SET setting_value = NULL WHERE setting_key = 'dean_signature_path'");
    $conn->query("UPDATE settings SET setting_value = NULL WHERE setting_key = 'dean_signature_date'");
    header("Location: index.php");
    exit();
}

// Fetch dean signature
$dean_signature_path = null;
$dean_signature_date = null;
$sig_sql = "SELECT setting_key, setting_value FROM settings WHERE setting_key IN ('dean_signature_path', 'dean_signature_date')";
$sig_result = $conn->query($sig_sql);
if ($sig_result) {
    while($row = $sig_result->fetch_assoc()) {
        if ($row['setting_key'] == 'dean_signature_path') {
            $dean_signature_path = $row['setting_value'];
        }
        if ($row['setting_key'] == 'dean_signature_date') {
            $dean_signature_date = $row['setting_value'];
        }
    }
}

include 'includes/header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dean's Faculty Evaluation - UPHSD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .table-input:checked { accent-color: #991b1b; }
        .summary-row { background-color: #f3f4f6; font-weight: bold; }
        .numeric-cell { text-align: center; border: 1px solid #e5e7eb; transition: all 0.2s ease; }
        .numeric-cell:hover { background-color: #fef2f2; }
        input[type="text"], input[type="number"] { 
            border-bottom: 2px solid #e5e7eb; 
            outline: none; 
            background: transparent;
            transition: all 0.3s ease;
            padding: 4px 2px;
        }
        input[type="text"]:focus, input[type="number"]:focus {
            border-bottom-color: #3b82f6;
            background-color: #eff6ff;
        }
        
        /* Enhanced Select Styling */
        select {
            transition: all 0.3s ease;
        }
        select:focus {
            border-bottom-color: #3b82f6;
            background-color: #eff6ff;
        }
        
        /* Collapsible Styling */
        .section-header { 
            cursor: pointer; 
            user-select: none;
            transition: all 0.3s ease;
        }
        .section-header:hover { 
            background-color: #fee2e2;
            transform: translateX(4px);
        }
        .hidden-row { display: none; }

        /* Progress Bar Styling */
        .sticky-progress { 
            position: sticky; 
            top: 72px; 
            z-index: 40; 
            background: linear-gradient(to bottom, white 0%, white 85%, transparent 100%);
            padding: 16px 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        
        /* Radio Button Styling */
        .table-input {
            cursor: pointer;
            width: 18px;
            height: 18px;
            transition: transform 0.2s ease;
        }
        .table-input:hover {
            transform: scale(1.2);
        }
        
        /* Card Animations */
        .eval-card {
            animation: fadeInUp 0.5s ease-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Info Box Pulse */
        .info-box {
            animation: pulse-subtle 2s ease-in-out infinite;
        }
        @keyframes pulse-subtle {
            0%, 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.1); }
            50% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
        }
        
        /* Submit Button Hover Effect */
        .btn-submit {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(220, 38, 38, 0.3);
        }
    </style>
</head>
<body class="bg-gray-100 p-4 md:p-8">

<div class="sticky-progress mb-6">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex justify-between items-center mb-2">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm font-bold uppercase text-red-800 tracking-wide">Completion Progress</span>
            </div>
            <span id="progress-text" class="text-sm font-bold text-red-800 bg-red-50 px-3 py-1 rounded-full">0%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3 shadow-inner">
            <div id="progress-fill" class="bg-gradient-to-r from-red-600 to-red-800 h-3 rounded-full transition-all duration-500 ease-out shadow-lg" style="width: 0%"></div>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto bg-white border-2 border-gray-200 shadow-2xl rounded-2xl overflow-hidden p-4 md:p-10 eval-card">
    
    <div class="w-full border-b-4 border-gradient-to-r from-blue-600 to-purple-600 pb-3 mb-6">
        <img src="header-image.png" alt="University Header" class="w-full h-auto rounded-t-lg">
    </div>

    <h2 class="text-center text-2xl font-black mb-8 uppercase tracking-wider bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Dean's Faculty Evaluation</h2>

    <form action="includes/submit.php" method="POST" id="evalForm">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs mb-6">
            <div class="space-y-2">
                <p><strong>College:</strong> CCS</p>
                <p><strong>Dean/Head:</strong> MS. MARIBEL SANDAGON</p>
                <p><strong>Name of Faculty:</strong> 
                    <select name="faculty_name" id="faculty_select" class="font-bold border-b border-black outline-none bg-transparent cursor-pointer" onchange="updateSignature(this.value)" required>
                        <option value="" disabled selected>Select Faculty</option>
                        
                        <?php 
                        // Fetch only active faculty members from the new table
                        $faculty_query = "SELECT name FROM faculty WHERE status = 'active' ORDER BY name ASC";
                        $faculty_result = $conn->query($faculty_query);

                        if ($faculty_result && $faculty_result->num_rows > 0) {
                            while($row = $faculty_result->fetch_assoc()) {
                                $f_name = htmlspecialchars($row['name']);
                                echo "<option value=\"$f_name\">$f_name</option>";
                            }
                        } else {
                            echo "<option value=\"\" disabled>No faculty found. Please add one in Dashboard.</option>";
                        }
                        ?>
                    </select>
                </p>
            </div>
                <div class="space-y-2">
                    <p><strong>Semester:</strong> 
                        <select name="semester" class="font-bold border-b border-black outline-none bg-transparent cursor-pointer">
                            <option value="1ST">1st Semester</option>
                            <option value="2ND">2nd Semester</option>
                            <option value="SUMMER">Summer</option>
                        </select>
                    </p>
                    <p><strong>School Year:</strong> 
                        <input type="text" name="school_year" placeholder="2025-2026" class="w-24 font-bold border-b border-black outline-none bg-transparent">
                    </p>
                    <p><strong>Total Units Load:</strong> 
                        <input type="number" name="total_units" class="w-16 font-bold border-b border-black outline-none bg-transparent">
                    </p>
                </div>
            <div class="border-3 border-blue-500 p-4 bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl shadow-lg info-box">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="text-xs font-bold text-blue-900 uppercase">Evaluation Score</span>
                </div>
                <div class="flex justify-between font-bold text-gray-700 mb-1"><span>Total Points:</span> <span id="grand-total-points" class="text-blue-600">0</span></div>
                <div class="flex justify-between font-bold text-lg mb-2"><span class="text-gray-700">Rating:</span> <span id="grand-overall-rating" class="text-blue-700">0.00</span></div>
                <div class="flex justify-between text-xs italic text-gray-600"><span>Rank:</span> <input type="text" class="w-12 border-none bg-white/50 rounded px-1"></div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-5 border-2 border-blue-200 text-sm mb-6 rounded-xl shadow-md">
            <div class="flex items-start gap-3 mb-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="mb-2 font-bold text-gray-800">To the Dean,</p>
                    <p class="text-gray-700">In order to maintain quality teaching and instruction, please select the number that you believe best describes the instructor/professor in what is asked in each item.</p>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-5 gap-2 font-bold text-center text-xs">
                <div class="bg-green-100 text-green-800 py-2 px-1 rounded-lg border border-green-300">5 - Outstanding</div>
                <div class="bg-blue-100 text-blue-800 py-2 px-1 rounded-lg border border-blue-300">4 - Very Satisfactory</div>
                <div class="bg-yellow-100 text-yellow-800 py-2 px-1 rounded-lg border border-yellow-300">3 - Satisfactory</div>
                <div class="bg-orange-100 text-orange-800 py-2 px-1 rounded-lg border border-orange-300">2 - Fair</div>
                <div class="bg-red-100 text-red-800 py-2 px-1 rounded-lg border border-red-300">1 - Needs Improvement</div>
            </div>
        </div>

        <div class="mb-6">
            <table class="w-full text-xs border border-black">
                <tr class="bg-gray-100 font-bold">
                    <td class="border border-black p-1">Subject/s Handled</td>
                    <td class="border border-black p-1 w-24">Days</td>
                    <td class="border border-black p-1 w-24">Time</td>
                </tr>
                <tr>
                    <td class="border border-black p-1"><input type="text" name="subj1" class="w-full border-none"></td>
                    <td class="border border-black p-1"><input type="text" name="days1" class="w-full border-none"></td>
                    <td class="border border-black p-1"><input type="text" name="time1" class="w-full border-none"></td>
                </tr>
            </table>
        </div>

        <table class="w-full border-collapse border border-black text-s">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="p-2 text-left w-2/3">THE FACULTY MEMBER:</th>
                    <th class="numeric-cell w-8 border-white">5</th>
                    <th class="numeric-cell w-8 border-white">4</th>
                    <th class="numeric-cell w-8 border-white">3</th>
                    <th class="numeric-cell w-8 border-white">2</th>
                    <th class="numeric-cell w-8 border-white">1</th>
                </tr>
            </thead>

            <?php
            $sections = [
                'sec1' => [
                    'title' => 'I. PERSONAL AND SOCIAL TRAITS (10%)',
                    'weight' => 0.10,
                    'items' => [
                        "Is innovative, enthusiastic, approachable and helpful.",
                        "Dresses appropriately for classroom instructions and projects a tone and manner that is pleasant and encouraging.",
                        "Uses courteous and appropriate verbal expressions and language while teaching."
                    ]
                ],
                'sec2' => [
                    'title' => 'II. INSTRUCTIONAL COMPETENCE (60%)',
                    'weight' => 0.60,
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
                    'title' => 'III. CLASSROOM MANAGEMENT (10%)',
                    'weight' => 0.10,
                    'items' => [
                        "Starts and ends the class with a prayer.",
                        "Maintains order and discipline throughout the period for learning to take place.",
                        "Collects test papers, homeworks, projects, and returns them within a reasonable period of time.",
                        "Calls his students by name and manifests good rapport with them.",
                        "Keeps an accurate record of attendance, punctuality, quizzes, tests and other measures to assess student interest and performance."
                    ]
                ],
                'sec4' => [
                    'title' => 'IV. CONDUCT TOWARDS LEGITIMATE SCHOOL AUTHORITY (10%)',
                    'weight' => 0.10,
                    'items' => [
                        "Renders due respect to immediate superior and College officials.",
                        "Manifests loyalty to his institution.",
                        "Fulfills properly his duties and obligations in the college/department.",
                        "Attends official functions and college-sponsored activities (Graduation, faculty meetings, opening of school year and academic functions)."
                    ]
                ],
                'sec5' => [
                    'title' => 'V. PROFESSIONAL ADVANCEMENT (10%)',
                    'weight' => 0.10,
                    'items' => [
                        "Seeks professional advancement through membership in organization and attendance/participation in seminar/workshops in line with the Faculty Development Program of the University.",
                        "Participates actively in research undertakings and in the presentation, dissemination and publication of research outputs."
                    ]
                ]
            ];

            $isFirst = true;
            foreach ($sections as $id => $data) {
                echo "<tbody class='section-block' data-weight='{$data['weight']}' data-count='".count($data['items'])."'>";
                $arrow = $isFirst ? '▼' : '▶';
                echo "<tr class='bg-red-50 font-bold section-header' onclick='toggleSection(this)'><td colspan='6' class='border border-black p-2'><span class='mr-2'>$arrow</span>{$data['title']}</td></tr>";
                
                // Hide row if not the first section
                $hideClass = $isFirst ? '' : 'hidden-row';
                
                foreach ($data['items'] as $index => $text) {
                    $qNum = $index + 1;
                    echo "<tr class='hover:bg-gray-50 $hideClass'>
                            <td class='border border-black p-2'>$qNum. $text</td>";
                    for ($v = 5; $v >= 1; $v--) {
                        echo "<td class='numeric-cell'><input type='radio' name='{$id}_q{$qNum}' value='$v' class='calc-trigger table-input' required></td>";
                    }
                    echo "</tr>";
                }
                echo "<tr class='summary-row $hideClass'><td class='text-right px-2 border border-black'>Total Points:</td><td colspan='5' class='numeric-cell section-total'>0</td></tr>";
                echo "<tr class='summary-row $hideClass'><td class='text-right px-2 border border-black'>Average Points:</td><td colspan='5' class='numeric-cell section-avg'>0.00</td></tr>";
                echo "<tr class='summary-row $hideClass'><td class='text-right px-2 border border-black italic'>Weighted Average:</td><td colspan='5' class='numeric-cell section-weighted'>0.00</td></tr>";
                echo "</tbody>";
                $isFirst = false;
            }
            ?>
        </table>

        <div class="mt-8 text-sm border-2 border-blue-200 p-6 space-y-5 rounded-xl bg-gradient-to-br from-blue-50/50 to-purple-50/50 shadow-md">
            <div class="flex items-center gap-2 mb-3">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <p class="font-bold text-gray-800">Additional Questions</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-4 rounded-lg border-2 border-gray-200 shadow-sm">
                    <span class="block mb-3 text-gray-700 font-medium">Has there been any official complaint against the faculty member in previous school year?</span>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer hover:text-blue-600 transition">
                            <input type="radio" name="complaint" value="yes" class="w-4 h-4 text-blue-600">
                            <span class="font-semibold">Yes</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer hover:text-blue-600 transition">
                            <input type="radio" name="complaint" value="no" class="w-4 h-4 text-blue-600">
                            <span class="font-semibold">No</span>
                        </label>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg border-2 border-gray-200 shadow-sm">
                    <span class="block mb-3 text-gray-700 font-medium">Has the faculty member demonstrated exceptional performance during the previous year?</span>
                    <div class="flex gap-4 mb-2">
                        <label class="flex items-center gap-2 cursor-pointer hover:text-blue-600 transition">
                            <input type="radio" name="exceptional" value="yes" class="w-4 h-4 text-blue-600">
                            <span class="font-semibold">Yes</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer hover:text-blue-600 transition">
                            <input type="radio" name="exceptional" value="no" class="w-4 h-4 text-blue-600">
                            <span class="font-semibold">No</span>
                        </label>
                    </div>
                    <input type="text" placeholder="Please specify if yes..." class="mt-2 w-full text-sm border-2 border-gray-200 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none transition">
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg border-2 border-gray-200 shadow-sm">
                <label class="font-bold text-gray-800 mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    Additional Comments:
                </label>
                <textarea name="comments" placeholder="Enter any additional feedback or observations..." class="w-full border-2 border-gray-200 mt-2 p-3 h-24 outline-none focus:border-blue-500 rounded-lg resize-none transition"></textarea>
            </div>
        </div>

        <button type="submit" class="btn-submit mt-10 w-full text-white font-bold py-5 rounded-xl uppercase tracking-widest text-lg shadow-2xl flex items-center justify-center gap-3 group">
            <svg class="w-6 h-6 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Submit Official Evaluation
        </button>
    </form>

    <div class="mt-12 flex justify-between items-end text-sm text-center px-10 py-6 bg-gray-50 rounded-xl border-2 border-gray-200">
        <div class="w-64">
            <div class="mb-2 flex justify-center">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <p id="sig_name" class="border-b-2 border-gray-800 font-bold pb-1 uppercase text-blue-900">SELECT FACULTY</p>
            <p class="mt-2 text-gray-600 font-medium">Faculty's Signature Over Printed Name</p>
            <p class="mt-3 text-xs text-gray-500">Date: <span class="border-b border-gray-400 inline-block w-32">&nbsp;</span></p>
        </div>

        <div class="w-64">
            <div class="mb-2 flex justify-center">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <?php if (isset($_SESSION['admin_logged_in'])): ?>
                <?php if ($dean_signature_path && file_exists($dean_signature_path)): ?>
                    <img src="<?php echo htmlspecialchars($dean_signature_path); ?>" alt="Dean Signature" class="h-16 mx-auto mb-2 border-b-2 border-transparent">
                    <div class="mt-1">
                        <span class="text-xs text-green-700 font-semibold">✓ Active Signature</span>
                    </div>
                    <button type="button" onclick="document.getElementById('changeDeanSigForm').classList.toggle('hidden')" class="text-gray-600 hover:text-gray-800 text-[9px] underline mt-1">
                        Change Signature
                    </button>
                    <form id="changeDeanSigForm" method="POST" enctype="multipart/form-data" class="hidden mt-2 p-3 bg-yellow-50 rounded border border-yellow-300">
                        <p class="text-[9px] text-gray-700 mb-2">Upload new dean signature</p>
                        <input type="file" name="dean_signature_file" accept="image/png,image/jpeg,image/jpg" required class="text-xs mb-2 w-full">
                        <button type="submit" name="upload_dean_signature" class="bg-yellow-600 text-white px-3 py-1 rounded text-xs hover:bg-yellow-700 w-full">Update</button>
                    </form>
                <?php else: ?>
                    <div class="h-16 flex items-center justify-center mb-2 border-2 border-dashed border-gray-300 rounded">
                        <span class="text-gray-400 text-xs italic">No signature</span>
                    </div>
                    <button type="button" onclick="document.getElementById('deanSigUploadForm').classList.toggle('hidden')" class="bg-purple-600 hover:bg-purple-700 text-white text-xs px-3 py-1.5 rounded font-bold shadow">
                        📝 Upload Dean Signature
                    </button>
                    <form id="deanSigUploadForm" method="POST" enctype="multipart/form-data" class="hidden mt-2 p-3 bg-purple-50 rounded border border-purple-200">
                        <p class="text-[9px] text-gray-700 mb-2">Upload once, applies to all new evaluations</p>
                        <input type="file" name="dean_signature_file" accept="image/png,image/jpeg,image/jpg" required class="text-xs mb-2 w-full">
                        <button type="submit" name="upload_dean_signature" class="bg-purple-700 text-white px-3 py-1 rounded text-xs hover:bg-purple-800 w-full">Upload & Save</button>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
            <p class="border-b-2 border-gray-800 font-bold pb-1 uppercase text-purple-900">MS. MARIBEL SANDAGON</p>
            <p class="mt-2 text-gray-600 font-medium">Dean's Signature</p>
            <p class="mt-3 text-xs text-gray-500">Date: <?php echo $dean_signature_date ? date('m/d/Y', strtotime($dean_signature_date)) : '<span class="border-b border-gray-400 inline-block w-32">&nbsp;</span>'; ?></p>
            <?php if (isset($_SESSION['admin_logged_in']) && $dean_signature_path): ?>
                <p class="text-[8px] text-gray-400 italic mt-1">(Will be applied to this evaluation)</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<script>
    // Manual Toggle Function
    function toggleSection(headerRow) {
        const tbody = headerRow.parentElement;
        const rows = Array.from(tbody.querySelectorAll('tr')).slice(1);
        const arrow = headerRow.querySelector('span');
        const isHidden = rows[0].classList.contains('hidden-row');
        
        rows.forEach(row => row.classList.toggle('hidden-row'));
        arrow.textContent = isHidden ? '▼' : '▶';
    }

    // Progress Bar Function
    function updateProgressBar() {
        const totalQuestions = document.querySelectorAll('.section-block .table-input[value="5"]').length; // Get total unique questions by checking one radio value per question
        const answeredQuestions = document.querySelectorAll('.table-input:checked').length;
        const percentage = Math.round((answeredQuestions / totalQuestions) * 100);
        
        document.getElementById('progress-fill').style.width = percentage + '%';
        document.getElementById('progress-text').innerText = percentage + '%';
    }

    // Auto-advance Logic
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('table-input')) {
            updateProgressBar(); // Progress bar update

            const currentTbody = e.target.closest('tbody');
            const totalQuestions = parseInt(currentTbody.getAttribute('data-count'));
            
            // Count how many questions are answered in THIS section
            const answeredCount = currentTbody.querySelectorAll('input[type="radio"]:checked').length;

            // If section is finished
            if (answeredCount === totalQuestions) {
                setTimeout(() => {
                    // 1. Close current section
                    const currentHeader = currentTbody.querySelector('.section-header');
                    const currentRows = Array.from(currentTbody.querySelectorAll('tr')).slice(1);
                    if (!currentRows[0].classList.contains('hidden-row')) {
                        toggleSection(currentHeader);
                    }

                    // 2. Open next section
                    const nextTbody = currentTbody.nextElementSibling;
                    if (nextTbody && nextTbody.classList.contains('section-block')) {
                        const nextHeader = nextTbody.querySelector('.section-header');
                        const nextRows = Array.from(nextTbody.querySelectorAll('tr')).slice(1);
                        if (nextRows[0].classList.contains('hidden-row')) {
                            toggleSection(nextHeader);
                            // Scroll smoothly to next section
                            nextHeader.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }
                }, 300); // Slight delay for better UX
            }
        }
    });

    function updateSignature(name) {
        document.getElementById('sig_name').innerText = name;
    }
</script>
<script src="assets/js/script.js"></script>
</body>
</html>