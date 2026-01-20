<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dean's Faculty Evaluation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .table-input:checked { accent-color: #991b1b; }
        tr:hover { background-color: #fef2f2; }
    </style>
</head>
<body class="bg-gray-100 p-4 md:p-10">

<div class="max-w-5xl mx-auto bg-white border border-gray-300 shadow-lg p-8">
    <div class="flex justify-between items-center border-b-2 border-red-800 pb-4 mb-6">
        <div class="flex items-center gap-4">
            <div class="w-20 h-20 bg-gray-200 flex items-center justify-center text-xs text-center text-gray-500 font-bold border border-gray-300">UPHSD LOGO</div>
            <div>
                <h1 class="text-xl font-bold text-red-800 uppercase">University of Perpetual Help</h1>
                <p class="text-sm font-semibold italic text-red-700">System Dalta</p>
            </div>
        </div>
        <div class="text-right text-[10px] leading-tight text-gray-600">
            <p>UPHMO-CCS-GEN-901/rev0</p>
            <p class="font-bold">ISO 9001 / ISO 21001 CERTIFIED</p>
            <p>College of Computer Studies</p>
        </div>
    </div>

    <h2 class="text-center text-2xl font-bold mb-6 underline decoration-red-800 underline-offset-4">DEAN'S FACULTY EVALUATION</h2>

    <form action="submit.php" method="POST" id="evalForm">
        <div class="grid grid-cols-2 gap-4 mb-8 text-sm">
            <div>
                <p><strong>College:</strong> CCS</p>
                <p><strong>Dean/Head:</strong> MS. MARIBEL SANDAGON</p>
                <div class="mt-2">
                    <label class="block font-semibold">Name of Faculty Member:</label>
                    <input type="text" name="faculty_name" class="w-full border-b border-black outline-none bg-transparent" placeholder="Enter Name" required>
                </div>
            </div>
            <div class="text-right">
                <p><strong>Semester:</strong> 1ST School Year: 2025-26</p>
                <div class="flex justify-end gap-4 mt-2 font-bold">
                    <p>TOTAL SCORE: <span id="display-total" class="border px-4 py-1 bg-gray-50">0</span></p>
                    <p>OVERALL RATING: <span id="display-rating" class="border px-4 py-1 bg-yellow-50">0.00</span></p>
                </div>
            </div>
        </div>

        <div class="border border-black p-2 mb-6 w-72 ml-auto text-[10px] bg-gray-50">
            <div class="grid grid-cols-2 gap-x-2 italic">
                <span>5 - Outstanding</span> <span>2 - Fair</span>
                <span>4 - Very Satisfactory</span> <span>1 - Needs Improvement</span>
                <span class="col-span-2">3 - Satisfactory</span>
            </div>
        </div>

        <table class="w-full border-collapse border border-black text-[11px]">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-black p-2 text-left w-2/3 uppercase">Evaluation Criteria</th>
                    <th class="border border-black p-2 w-8">5</th>
                    <th class="border border-black p-2 w-8">4</th>
                    <th class="border border-black p-2 w-8">3</th>
                    <th class="border border-black p-2 w-8">2</th>
                    <th class="border border-black p-2 w-8">1</th>
                </tr>
            </thead>
            
            <tbody class="section" data-weight="0.10" data-count="3">
                <tr class="bg-red-50 font-bold"><td colspan="6" class="border border-black p-2">I. PERSONAL AND SOCIAL TRAITS (10%)</td></tr>
                <?php 
                $sec1 = ["Is innovative, enthusiastic, approachable and helpful.", "Dresses appropriately for classroom instructions...", "Uses courteous and appropriate verbal expressions..."];
                foreach($sec1 as $i => $text) { echoRow("s1_q".($i+1), ($i+1).". ".$text); }
                ?>
            </tbody>

            <tbody class="section" data-weight="0.60" data-count="11">
                <tr class="bg-red-50 font-bold"><td colspan="6" class="border border-black p-2">II. INSTRUCTIONAL COMPETENCE (60%)</td></tr>
                <?php 
                $sec2 = [
                    "Shows mastery of the subject matter...", 
                    "Explains the lessons clearly and uses examples...",
                    "Relates lessons with other issues...",
                    "Entertains and answers convincingly questions...",
                    "Evaluates students' performance through tests...",
                    "Provides students with opportunities to think critically...",
                    "Uses technology or teaching aids/devices...",
                    "Makes use of varied strategies...",
                    "Provides the students with the course outline...",
                    "Gives follow-up work and further learning activities...",
                    "Is fair and impartial in grading students..."
                ];
                foreach($sec2 as $i => $text) { echoRow("s2_q".($i+1), ($i+1).". ".$text); }
                ?>
            </tbody>

            <tbody class="section" data-weight="0.10" data-count="5">
                <tr class="bg-red-50 font-bold"><td colspan="6" class="border border-black p-2">III. CLASSROOM MANAGEMENT (10%)</td></tr>
                <?php 
                $sec3 = [
                    "Starts and ends the class with a prayer.",
                    "Maintains order and discipline throughout the period.",
                    "Collects test papers, homeworks, projects timely.",
                    "Calls his students by name and manifests rapport.",
                    "Keeps an accurate record of attendance and grades."
                ];
                foreach($sec3 as $i => $text) { echoRow("s3_q".($i+1), ($i+1).". ".$text); }
                ?>
            </tbody>

            <tbody class="section" data-weight="0.10" data-count="4">
                <tr class="bg-red-50 font-bold"><td colspan="6" class="border border-black p-2 text-[10px]">IV. CONDUCT TOWARDS AUTHORITY & PARTICIPATION (10%)</td></tr>
                <?php 
                $sec4 = ["Renders due respect to superior...", "Manifests loyalty to his institution.", "Fulfills properly his duties and obligations...", "Attends official functions and activities..."];
                foreach($sec4 as $i => $text) { echoRow("s4_q".($i+1), ($i+1).". ".$text); }
                ?>
            </tbody>

            <tbody class="section" data-weight="0.10" data-count="2">
                <tr class="bg-red-50 font-bold"><td colspan="6" class="border border-black p-2 text-[10px]">V. PROFESSIONAL ADVANCEMENT (10%)</td></tr>
                <?php 
                $sec5 = ["Seeks professional advancement through membership...", "Participates actively in research undertakings..."];
                foreach($sec5 as $i => $text) { echoRow("s5_q".($i+1), ($i+1).". ".$text); }
                ?>
            </tbody>
        </table>

        <div class="mt-8 space-y-4 text-sm border-t pt-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="border p-3 rounded">
                    <p class="font-semibold mb-2 italic text-xs">Has there been any official complaint against the faculty member?</p>
                    <label class="mr-4"><input type="radio" name="complaint" value="0"> No</label>
                    <label><input type="radio" name="complaint" value="1"> Yes</label>
                </div>
                <div class="border p-3 rounded text-xs italic">
                    <p class="font-semibold mb-2">Exceptional performance demonstrated?</p>
                    <input type="text" name="exceptional" class="w-full border-b border-gray-400 outline-none" placeholder="Specify if any">
                </div>
            </div>
            
            <div>
                <label class="block font-bold mb-1">Dean's Additional Comments:</label>
                <textarea name="comments" class="w-full border border-gray-400 p-2 h-24 text-sm" placeholder="Enter evaluation summary..."></textarea>
            </div>
        </div>

        <div class="mt-12 grid grid-cols-2 gap-20 text-center text-xs">
            <div>
                <div class="border-b border-black mb-1"></div>
                <p>Faculty's Signature Over Printed Name</p>
                <p class="text-gray-400">Date: ___________</p>
            </div>
            <div>
                <div class="border-b border-black mb-1 font-bold italic">MS. MARIBEL SANDAGON</div>
                <p>Dean's Signature</p>
                <p class="text-gray-400">Date: <?php echo date("m/d/Y"); ?></p>
            </div>
        </div>

        <button type="submit" class="mt-10 w-full bg-red-800 text-white font-bold py-3 rounded shadow-lg hover:bg-red-900 transition-colors uppercase tracking-widest">
            Submit Faculty Evaluation
        </button>
    </form>
</div>

<?php 
// Helper function to render rows
function echoRow($name, $label) {
    echo '<tr>
            <td class="border border-black p-2 font-medium">'.$label.'</td>';
    for($v=5; $v>=1; $v--) {
        echo '<td class="border border-black text-center">
                <input type="radio" name="'.$name.'" value="'.$v.'" class="table-input calc-trigger" required>
              </td>';
    }
    echo '</tr>';
}
?>

<script>
    // Live Calculation Script
    document.querySelectorAll('.calc-trigger').forEach(input => {
        input.addEventListener('change', calculateAll);
    });

    function calculateAll() {
        let totalPoints = 0;
        let weightedTotal = 0;
        const sections = document.querySelectorAll('.section');

        sections.forEach(section => {
            const weight = parseFloat(section.getAttribute('data-weight'));
            const count = parseInt(section.getAttribute('data-count'));
            const checkedRadios = section.querySelectorAll('input:checked');
            
            let sectionSum = 0;
            checkedRadios.forEach(radio => {
                sectionSum += parseInt(radio.value);
            });

            if (checkedRadios.length > 0) {
                totalPoints += sectionSum;
                let sectionAvg = sectionSum / count;
                weightedTotal += (sectionAvg * weight);
            }
        });

        document.getElementById('display-total').innerText = totalPoints;
        document.getElementById('display-rating').innerText = weightedTotal.toFixed(2);
    }
</script>

</body>
</html>