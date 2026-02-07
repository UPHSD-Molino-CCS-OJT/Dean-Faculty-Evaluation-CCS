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
            .no-print { display: none; }
            body { background: white; }
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
            <button onclick="window.print()" class="bg-teal-700 text-white px-6 py-2 rounded-lg font-bold hover:bg-teal-800 transition shadow-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print Evaluation
            </button>
        </div>

        <div class="max-w-5xl mx-auto bg-white border border-gray-400 shadow-2xl p-6 md:p-10" id="printableArea">
            
            <div class="w-full border-b-2 border-teal-800 pb-2 mb-6">
                <img src="header-image.png" alt="University Header" class="w-full h-auto">
            </div>

            <h2 class="text-center text-xl font-black mb-8 uppercase tracking-widest text-gray-800">DEAN'S FACULTY EVALUATION</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs mb-8 border-b pb-6">
                <div class="space-y-3">
                    <p><strong>Faculty Name:</strong> <span class="ml-2 border-b border-gray-400 font-bold uppercase text-teal-900"><?php echo htmlspecialchars($data['faculty_name']); ?></span></p>
                    <p><strong>College Dean:</strong> <span class="ml-2 border-b border-gray-400 font-bold">MS. MARIBEL SANDAGON</span></p>
                    <p><strong>College:</strong> <span class="ml-2 border-b border-gray-400 font-bold">CCS</span></p>
                </div>
                <div class="space-y-3">
                    <p><strong>Semester:</strong> <span class="ml-2 border-b border-gray-400 font-bold"><?php echo $data['semester'] ?? 'N/A'; ?></span></p>
                    <p><strong>School Year:</strong> <span class="ml-2 border-b border-gray-400 font-bold"><?php echo $data['school_year'] ?? 'N/A'; ?></span></p>
                    <p><strong>Total Units:</strong> <span class="ml-2 border-b border-gray-400 font-bold"><?php echo $data['total_units'] ?? '0'; ?></span></p>
                </div>
                <div class="bg-teal-50 p-4 border-2 border-teal-800 rounded-lg shadow-inner">
                    <div class="flex justify-between font-bold text-gray-700"><span>TOTAL POINTS:</span> <span><?php echo $data['total_points']; ?></span></div>
                    <div class="flex justify-between font-bold text-teal-800 text-sm mt-2"><span>OVERALL RATING:</span> <span><?php echo number_format($data['overall_rating'], 2); ?></span></div>
                    <div class="flex justify-between text-[10px] mt-2 italic text-gray-500 uppercase tracking-tighter"><span>Date Submitted:</span> <span><?php echo date('M d, Y', strtotime($data['date_submitted'])); ?></span></div>
                </div>
            </div>

            <table class="w-full border-collapse border border-black text-xs mb-8">
                <thead>
                    <tr class="bg-gray-800 text-white font-bold">
                        <th class="p-3 border border-black text-left">EVALUATION CRITERIA</th>
                        <th class="p-3 border border-black text-center w-28">RAW AVERAGE</th>
                        <th class="p-3 border border-black text-center w-28">WEIGHTED SCORE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2 border border-black">I. Personal and Social Traits (10%)</td>
                        <td class="p-2 border border-black text-center"><?php echo number_format($data['sec1_avg'], 2); ?></td>
                        <td class="p-2 border border-black text-center font-semibold"><?php echo number_format($data['sec1_avg'] * 0.10, 3); ?></td>
                    </tr>
                    <tr>
                        <td class="p-2 border border-black">II. Instructional Competence (60%)</td>
                        <td class="p-2 border border-black text-center"><?php echo number_format($data['sec2_avg'], 2); ?></td>
                        <td class="p-2 border border-black text-center font-semibold"><?php echo number_format($data['sec2_avg'] * 0.60, 3); ?></td>
                    </tr>
                    <tr>
                        <td class="p-2 border border-black">III. Classroom Management (10%)</td>
                        <td class="p-2 border border-black text-center"><?php echo number_format($data['sec3_avg'], 2); ?></td>
                        <td class="p-2 border border-black text-center font-semibold"><?php echo number_format($data['sec3_avg'] * 0.10, 3); ?></td>
                    </tr>
                    <tr>
                        <td class="p-2 border border-black">IV. Conduct Towards School Authority (10%)</td>
                        <td class="p-2 border border-black text-center"><?php echo number_format($data['sec4_avg'], 2); ?></td>
                        <td class="p-2 border border-black text-center font-semibold"><?php echo number_format($data['sec4_avg'] * 0.10, 3); ?></td>
                    </tr>
                    <tr>
                        <td class="p-2 border border-black">V. Professional Advancement (10%)</td>
                        <td class="p-2 border border-black text-center"><?php echo number_format($data['sec5_avg'], 2); ?></td>
                        <td class="p-2 border border-black text-center font-semibold"><?php echo number_format($data['sec5_avg'] * 0.10, 3); ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-gray-100 font-bold">
                        <td class="p-3 border border-black text-right" colspan="2">FINAL OVERALL SCORE:</td>
                        <td class="p-3 border border-black text-center text-teal-800 text-sm"><?php echo number_format($data['overall_rating'], 2); ?></td>
                    </tr>
                </tfoot>
            </table>

            <?php if($data['subject_handled']): ?>
            <div class="mb-6 p-4 border border-gray-300 rounded bg-gray-50">
                <h3 class="font-bold text-sm mb-2 text-gray-800">SUBJECTS HANDLED:</h3>
                <p class="text-xs text-gray-700"><?php echo htmlspecialchars($data['subject_handled']); ?></p>
            </div>
            <?php endif; ?>

            <div class="grid grid-cols-2 gap-4 text-[10px] mb-8">
                <div class="p-2 border border-gray-200 rounded">
                    <span class="font-bold">Official Complaint?</span> <?php echo strtoupper($data['official_complaint'] ?? 'No'); ?>
                </div>
                <div class="p-2 border border-gray-200 rounded">
                    <span class="font-bold">Exceptional Performance?</span> <?php echo strtoupper($data['exceptional_performance'] ?? 'No'); ?>
                </div>
            </div>

            <?php if($data['additional_comments']): ?>
            <div class="p-4 border border-gray-300 rounded bg-yellow-50 mb-6">
                <h3 class="font-bold text-sm mb-2 text-gray-800">ADDITIONAL COMMENTS:</h3>
                <p class="text-xs text-gray-700 italic"><?php echo nl2br(htmlspecialchars($data['additional_comments'])); ?></p>
            </div>
            <?php endif; ?>

            <div class="border-t-2 border-gray-300 pt-6 mt-8">
                <div class="grid grid-cols-2 gap-8 text-[10px]">
                    <div class="text-center">
                        <div class="border-b-2 border-black inline-block w-64 mb-1"></div>
                        <p class="font-bold uppercase">Faculty Signature</p>
                    </div>
                    <div class="text-center">
                        <div class="border-b-2 border-black inline-block w-64 mb-1"></div>
                        <p class="font-bold uppercase">Dean's Signature</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
