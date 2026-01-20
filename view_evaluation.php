<?php 
include 'header.php'; 

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
        <button onclick="window.print()" class="bg-gray-800 text-white px-6 py-2 rounded font-bold hover:bg-black transition">
            🖨️ Print to PDF
        </button>
    </div>

    <div class="max-w-5xl mx-auto bg-white border border-gray-400 shadow-2xl p-6 md:p-10" id="printableArea">
        <div class="flex justify-between items-start border-b-2 border-red-800 pb-4 mb-4">
            <div class="flex gap-4">
                <div class="w-16 h-16 bg-gray-200 border flex items-center justify-center text-[10px] font-bold">LOGO</div>
                <div>
                    <h1 class="text-lg font-bold text-red-800 uppercase">University of Perpetual Help System Dalta</h1>
                    <p class="text-xs font-semibold italic text-gray-600">College of Computer Studies</p>
                </div>
            </div>
            <div class="text-right text-[10px] space-y-1">
                <p>UPHMO-CCS-GEN-901/rev0</p>
                <p class="font-bold text-red-800">OFFICIAL RECORD</p>
            </div>
        </div>

        <h2 class="text-center text-xl font-black mb-6 uppercase">Faculty Evaluation Result</h2>

        <div class="grid grid-cols-3 gap-6 text-xs mb-6 border-b pb-6">
            <div class="space-y-2">
                <p><strong>Faculty:</strong> <span class="border-b border-black font-bold uppercase"><?php echo $data['faculty_name']; ?></span></p>
                <p><strong>Dean:</strong> <span class="border-b border-black font-bold">MS. MARIBEL SANDAGON</span></p>
            </div>
            <div class="space-y-2">
                <p><strong>Semester:</strong> <span class="border-b border-black font-bold"><?php echo $data['semester'] ?? 'N/A'; ?></span></p>
                <p><strong>School Year:</strong> <span class="border-b border-black font-bold"><?php echo $data['school_year'] ?? 'N/A'; ?></span></p>
            </div>
            <div class="bg-red-50 p-2 border border-red-800 rounded">
                <p class="flex justify-between font-bold"><span>OVERALL RATING:</span> <span><?php echo number_format($data['overall_rating'], 2); ?></span></p>
                <p class="flex justify-between text-[10px] mt-1 italic"><span>DATE:</span> <span><?php echo date('M d, Y', strtotime($data['date_submitted'])); ?></span></p>
            </div>
        </div>

        <table class="w-full border border-black text-xs mb-8">
            <tr class="bg-gray-800 text-white font-bold">
                <th class="p-2 border border-black text-left">EVALUATION CRITERIA</th>
                <th class="p-2 border border-black text-center w-24">AVG SCORE</th>
                <th class="p-2 border border-black text-center w-24">WEIGHTED</th>
            </tr>
            <tr>
                <td class="p-2 border border-black">I. Personal and Social Traits (10%)</td>
                <td class="p-2 border border-black text-center"><?php echo number_format($data['sec1_avg'], 2); ?></td>
                <td class="p-2 border border-black text-center"><?php echo number_format($data['sec1_avg'] * 0.10, 3); ?></td>
            </tr>
            <tr>
                <td class="p-2 border border-black">II. Instructional Competence (60%)</td>
                <td class="p-2 border border-black text-center"><?php echo number_format($data['sec2_avg'], 2); ?></td>
                <td class="p-2 border border-black text-center"><?php echo number_format($data['sec2_avg'] * 0.60, 3); ?></td>
            </tr>
            <tr>
                <td class="p-2 border border-black">III. Classroom Management (10%)</td>
                <td class="p-2 border border-black text-center"><?php echo number_format($data['sec3_avg'], 2); ?></td>
                <td class="p-2 border border-black text-center"><?php echo number_format($data['sec3_avg'] * 0.10, 3); ?></td>
            </tr>
            <tr>
                <td class="p-2 border border-black text-center font-bold bg-gray-100" colspan="2">GRAND TOTAL POINTS:</td>
                <td class="p-2 border border-black text-center font-bold bg-gray-100"><?php echo $data['total_points']; ?></td>
            </tr>
        </table>

        <div class="text-xs mb-8">
            <p class="font-bold underline mb-1">Additional Comments/Remarks:</p>
            <div class="p-4 border border-gray-300 italic bg-gray-50 min-h-[60px]">
                <?php echo !empty($data['comments']) ? nl2br($data['comments']) : 'No comments provided.'; ?>
            </div>
        </div>

        <div class="mt-12 flex justify-between items-end text-[10px] text-center px-10">
            <div class="w-56">
                <p class="border-b border-black font-bold uppercase"><?php echo $data['faculty_name']; ?></p>
                <p>Faculty Member</p>
            </div>
            <div class="w-56">
                <p class="border-b border-black font-bold uppercase">MS. MARIBEL SANDAGON</p>
                <p>Dean, CCS</p>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print, nav { display: none !important; }
    body { background: white !important; }
    .py-10 { padding: 0 !important; }
    .shadow-2xl { shadow: none !important; border: none !important; }
}
</style>

</body>
</html>