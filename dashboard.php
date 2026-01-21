<?php 
include 'header.php'; 

// Handle Deletion Logic
if (isset($_GET['delete_faculty'])) {
    $f_id = $conn->real_escape_string($_GET['delete_faculty']);
    $conn->query("DELETE FROM faculty WHERE id = '$f_id'");
    header("Location: dashboard.php?view=faculty");
}

$view = $_GET['view'] ?? 'evaluations';
$selected_semester = isset($_GET['semester']) ? $conn->real_escape_string($_GET['semester']) : '';
// Added School Year Filter Logic
$selected_sy = isset($_GET['school_year']) ? $conn->real_escape_string($_GET['school_year']) : '';
?>

<div class="max-w-7xl mx-auto p-6">
    <div class="flex gap-4 mb-6 border-b border-gray-200">
        <a href="dashboard.php?view=evaluations" class="pb-2 px-4 font-bold text-sm <?php echo $view == 'evaluations' ? 'border-b-2 border-blue-800 text-blue-800' : 'text-gray-500 hover:text-gray-700'; ?>">
            Recent Evaluations
        </a>
        <a href="dashboard.php?view=faculty" class="pb-2 px-4 font-bold text-sm <?php echo $view == 'faculty' ? 'border-b-2 border-blue-800 text-blue-800' : 'text-gray-500 hover:text-gray-700'; ?>">
            Manage Faculty List
        </a>
    </div>

    <?php if ($view == 'evaluations'): ?>
        <div class="flex justify-between items-center mb-4">
            <form method="GET" class="flex items-center gap-3">
                <input type="hidden" name="view" value="evaluations">
                <select name="semester" onchange="this.form.submit()" class="text-sm border rounded px-3 py-1.5 focus:ring-2 focus:ring-blue-800">
                    <option value="">All Semesters</option>
                    <option value="1ST" <?php echo $selected_semester == '1ST' ? 'selected' : ''; ?>>1st Semester</option>
                    <option value="2ND" <?php echo $selected_semester == '2ND' ? 'selected' : ''; ?>>2nd Semester</option>
                </select>

                <select name="school_year" onchange="this.form.submit()" class="text-sm border rounded px-3 py-1.5 focus:ring-2 focus:ring-blue-800">
                    <option value="">All School Years</option>
                    <?php 
                    $sy_res = $conn->query("SELECT DISTINCT school_year FROM evaluations ORDER BY school_year DESC");
                    while($sy_row = $sy_res->fetch_assoc()): ?>
                        <option value="<?php echo $sy_row['school_year']; ?>" <?php echo $selected_sy == $sy_row['school_year'] ? 'selected' : ''; ?>>
                            SY <?php echo $sy_row['school_year']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
            <table class="w-full text-left border-collapse text-sm">
                <thead class="bg-gray-50 font-bold uppercase text-[10px] text-gray-600">
                    <tr>
                        <th class="p-4">Faculty Name</th>
                        <th class="p-4">Rating</th>
                        <th class="p-4">School Year | Period</th>
                        <th class="p-4">Date</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Updated SQL to handle both Semester and School Year filters
                    $conditions = [];
                    if ($selected_semester) $conditions[] = "semester='$selected_semester'";
                    if ($selected_sy) $conditions[] = "school_year='$selected_sy'";
                    
                    $where = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";
                    
                    $sql = "SELECT * FROM evaluations $where ORDER BY date_submitted DESC";
                    $res = $conn->query($sql);
                    while($row = $res->fetch_assoc()): ?>
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-4 font-bold"><?php echo htmlspecialchars($row['faculty_name']); ?></td>
                        <td class="p-4"><?php echo number_format($row['overall_rating'], 2); ?></td>
                        
                        <td class="p-4 text-xs">
                            <span class="font-semibold text-gray-700"><?php echo $row['school_year'] ?? 'N/A'; ?></span>
                            <span class="text-gray-400">|</span>
                            <span class="text-gray-600"><?php echo $row['semester'] ?? 'N/A'; ?></span>
                        </td>

                        <td class="p-4 text-gray-500"><?php echo date('M d, Y', strtotime($row['date_submitted'])); ?></td>
                        <td class="p-4 text-center space-x-2">
                            <a href="view_evaluation.php?id=<?php echo $row['id']; ?>" 
                            class="text-gray-600 hover:text-gray-900 text-xs font-bold underline">
                            Summary
                            </a>
                            
                            <a href="full_evaluation.php?id=<?php echo $row['id']; ?>" 
                            class="bg-blue-800 text-white px-3 py-1.5 rounded text-xs hover:bg-blue-900 transition font-bold shadow-sm">
                            View Full
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    <?php else: ?>
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-gray-800">Active Faculty Members</h2>
            <button onclick="document.getElementById('addFacultyModal').classList.remove('hidden')" class="bg-green-700 text-white px-4 py-2 rounded font-bold text-sm hover:bg-green-800 transition">
                + Add Faculty Member
            </button>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
            <table class="w-full text-left border-collapse text-sm">
                <thead class="bg-gray-50 font-bold uppercase text-[10px] text-gray-600">
                    <tr>
                        <th class="p-4">Full Name</th>
                        <th class="p-4">Department</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $res = $conn->query("SELECT * FROM faculty ORDER BY name ASC");
                    if($res && $res->num_rows > 0):
                        while($row = $res->fetch_assoc()): ?>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-4 font-bold text-gray-900"><?php echo htmlspecialchars($row['name']); ?></td>
                            <td class="p-4 text-gray-600"><?php echo htmlspecialchars($row['department'] ?? 'CCS'); ?></td>
                            <td class="p-4 text-center flex justify-center gap-3">
                                <a href="edit_faculty.php?id=<?php echo $row['id']; ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <a href="dashboard.php?delete_faculty=<?php echo $row['id']; ?>" onclick="return confirm('Delete this faculty member?')" class="text-blue-600 hover:text-blue-800">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; 
                    else: ?>
                        <tr><td colspan="3" class="p-10 text-center text-gray-400">No faculty members added yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<div id="addFacultyModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full p-6 shadow-2xl">
        <h3 class="text-lg font-bold mb-4">Add New Faculty</h3>
        <form action="process_faculty.php" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs font-bold mb-1">Full Name</label>
                <input type="text" name="name" requiblue class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-xs font-bold mb-1">Department</label>
                <input type="text" name="department" value="College of Computer Studies" class="w-full border rounded px-3 py-2">
            </div>
            <div class="flex justify-end gap-2 pt-4">
                <button type="button" onclick="document.getElementById('addFacultyModal').classList.add('hidden')" class="px-4 py-2 text-gray-500 font-bold">Cancel</button>
                <button type="submit" name="add_faculty" class="bg-blue-800 text-white px-4 py-2 rounded font-bold">Save Faculty</button>
            </div>
        </form>
    </div>
</div>