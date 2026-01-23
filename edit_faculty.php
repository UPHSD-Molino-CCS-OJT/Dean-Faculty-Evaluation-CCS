<?php 
include 'header.php'; 

// Get Faculty ID from URL
if (!isset($_GET['id'])) {
    header("Location: dashboard.php?view=faculty");
    exit();
}

$id = $conn->real_escape_string($_GET['id']);
$sql = "SELECT * FROM faculty WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Faculty member not found.";
    exit();
}

$faculty = $result->fetch_assoc();

// Handle Update Logic
if (isset($_POST['update_faculty'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $dept = $conn->real_escape_string($_POST['department']);
    $status = $conn->real_escape_string($_POST['status']);

    $update_sql = "UPDATE faculty SET name='$name', department='$dept', status='$status' WHERE id='$id'";
    
    if ($conn->query($update_sql)) {
        echo "<script>alert('Faculty updated successfully!'); window.location='dashboard.php?view=faculty';</script>";
    } else {
        $error = "Error updating record: " . $conn->error;
    }
}
?>

<div class="max-w-2xl mx-auto p-10">
    <div class="bg-white rounded-2xl shadow-2xl border-2 border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-8">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-white font-bold text-2xl">Modify Faculty Information</h2>
                    <p class="text-blue-100 text-sm">Update details for Faculty ID #<?php echo $id; ?></p>
                </div>
            </div>
        </div>

        <form method="POST" class="p-8 space-y-6">
            <?php if(isset($error)): ?>
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg text-sm flex items-center animate-pulse">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <div>
                <label class="block text-xs font-black uppercase text-gray-700 mb-3 tracking-wide">Full Name</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($faculty['name']); ?>" 
                           required class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 outline-none transition shadow-sm">
                </div>
            </div>

            <div>
                <label class="block text-xs font-black uppercase text-gray-700 mb-3 tracking-wide">Department / College</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <input type="text" name="department" value="<?php echo htmlspecialchars($faculty['department']); ?>" 
                           class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 outline-none transition shadow-sm">
                </div>
            </div>

            <div>
                <label class="block text-xs font-black uppercase text-gray-700 mb-3 tracking-wide">Employment Status</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <select name="status" class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 outline-none transition shadow-sm appearance-none bg-white">
                        <option value="active" <?php echo $faculty['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                        <option value="inactive" <?php echo $faculty['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive / Resigned</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-6 border-t-2 border-gray-200">
                <a href="dashboard.php?view=faculty" class="text-gray-600 font-bold hover:text-gray-800 transition flex items-center gap-2 group">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
                <button type="submit" name="update_faculty" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-3 rounded-xl font-bold hover:shadow-lg transition-all flex items-center gap-2 group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Faculty Record
                </button>
            </div>
        </form>
    </div>
</div>