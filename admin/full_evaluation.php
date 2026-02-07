<?php 
include '../includes/header.php'; 

// 1. Validation & Fetching
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $conn->real_escape_string($_GET['id']);

// Fetch Main Data
$sql = "SELECT * FROM evaluations WHERE id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    die("Record not found.");
}
$data = $result->fetch_assoc();

// Fetch Specific Answers (Checklist)
$answers = [];
$sql_details = "SELECT question_code, rating FROM evaluation_details WHERE evaluation_id = '$id'";
$result_details = $conn->query($sql_details);
while($row = $result_details->fetch_assoc()) {
    $answers[$row['question_code']] = $row['rating'];
}
?>

<div class="py-10 px-4">
    <div class="max-w-5xl mx-auto mb-4 flex justify-end no-print">
        <button onclick="window.print()" class="bg-red-800 text-white px-6 py-2 rounded font-bold hover:bg-red-900 transition shadow-md flex items-center gap-2">
            <span>🖨️</span> Print Full Record
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
                <p class="border-b-2 border-black font-bold uppercase pb-1"><?php echo htmlspecialchars($data['faculty_name']); ?></p>
                <p class="mt-1">Faculty Member's Signature</p>
                <p class="text-[9px] text-gray-500 italic">Date Signed: ________________</p>
            </div>
            <div class="w-64">
                <p class="border-b-2 border-black font-bold uppercase pb-1">MS. MARIBEL SANDAGON</p>
                <p class="mt-1">Dean, College of Computer Studies</p>
                <p class="text-[9px] text-gray-500 italic">Date Signed: <?php echo date('m/d/Y'); ?></p>
            </div>
        </div>
        <div class="mt-12 print-footer-container">
            <img src="../footer-image.png" alt="Evaluation Footer" class="w-full h-auto border-t-2 border-red-800 pt-2">
            
            <div class="flex justify-between text-[9px] text-gray-400 mt-1 uppercase tracking-widest px-1">
            </div>
        </div>

    </div>
</div>

<style>
/* Exact Print Styles from view_evaluation.php */
#printableArea {
    page-break-inside: avoid;
}

@media print {
    @page { 
        margin: 0; 
        size: auto;
    }
    
    body { 
        margin: 0;
        padding: 0.5in; 
        background: white !important; 
    }

    /* Hide Web Elements */
    .no-print, nav, footer, header, button { 
        display: none !important; 
    }

    /* Reset Container Widths */
    .py-10 { padding: 0 !important; }
    .max-w-5xl { 
        max-width: 100% !important; 
        width: 100% !important;
        border: none !important; 
        margin: 0 !important;
        padding: 0 !important;
    }
    .shadow-2xl { box-shadow: none !important; }
    
    #printableArea {
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
    .bg-red-100 { background-color: #fee2e2 !important; -webkit-print-color-adjust: exact; } /* New for table highlight */
    .bg-gray-800 { background-color: #1f2937 !important; -webkit-print-color-adjust: exact; }
    .bg-gray-200 { background-color: #e5e7eb !important; -webkit-print-color-adjust: exact; }
    .text-red-900 { color: #7f1d1d !important; -webkit-print-color-adjust: exact; }
    .text-red-800 { color: #991b1b !important; -webkit-print-color-adjust: exact; }
}
</style>