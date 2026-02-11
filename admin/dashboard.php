<?php 
include '../includes/header.php'; 

// Handle Image Upload for Header/Footer
if (isset($_POST['update_images'])) {
    $upload_dir = '../';
    $success = true;
    $message = '';
    
    // Handle Header Image Upload
    if (isset($_FILES['header_image']) && $_FILES['header_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['header_image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $target = $upload_dir . 'header-image.png';
            if (move_uploaded_file($_FILES['header_image']['tmp_name'], $target)) {
                $conn->query("INSERT INTO settings (setting_key, setting_value) VALUES ('header_image_path', 'header-image.png') 
                             ON DUPLICATE KEY UPDATE setting_value = 'header-image.png', updated_at = CURRENT_TIMESTAMP");
                $message .= 'Header image uploaded successfully! ';
            } else {
                $success = false;
                $message .= 'Failed to upload header image. ';
            }
        } else {
            $success = false;
            $message .= 'Invalid header image format. Only JPG, PNG, GIF allowed. ';
        }
    }
    
    // Handle Footer Image Upload
    if (isset($_FILES['footer_image']) && $_FILES['footer_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['footer_image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $target = $upload_dir . 'footer-image.png';
            if (move_uploaded_file($_FILES['footer_image']['tmp_name'], $target)) {
                $conn->query("INSERT INTO settings (setting_key, setting_value) VALUES ('footer_image_path', 'footer-image.png') 
                             ON DUPLICATE KEY UPDATE setting_value = 'footer-image.png', updated_at = CURRENT_TIMESTAMP");
                $message .= 'Footer image uploaded successfully! ';
            } else {
                $success = false;
                $message .= 'Failed to upload footer image. ';
            }
        } else {
            $success = false;
            $message .= 'Invalid footer image format. Only JPG, PNG, GIF allowed. ';
        }
    }
    
    if ($success && !empty($message)) {
        header("Location: dashboard.php?view=settings&success=1&message=" . urlencode($message));
    } else if (!empty($message)) {
        header("Location: dashboard.php?view=settings&error=1&message=" . urlencode($message));
    } else {
        header("Location: dashboard.php?view=settings&error=1&message=" . urlencode("No images selected"));
    }
    exit();
}

// Handle Deletion Logic
if (isset($_GET['delete_faculty'])) {
    $f_id = $conn->real_escape_string($_GET['delete_faculty']);
    $conn->query("DELETE FROM faculty WHERE id = '$f_id'");
    header("Location: dashboard.php?view=faculty");
}

// Get custom header and footer from settings
$header_image = '../header-image.png';
$footer_image = '../footer-image.png';
$header_result = $conn->query("SELECT setting_value FROM settings WHERE setting_key = 'header_image_path'");
if ($header_result && $header_result->num_rows > 0) {
    $value = $header_result->fetch_assoc()['setting_value'];
    if (!empty($value)) {
        $header_image = '../' . $value;
    }
}
$footer_result = $conn->query("SELECT setting_value FROM settings WHERE setting_key = 'footer_image_path'");
if ($footer_result && $footer_result->num_rows > 0) {
    $value = $footer_result->fetch_assoc()['setting_value'];
    if (!empty($value)) {
        $footer_image = '../' . $value;
    }
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
        <a href="dashboard.php?view=settings" class="tab-link <?php echo $view == 'settings' ? 'active' : ''; ?> flex-1 pb-3 px-6 font-bold text-sm rounded-lg transition-all <?php echo $view == 'settings' ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100'; ?>">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Settings
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

    <?php elseif ($view == 'faculty'): ?>
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
    
    <?php elseif ($view == 'settings'): ?>
        <!-- Settings View -->
        <div class="dashboard-card">
            <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-bold"><?php echo htmlspecialchars($_GET['message'] ?? 'Settings updated successfully!'); ?></span>
            </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-bold"><?php echo htmlspecialchars($_GET['message'] ?? 'Error updating settings'); ?></span>
            </div>
            <?php endif; ?>
            
            <div class="bg-white rounded-xl shadow-lg border-2 border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">Evaluation Form Customization</h2>
                            <p class="text-indigo-100 text-sm">Upload custom header and footer images for your evaluation forms</p>
                        </div>
                    </div>
                </div>
                
                <form action="dashboard.php" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    <!-- Header Image Upload -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border-2 border-indigo-200">
                        <label class="flex items-center gap-3 text-gray-800 font-bold text-lg mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            Header Image
                        </label>
                        <p class="text-sm text-gray-600 mb-3">Upload an image to display at the top of evaluation forms (recommended: 1200x200px, PNG or JPG)</p>
                        
                        <div class="mb-4">
                            <label class="block w-full cursor-pointer">
                                <div class="flex items-center justify-center w-full h-32 px-4 transition bg-white border-2 border-indigo-300 border-dashed rounded-lg appearance-none hover:border-indigo-400 focus:outline-none">
                                    <span class="flex items-center space-x-2">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <span class="font-medium text-indigo-600">
                                            Click to upload header image
                                        </span>
                                    </span>
                                </div>
                                <input type="file" name="header_image" class="hidden" accept="image/png,image/jpeg,image/jpg,image/gif" onchange="previewImage(this, 'headerPreview')">
                            </label>
                        </div>
                        
                        <div id="headerPreview" class="mt-3">
                            <?php if (file_exists($header_image)): ?>
                            <p class="text-xs text-gray-600 mb-2 font-semibold">Current Header Image:</p>
                            <img src="<?php echo $header_image . '?' . time(); ?>" alt="Current Header" class="w-full h-auto border-2 border-indigo-300 rounded-lg">
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Footer Image Upload -->
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-xl border-2 border-purple-200">
                        <label class="flex items-center gap-3 text-gray-800 font-bold text-lg mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            Footer Image
                        </label>
                        <p class="text-sm text-gray-600 mb-3">Upload an image to display at the bottom of evaluation forms (recommended: 1200x150px, PNG or JPG)</p>
                        
                        <div class="mb-4">
                            <label class="block w-full cursor-pointer">
                                <div class="flex items-center justify-center w-full h-32 px-4 transition bg-white border-2 border-purple-300 border-dashed rounded-lg appearance-none hover:border-purple-400 focus:outline-none">
                                    <span class="flex items-center space-x-2">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <span class="font-medium text-purple-600">
                                            Click to upload footer image
                                        </span>
                                    </span>
                                </div>
                                <input type="file" name="footer_image" class="hidden" accept="image/png,image/jpeg,image/jpg,image/gif" onchange="previewImage(this, 'footerPreview')">
                            </label>
                        </div>
                        
                        <div id="footerPreview" class="mt-3">
                            <?php if (file_exists($footer_image)): ?>
                            <p class="text-xs text-gray-600 mb-2 font-semibold">Current Footer Image:</p>
                            <img src="<?php echo $footer_image . '?' . time(); ?>" alt="Current Footer" class="w-full h-auto border-2 border-purple-300 rounded-lg">
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-4 pt-4 border-t-2 border-gray-200">
                        <button 
                            type="button" 
                            onclick="window.location.href='dashboard.php?view=evaluations'" 
                            class="px-8 py-3 text-gray-700 font-bold hover:bg-gray-100 rounded-lg transition-all border-2 border-gray-300 hover:border-gray-400">
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            name="update_images"
                            class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-8 py-3 rounded-lg font-bold hover:shadow-xl transition-all flex items-center gap-2 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            Upload Images
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Info Section -->
            <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-bold text-blue-900 mb-2">Important Information:</h4>
                        <ul class="text-sm text-blue-800 space-y-1 list-disc list-inside">
                            <li>Images should be in PNG, JPG, or GIF format</li>
                            <li>Recommended header size: 1200x200 pixels (wide banner)</li>
                            <li>Recommended footer size: 1200x150 pixels</li>
                            <li>Files will be saved as header-image.png and footer-image.png</li>
                            <li>New uploads will replace existing images</li>
                            <li>These images appear on all evaluation forms</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <p class="text-xs text-gray-600 mb-2 font-semibold">Preview of selected image:</p>
                <img src="${e.target.result}" alt="Preview" class="w-full h-auto border-2 border-green-400 rounded-lg shadow-lg">
            `;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

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