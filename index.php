<?php include 'header.php'; ?>
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
        .numeric-cell { text-align: center; border: 1px solid black; }
        input[type="text"], input[type="number"] { border-bottom: 1px solid black; outline: none; background: transparent; }
        
        /* Collapsible Styling */
        .section-header { cursor: pointer; user-select: none; }
        .section-header:hover { background-color: #fee2e2; }
        .hidden-row { display: none; }

        /* Progress Bar Styling */
        .sticky-progress { position: sticky; top: 0; z-index: 100; background: white; border-bottom: 1px solid #e5e7eb; padding: 10px 0; }
    </style>
</head>
<body class="bg-gray-100 p-4 md:p-8">

<div class="sticky-progress mb-6">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex justify-between items-center mb-1">
            <span class="text-xs font-bold uppercase text-red-800">Completion Progress</span>
            <span id="progress-text" class="text-xs font-bold text-red-800">0%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div id="progress-fill" class="bg-red-800 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto bg-white border border-gray-400 shadow-2xl p-4 md:p-10">
    
    <div class="flex justify-between items-start border-b-2 border-red-800 pb-4 mb-4">
        <div class="flex gap-4">
            <div class="w-20 h-20 bg-gray-200 border flex items-center justify-center text-s font-bold">LOGO</div>
            <div>
                <h1 class="text-xl font-bold text-red-800">UNIVERSITY OF PERPETUAL HELP</h1>
                <p class="text-s font-semibold italic">SYSTEM DALTA</p>
                <p class="text-xs text-gray-600 mt-1">College of Computer Studies</p>
            </div>
        </div>
        <div class="text-right text-s space-y-1">
            <p>UPHMO-CCS-GEN-901/rev0</p>
            <p class="font-bold">ISO 9001 CERTIFIED</p>
        </div>
    </div>

    <h2 class="text-center text-xl font-black mb-6 uppercase tracking-wider">Dean's Faculty Evaluation</h2>

    <form action="submit.php" method="POST" id="evalForm">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs mb-6">
            <div class="space-y-2">
                <p><strong>College:</strong> CCS</p>
                <p><strong>Dean/Head:</strong> MS. MARIBEL SANDAGON</p>
                <p><strong>Name of Faculty:</strong> 
                    <select name="faculty_name" id="faculty_select" class="font-bold border-b border-black outline-none bg-transparent cursor-pointer" onchange="updateSignature(this.value)" required>
                        <option value="" disabled selected>Select Faculty</option>
                        <option value="FE ANTONIO">FE ANTONIO</option>
                        <option value="JUAN DELA CRUZ">JUAN DELA CRUZ</option>
                        <option value="MARIA CLARA">MARIA CLARA</option>
                        <option value="RICARDO DALISAY">RICARDO DALISAY</option>
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
            <div class="border-2 border-red-800 p-2 bg-red-50 rounded">
                <div class="flex justify-between font-bold"><span>POINTS:</span> <span id="grand-total-points">0</span></div>
                <div class="flex justify-between font-bold text-red-800"><span>OVER-ALL RATING:</span> <span id="grand-overall-rating">0.00</span></div>
                <div class="flex justify-between text-s mt-1 italic"><span>RANK:</span> <input type="text" class="w-12 border-none bg-transparent"></div>
            </div>
        </div>

        <div class="bg-gray-50 p-4 border border-gray-300 text-xs mb-6 italic">
            <p class="mb-2 font-bold">To the dean,</p>
            <p>In order to maintain quality teaching and instruction, please select the number that you believe best describes the instructor/professor in what is asked in each item.</p>
            <div class="mt-3 grid grid-cols-5 font-bold text-center">
                <span>5 - Outstanding</span>
                <span>4 - Very Satisfactory</span>
                <span>3 - Satisfactory</span>
                <span>2 - Fair</span>
                <span>1 - Needs Improvement</span>
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
                        "Explains the lessons clearly and uses examples or illustrations for students to better understand the lesson...",
                        "Relates lessons with other issues, concerns or developments which are of local, national or global significance.",
                        "Entertains and answers convincingly questions from students and encourages them to ask questions.",
                        "Evaluates students' performance through tests and other means of assessment.",
                        "Provides students with opportunities to think critically, creatively and reflectively.",
                        "Uses technology or teaching aids/devices to arouse and sustain student interest.",
                        "Makes use of varied strategies to develop the daily lesson and creates opportunities to address individual differences.",
                        "Provides the students with the course outline at the start of the semester.",
                        "Gives follow-up work and further learning activities through assignments and research.",
                        "Is fair and impartial in grading students and gives constructive feedback."
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
                        "Keeps an accurate record of attendance, punctuality, quizzes, tests and other measures."
                    ]
                ],
                'sec4' => [
                    'title' => 'IV. CONDUCT TOWARDS LEGITIMATE SCHOOL AUTHORITY (10%)',
                    'weight' => 0.10,
                    'items' => [
                        "Renders due respect to immediate superior and College officials.",
                        "Manifests loyalty to his institution.",
                        "Fulfills properly his duties and obligations in the college/department.",
                        "Attends official functions and college-sponsored activities (Graduation, faculty meetings, etc)."
                    ]
                ],
                'sec5' => [
                    'title' => 'V. PROFESSIONAL ADVANCEMENT (10%)',
                    'weight' => 0.10,
                    'items' => [
                        "Seeks professional advancement through membership in organization and attendance in line with University Program.",
                        "Participates actively in research undertakings and in the presentation, dissemination and publication of outputs."
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

        <div class="mt-8 text-xs border border-black p-4 space-y-4">
            <p class="font-bold underline">Please check the appropriate box:</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex items-center justify-between border-r pr-4">
                    <span>Has there been any official complaint against the faculty member?</span>
                    <div class="flex gap-4">
                        <label>Yes <input type="radio" name="complaint" value="yes"></label>
                        <label>No <input type="radio" name="complaint" value="no"></label>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center justify-between">
                        <span>Has the faculty member demonstrated exceptional performance?</span>
                        <div class="flex gap-4">
                            <label>Yes <input type="radio" name="exceptional" value="yes"></label>
                            <label>No <input type="radio" name="exceptional" value="no"></label>
                        </div>
                    </div>
                    <input type="text" placeholder="Please specify if yes" class="mt-2 w-full text-s italic">
                </div>
            </div>
            <div>
                <label class="font-bold">Additional Comments:</label>
                <textarea name="comments" class="w-full border border-gray-400 mt-2 p-2 h-20 outline-none focus:border-red-800"></textarea>
            </div>
        </div>

        <div class="mt-12 flex justify-between items-end text-xs text-center px-10">
            <div class="w-64">
                <p id="sig_name" class="border-b border-black font-bold h-4 uppercase">SELECT FACULTY</p>
                <p>Faculty's Signature Over Printed name</p>
                <p class="mt-2">Date: <span class="border-b border-black inline-block w-32">&nbsp;</span></p>
            </div>

            <div class="w-64">
                <p class="border-b border-black font-bold h-4 uppercase">MS. MARIBEL SANDAGON</p>
                <p>Dean's Signature</p>
                <p class="mt-2">Date: <span class="border-b border-black inline-block w-32">&nbsp;</span></p>
            </div>
        </div>

        <button type="submit" class="mt-10 w-full bg-red-800 text-white font-bold py-4 rounded hover:bg-red-900 transition-all shadow-lg uppercase tracking-widest">Submit Official Evaluation</button>
    </form>
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
<script src="script.js"></script>
</body>
</html>