<?php 
include 'header.php'; 

// 1. Handle Filtering Logic
$selected_semester = isset($_GET['semester']) ? $conn->real_escape_string($_GET['semester']) : '';

// 2. Build Query based on filter
$sql = "SELECT * FROM evaluations";
if ($selected_semester !== '') {
    $sql .= " WHERE semester = '$selected_semester'";
}
$sql .= " ORDER BY date_submitted DESC";

$result = $conn->query($sql);
?>

<div class="max-w-7xl mx-auto p-6">
    <div class="bg-white p-4 rounded-t-lg shadow-sm border border-gray-200 flex flex-wrap justify-between items-center gap-4">
        <form method="GET" action="dashboard.php" class="flex items-center gap-3">
            <label for="semester" class="text-xs font-bold uppercase text-gray-500">Filter Semester:</label>
            <select name="semester" onchange="this.form.submit()" class="text-sm border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-red-800">
                <option value="">All Semesters</option>
                <option value="1ST" <?php echo $selected_semester == '1ST' ? 'selected' : ''; ?>>1st Semester</option>
                <option value="2ND" <?php echo $selected_semester == '2ND' ? 'selected' : ''; ?>>2nd Semester</option>
                <option value="SUMMER" <?php echo $selected_semester == 'SUMMER' ? 'selected' : ''; ?>>Summer</option>
            </select>
            <?php if($selected_semester !== ''): ?>
                <a href="dashboard.php" class="text-xs text-red-800 hover:underline font-bold italic">Clear Filter</a>
            <?php endif; ?>
        </form>

        <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full border border-red-200">
            Records Found: <?php echo $result->num_rows; ?>
        </span>
    </div>

    <div class="bg-white rounded-b-lg shadow-md overflow-hidden border-x border-b border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">    
                <thead>
                    <tr class="bg-gray-50 text-gray-600 uppercase text-[10px] tracking-wider font-bold">
                        <th class="p-4 border-b">Faculty Name</th>
                        <th class="p-4 border-b">Semester</th>
                        <th class="p-4 border-b">Subject</th>
                        <th class="p-4 border-b text-center">Total Points</th>
                        <th class="p-4 border-b text-center">Overall Rating</th>
                        <th class="p-4 border-b">Complaints?</th>
                        <th class="p-4 border-b">Date Submitted</th>
                        <th class="p-4 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): 
                            $rating = $row['overall_rating'];
                            // Dynamic Badge Coloring
                            $badgeClass = $rating >= 4.5 ? 'bg-green-100 text-green-800 border-green-200' : 
                                         ($rating >= 3.0 ? 'bg-blue-100 text-blue-800 border-blue-200' : 
                                          'bg-red-100 text-red-800 border-red-200');
                        ?>
                            <tr class="hover:bg-gray-50 border-b transition">
                                <td class="p-4">
                                    <div class="font-bold text-gray-900 uppercase"><?php echo htmlspecialchars($row['faculty_name']); ?></div>
                                    <div class="text-[10px] text-gray-400">SY: <?php echo htmlspecialchars($row['school_year']); ?></div>
                                </td>
                                <td class="p-4">
                                    <span class="text-xs font-bold text-gray-600 bg-gray-100 px-2 py-0.5 rounded">
                                        <?php echo $row['semester']; ?>
                                    </span>
                                </td>
                                <td class="p-4 text-gray-500 italic"><?php echo htmlspecialchars($row['subject_handled']); ?></td>
                                
                                <td class="p-4 text-center font-semibold text-gray-600"><?php echo $row['total_points']; ?></td>
                                <td class="p-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold border <?php echo $badgeClass; ?>">
                                        <?php echo number_format($rating, 2); ?>
                                    </span>
                                </td>
                                <td class="p-4">
                                    <?php if($row['official_complaint'] == 'yes'): ?>
                                        <span class="text-red-600 font-bold flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                            Yes
                                        </span>
                                    <?php else: ?>
                                        <span class="text-gray-400">None</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 text-xs text-gray-500">
                                    <?php echo date('M d, Y', strtotime($row['date_submitted'])); ?>
                                </td>
                                <td class="p-4 text-center">
                                    <a href="view_evaluation.php?id=<?php echo $row['id']; ?>" 
                                       class="inline-flex items-center gap-1 bg-gray-800 text-white px-3 py-1.5 rounded shadow-sm hover:bg-black transition-all text-xs font-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="p-20 text-center text-gray-500 italic">
                                No records found for the selected semester.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $conn->close(); ?>
</body>
</html>