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

<style>
    .tab-link {
        position: relative;
        transition: all 0.3s ease;
    }
    .tab-link::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 3px;
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        transition: width 0.3s ease;
    }
    .tab-link:hover::before {
        width: 100%;
    }
    .tab-link.active::before {
        width: 100%;
    }
    .dashboard-card {
        animation: slideInUp 0.5s ease-out;
    }
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .rating-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 4px 12px;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.875rem;
    }
    .rating-excellent { background: #dcfce7; color: #166534; }
    .rating-good { background: #dbeafe; color: #1e40af; }
    .rating-average { background: #fef3c7; color: #92400e; }
    .rating-poor { background: #fee2e2; color: #991b1b; }
    
    .modal-overlay {
        backdrop-filter: blur(4px);
        animation: fadeIn 0.3s ease-out;
    }
    .modal-content {
        animation: modalSlideIn 0.3s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-50px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
</style>

<div class="max-w-7xl mx-auto p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h1>
        <p class="text-gray-600">Manage faculty evaluations and records</p>
    </div>
    
    <div class="flex gap-2 mb-8 bg-white p-2 rounded-xl shadow-md border border-gray-200">
        <a href="dashboard.php?view=evaluations" class="tab-link <?php echo $view == 'evaluations' ? 'active' : ''; ?> flex-1 pb-3 px-6 font-bold text-sm rounded-lg transition-all <?php echo $view == 'evaluations' ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100'; ?>">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Recent Evaluations
        </a>
        <a href="dashboard.php?view=faculty" class="tab-link <?php echo $view == 'faculty' ? 'active' : ''; ?> flex-1 pb-3 px-6 font-bold text-sm rounded-lg transition-all <?php echo $view == 'faculty' ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100'; ?>">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            Manage Faculty
        </a>
    </div>

    <?php if ($view == 'evaluations'): ?>
        <div class="flex justify-between items-center mb-6 dashboard-card">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                <h2 class="font-bold text-gray-800 text-lg">Filter Evaluations</h2>
            </div>
            <form method="GET" class="flex items-center gap-3">
                <input type="hidden" name="view" value="evaluations">
                <select name="semester" onchange="this.form.submit()" class="text-sm border-2 border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white shadow-sm hover:border-blue-300">
                    <option value="">All Semesters</option>
                    <option value="1ST" <?php echo $selected_semester == '1ST' ? 'selected' : ''; ?>>1st Semester</option>
                    <option value="2ND" <?php echo $selected_semester == '2ND' ? 'selected' : ''; ?>>2nd Semester</option>
                </select>

                <select name="school_year" onchange="this.form.submit()" class="text-sm border-2 border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white shadow-sm hover:border-blue-300">
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

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border-2 border-gray-200 dashboard-card">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold uppercase text-xs">
                        <th class="p-4 border-b-2 border-blue-700">Faculty Name</th>
                        <th class="p-4 border-b-2 border-blue-700">Rating</th>
                        <th class="p-4 border-b-2 border-blue-700">School Year | Period</th>
                        <th class="p-4 border-b-2 border-blue-700">Date</th>
                        <th class="p-4 text-center border-b-2 border-blue-700">Actions</th>
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
                    while($row = $res->fetch_assoc()): 
                        $rating = $row['overall_rating'];
                        $ratingClass = $rating >= 4.5 ? 'rating-excellent' : ($rating >= 3.5 ? 'rating-good' : ($rating >= 2.5 ? 'rating-average' : 'rating-poor'));
                    ?>
                    <tr class="border-b border-gray-200 hover:bg-blue-50 transition-colors">
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                    <?php echo strtoupper(substr($row['faculty_name'], 0, 1)); ?>
                                </div>
                                <span class="font-bold text-gray-900"><?php echo htmlspecialchars($row['faculty_name']); ?></span>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="rating-badge <?php echo $ratingClass; ?>">
                                <?php echo number_format($row['overall_rating'], 2); ?>
                            </span>
                        </td>
                        
                        <td class="p-4 text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="font-semibold text-gray-700"><?php echo $row['school_year'] ?? 'N/A'; ?></span>
                                <span class="text-gray-400">•</span>
                                <span class="text-gray-600"><?php echo $row['semester'] ?? 'N/A'; ?></span>
                            </div>
                        </td>

                        <td class="p-4 text-gray-600 text-sm">
                            <?php echo date('M d, Y', strtotime($row['date_submitted'])); ?>
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="view_evaluation.php?id=<?php echo $row['id']; ?>" 
                                class="text-blue-600 hover:text-blue-800 text-sm font-bold underline transition flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Summary
                                </a>
                                
                                <a href="full_evaluation.php?id=<?php echo $row['id']; ?>" 
                                class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-lg text-sm hover:shadow-lg transition font-bold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    View Full
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    <?php else: ?>
        <div class="flex justify-between items-center mb-6 dashboard-card">
            <div>
                <h2 class="font-bold text-gray-800 text-xl">Active Faculty Members</h2>
                <p class="text-gray-600 text-sm mt-1">Manage your faculty roster</p>
            </div>
            <button onclick="document.getElementById('addFacultyModal').classList.remove('hidden')" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-3 rounded-xl font-bold text-sm hover:shadow-lg transition-all flex items-center gap-2 group">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Faculty Member
            </button>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border-2 border-gray-200 dashboard-card">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold uppercase text-xs">
                        <th class="p-4 border-b-2 border-green-700">Full Name</th>
                        <th class="p-4 border-b-2 border-green-700">Department</th>
                        <th class="p-4 text-center border-b-2 border-green-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $res = $conn->query("SELECT * FROM faculty ORDER BY name ASC");
                    if($res && $res->num_rows > 0):
                        while($row = $res->fetch_assoc()): ?>
                        <tr class="border-b border-gray-200 hover:bg-green-50 transition-colors">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                        <?php echo strtoupper(substr($row['name'], 0, 1)); ?>
                                    </div>
                                    <span class="font-bold text-gray-900"><?php echo htmlspecialchars($row['name']); ?></span>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <?php echo htmlspecialchars($row['department'] ?? 'CCS'); ?>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="flex justify-center gap-2">
                                    <a href="edit_faculty.php?id=<?php echo $row['id']; ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition flex items-center gap-1 shadow-md">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <a href="dashboard.php?delete_faculty=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this faculty member?')" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition flex items-center gap-1 shadow-md">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; 
                    else: ?>
                        <tr>
                            <td colspan="3" class="p-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <p class="text-gray-400 font-medium">No faculty members added yet.</p>
                                    <button onclick="document.getElementById('addFacultyModal').classList.remove('hidden')" class="text-blue-600 hover:text-blue-800 font-bold text-sm underline">Add your first faculty member</button>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<div id="addFacultyModal" class="hidden fixed inset-0 bg-black/50 modal-overlay flex items-center justify-center p-4 z-50">
    <div class="modal-content bg-white rounded-2xl max-w-md w-full shadow-2xl border-2 border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-6 text-white">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold">Add New Faculty</h3>
                    <p class="text-green-100 text-sm">Enter faculty member details</p>
                </div>
            </div>
        </div>
        <form action="process_faculty.php" method="POST" class="p-6 space-y-5">
            <div>
                <label class="block text-xs font-bold uppercase text-gray-700 mb-2 tracking-wide">Full Name</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input type="text" name="name" required class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-green-500 transition">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-gray-700 mb-2 tracking-wide">Department</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <input type="text" name="department" value="College of Computer Studies" class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-green-500 transition">
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <button type="button" onclick="document.getElementById('addFacultyModal').classList.add('hidden')" class="px-6 py-2.5 text-gray-600 font-bold hover:bg-gray-100 rounded-lg transition">
                    Cancel
                </button>
                <button type="submit" name="add_faculty" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-2.5 rounded-lg font-bold hover:shadow-lg transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Faculty
                </button>
            </div>
        </form>
    </div>
</div>