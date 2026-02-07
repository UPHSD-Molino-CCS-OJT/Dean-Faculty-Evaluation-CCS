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
?>

<div class="py-10 px-4">
    <div class="max-w-5xl mx-auto mb-4 flex justify-end no-print">
        <button onclick="window.print()" class="bg-red-800 text-white px-6 py-2 rounded font-bold hover:bg-red-900 transition shadow-md flex items-center gap-2">
            <span>🖨️</span> Print Official Record
        </button>
    </div>

    <div class="max-w-5xl mx-auto bg-white border border-gray-400 shadow-2xl p-6 md:p-10" id="printableArea">
        
        <div class="w-full border-b-2 border-red-800 pb-2 mb-6">
            <img src="header-image.png" alt="University Header" class="w-full h-auto">
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
                    <td class="p-3 border border-black text-center text-red-800 text-sm"><?php echo number_format($data['overall_rating'], 2); ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="grid grid-cols-2 gap-4 text-[10px] mb-8 no-print">
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
        margin: 0; 
    }
    
    body { 
        margin: 0;
        padding: 0.5in; /* Adds margin to the content instead of the page */
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
    
    /* 4. Ensure Colors/Images Print */
    .bg-red-50 { background-color: #fef2f2 !important; -webkit-print-color-adjust: exact; }
    .bg-gray-800 { background-color: #1f2937 !important; -webkit-print-color-adjust: exact; }
    .bg-gray-100 { background-color: #f3f4f6 !important; -webkit-print-color-adjust: exact; }
    .text-red-900 { color: #7f1d1d !important; -webkit-print-color-adjust: exact; }
}
</style>