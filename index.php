<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dean's Faculty Evaluation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4 md:p-10">

<div class="max-w-5xl mx-auto bg-white border border-gray-300 shadow-lg p-8">
    <div class="flex justify-between items-center border-b-2 border-red-800 pb-4 mb-6">
        <div class="flex items-center gap-4">
            <div class="w-20 h-20 bg-gray-200 flex items-center justify-center text-xs text-center text-gray-500">Logo</div>
            <div>
                <h1 class="text-xl font-bold text-red-800">UNIVERSITY OF PERPETUAL HELP</h1>
                <p class="text-sm font-semibold">SYSTEM DALTA</p>
            </div>
        </div>
        <div class="text-right text-xs">
            <p>UPHMO-CCS-GEN-901/rev0</p>
            <p class="font-bold">ISO 9001 CERTIFIED</p>
            <p>College of Computer Studies</p>
        </div>
    </div>

    <h2 class="text-center text-2xl font-bold mb-6 underline">DEAN'S FACULTY EVALUATION</h2>

    <form action="submit.php" method="POST">
        <div class="grid grid-cols-2 gap-4 mb-8 text-sm">
            <div>
                <p><strong>College:</strong> CCS</p>
                <p><strong>Dean/Head:</strong> MS. MARIBEL SANDAGON</p>
                <div class="mt-2">
                    <label class="block">Name of Faculty Member:</label>
                    <input type="text" name="faculty_name" class="w-full border-b border-black outline-none" required>
                </div>
            </div>
            <div class="text-right">
                <p><strong>Semester:</strong> 1ST School Year: 2025-26</p>
                <p><strong>Score:</strong> <span class="border px-4 py-1">115</span> <strong>Rating:</strong> <span class="border px-4 py-1">4.56</span></p>
            </div>
        </div>

        <div class="border border-black p-2 mb-6 w-64 ml-auto text-xs">
            <div class="grid grid-cols-2 italic">
                <span>5 - Outstanding</span>
                <span>2 - Fair</span>
                <span>4 - Very Satisfactory</span>
                <span>1 - Needs Improvement</span>
                <span>3 - Satisfactory</span>
            </div>
        </div>

        <table class="w-full border-collapse border border-black text-xs">
            <thead>
                <tr class="bg-gray-50">
                    <th class="border border-black p-2 text-left w-2/3">I. PERSONAL AND SOCIAL TRAITS (10%)</th>
                    <th class="border border-black p-2 w-10">5</th>
                    <th class="border border-black p-2 w-10">4</th>
                    <th class="border border-black p-2 w-10">3</th>
                    <th class="border border-black p-2 w-10">2</th>
                    <th class="border border-black p-2 w-10">1</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-black p-2">1. Is innovative, enthusiastic, approachable and helpful.</td>
                    <td class="border border-black text-center"><input type="radio" name="q1" value="5"></td>
                    <td class="border border-black text-center"><input type="radio" name="q1" value="4"></td>
                    <td class="border border-black text-center"><input type="radio" name="q1" value="3"></td>
                    <td class="border border-black text-center"><input type="radio" name="q1" value="2"></td>
                    <td class="border border-black text-center"><input type="radio" name="q1" value="1"></td>
                </tr>
                <tr class="bg-gray-50 font-bold">
                    <td class="border border-black p-2">II. INSTRUCTIONAL COMPETENCE (60%)</td>
                    <td colspan="5" class="border border-black"></td>
                </tr>
                <tr>
                    <td class="border border-black p-2">1. Shows mastery of the subject matter and comes to class prepared.</td>
                    <td class="border border-black text-center"><input type="radio" name="q2" value="5"></td>
                    <td class="border border-black text-center"><input type="radio" name="q2" value="4"></td>
                    <td class="border border-black text-center"><input type="radio" name="q2" value="3"></td>
                    <td class="border border-black text-center"><input type="radio" name="q2" value="2"></td>
                    <td class="border border-black text-center"><input type="radio" name="q2" value="1"></td>
                </tr>
            </tbody>
        </table>

        <div class="mt-8 space-y-4 text-sm">
            <div class="flex items-center gap-4">
                <p>Official complaint in previous year?</p>
                <label><input type="radio" name="complaint" value="0"> No</label>
                <label><input type="radio" name="complaint" value="1"> Yes</label>
            </div>
            
            <div>
                <label class="block font-bold">Additional Comments:</label>
                <textarea name="comments" class="w-full border border-gray-400 p-2 h-20"></textarea>
            </div>
        </div>

        <div class="mt-12 grid grid-cols-2 gap-20 text-center text-sm">
            <div class="border-t border-black pt-2">Faculty's Signature Over Printed Name</div>
            <div class="border-t border-black pt-2">Dean's Signature</div>
        </div>

        <button type="submit" class="mt-8 bg-red-800 text-white px-6 py-2 rounded hover:bg-red-900">Submit Evaluation</button>
    </form>
</div>

</body>
</html>