<?php 
include '../includes/header.php'; 

// Get ID from URL
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $conn->real_escape_string($_GET['id']);
$sql = "SELECT * FROM evaluations WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Record not found.";
    exit();
}

$data = $result->fetch_assoc();

// Fetch specific answers and build per-category score metrics
$answers = [];
$sql_details = "SELECT question_code, rating FROM evaluation_details WHERE evaluation_id = '$id'";
$result_details = $conn->query($sql_details);
if ($result_details) {
    while ($row = $result_details->fetch_assoc()) {
        $answers[$row['question_code']] = (int) $row['rating'];
    }
}

$section_definitions = [
    'sec1' => ['title' => 'I. Personal and Social Traits (10%)', 'weight' => 0.10, 'count' => 3],
    'sec2' => ['title' => 'II. Instructional Competence (60%)', 'weight' => 0.60, 'count' => 11],
    'sec3' => ['title' => 'III. Classroom Management (10%)', 'weight' => 0.10, 'count' => 5],
    'sec4' => ['title' => 'IV. Conduct Towards School Authority (10%)', 'weight' => 0.10, 'count' => 4],
    'sec5' => ['title' => 'V. Professional Advancement (10%)', 'weight' => 0.10, 'count' => 2],
];

$section_metrics = [];
foreach ($section_definitions as $section_code => $section_def) {
    $section_total = 0;
    for ($qNum = 1; $qNum <= $section_def['count']; $qNum++) {
        $key = "{$section_code}_q{$qNum}";
        $section_total += $answers[$key] ?? 0;
    }

    $section_avg = $section_def['count'] > 0 ? $section_total / $section_def['count'] : 0;
    $section_metrics[] = [
        'title' => $section_def['title'],
        'total' => $section_total,
        'avg' => $section_avg,
        'weighted' => $section_avg * $section_def['weight']
    ];
}

// Fetch signatures from the evaluation record itself
$dean_signature_path = $data['dean_signature_path'] ?? null;
$dean_signature_date = $data['dean_signature_date'] ?? null;
$faculty_signature_path = $data['faculty_signature_path'] ?? null;
$faculty_signature_date = $data['faculty_signature_date'] ?? null;
?>

<div class="py-6 sm:py-10 px-2 sm:px-4">
    <div class="max-w-5xl mx-auto mb-4 flex justify-end no-print">
        <button onclick="window.print()" class="bg-red-800 text-white px-4 sm:px-6 py-2 rounded font-bold hover:bg-red-900 transition shadow-md flex items-center gap-2 text-sm sm:text-base">
            <span>🖨️</span> Print Official Record
        </button>
    </div>

    <div class="max-w-5xl mx-auto bg-white border border-gray-400 shadow-2xl p-4 sm:p-6 md:p-10" id="printableArea">
        
        <div class="w-full border-b-2 border-red-800 pb-2 mb-6">
            <img src="../header-image.png" alt="University Header" class="w-full h-auto">
        </div>

        <h2 class="text-center text-xl font-black mb-8 uppercase tracking-widest text-gray-800">DEAN'S FACULTY EVALUATION</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 text-xs mb-8 border-b pb-6">
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

        <div class="overflow-x-auto -mx-4 sm:mx-0">
        <table class="w-full border-collapse border border-black text-xs mb-8 min-w-[480px]">
            <thead>
                <tr class="bg-gray-800 text-white font-bold">
                    <th class="p-3 border border-black text-left">EVALUATION CRITERIA</th>
                    <th class="p-2 border border-black text-center w-20 text-[10px] leading-tight">TOTAL POINTS</th>
                    <th class="p-2 border border-black text-center w-20 text-[10px] leading-tight">AVERAGE POINTS</th>
                    <th class="p-2 border border-black text-center w-20 text-[10px] leading-tight">WEIGHTED AVERAGE</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($section_metrics as $section): ?>
                    <tr>
                        <td class="p-2 border border-black"><?php echo htmlspecialchars($section['title']); ?></td>
                        <td class="px-1 py-0.5 border border-black text-center font-semibold text-[10px] leading-tight"><?php echo $section['total']; ?></td>
                        <td class="px-1 py-0.5 border border-black text-center text-[10px] leading-tight"><?php echo number_format($section['avg'], 2); ?></td>
                        <td class="px-1 py-0.5 border border-black text-center font-semibold text-[10px] leading-tight"><?php echo number_format($section['weighted'], 3); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="bg-gray-100 font-bold">
                    <td class="p-3 border border-black text-right" colspan="3">FINAL OVERALL SCORE:</td>
                    <td class="p-3 border border-black text-center text-red-800 text-sm"><?php echo number_format($data['overall_rating'], 2); ?></td>
                </tr>
            </tfoot>
        </table>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-[10px] mb-8 no-print">
            <div class="p-2 border border-gray-200 rounded">
                <span class="font-bold">Official Complaint?</span> <?php echo strtoupper($data['official_complaint'] ?? 'No'); ?>
            </div>
            <div class="p-2 border border-gray-200 rounded">
                <span class="font-bold">Exceptional Performance?</span> <?php echo strtoupper($data['exceptional_performance'] ?? 'No'); ?>
            </div>
        </div>

        <div class="text-xs mb-10">
            <p class="font-bold underline mb-2 italic">Additional Comments/Remarks:</p>
            <div class="p-5 border border-dashed border-gray-400 italic bg-gray-50 min-h-[80px] leading-relaxed">
                <?php echo !empty($data['additional_comments']) ? nl2br(htmlspecialchars($data['additional_comments'])) : 'No additional comments provided by the Dean.'; ?>
            </div>
        </div>

        <div class="mt-10 sm:mt-16 flex flex-col sm:flex-row justify-between items-center sm:items-end gap-8 sm:gap-4 text-[11px] text-center px-2 sm:px-10">
            <div class="w-full sm:w-64">
                <?php if ($faculty_signature_path && file_exists('../' . $faculty_signature_path)): ?>
                    <img src="../<?php echo htmlspecialchars($faculty_signature_path); ?>" alt="Faculty Signature" class="h-16 mx-auto mb-2 border-b-2 border-transparent">
                <?php else: ?>
                    <div class="h-16 flex items-center justify-center mb-2">
                        <span class="text-gray-400 text-xs italic">No faculty signature</span>
                    </div>
                <?php endif; ?>
                <p class="border-b-2 border-black font-bold uppercase pb-1"><?php echo htmlspecialchars($data['faculty_name']); ?></p>
                <p class="mt-1">Faculty Member's Signature</p>
                <p class="text-[9px] text-gray-500 italic">Date Signed: <?php echo $faculty_signature_date ? date('m/d/Y', strtotime($faculty_signature_date)) : '________________'; ?></p>
            </div>
            <div class="w-full sm:w-64">
                <?php if ($dean_signature_path && file_exists('../' . $dean_signature_path)): ?>
                    <img src="../<?php echo htmlspecialchars($dean_signature_path); ?>" alt="Dean Signature" class="h-16 mx-auto mb-2">
                <?php endif; ?>
                <p class="border-b-2 border-black font-bold uppercase pb-1">MS. MARIBEL SANDAGON</p>
                <p class="mt-1">Dean, College of Computer Studies</p>
                <p class="text-[9px] text-gray-500 italic">Date Signed: <?php echo $dean_signature_date ? date('m/d/Y', strtotime($dean_signature_date)) : date('m/d/Y'); ?></p>
            </div>
        </div>

        <div class="mt-12 print-footer-container">
            <img src="../footer-image.png" alt="Evaluation Footer" class="w-full h-auto border-t-2 border-red-800 pt-2">
        </div>

    </div>
</div>

<style>
/* Optimization for Screen View */
#printableArea {
    page-break-inside: avoid;
}

@media print {
    /* 1. Remove Browser Header/Footer (Date, Title, URL) */
    @page { 
        margin: 0mm 5mm; 
    }
    
    body { 
        margin: 0;
        padding: 0;
        background: white !important; 
    }

    /* 2. Hide Web Elements */
    .no-print, 
    nav, 
    footer, 
    header, 
    button,
    .view-dashboard-btn { 
        display: none !important; 
    }

    /* 3. Layout Adjustments */
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
        bottom: 10mm;
        left: 6mm;
        right: 6mm;
        width: calc(100% - 12mm);
    }
    
    /* 4. Ensure Colors/Images Print */
    .bg-red-50 { background-color: #fef2f2 !important; -webkit-print-color-adjust: exact; }
    .bg-gray-800 { background-color: #1f2937 !important; -webkit-print-color-adjust: exact; }
    .bg-gray-100 { background-color: #f3f4f6 !important; -webkit-print-color-adjust: exact; }
    .text-red-900 { color: #7f1d1d !important; -webkit-print-color-adjust: exact; }
}
</style>