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
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="bg-gray-800 p-6">
            <h2 class="text-white font-bold text-xl">Modify Faculty Information</h2>
            <p class="text-gray-400 text-xs">Update details for ID #<?php echo $id; ?></p>
        </div>

        <form method="POST" class="p-8 space-y-6">
            <?php if(isset($error)): ?>
                <div class="bg-red-100 text-red-700 p-3 rounded text-sm"><?php echo $error; ?></div>
            <?php endif; ?>

            <div>
                <label class="block text-xs font-black uppercase text-gray-500 mb-2">Full Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($faculty['name']); ?>" 
                       required class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-800 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-black uppercase text-gray-500 mb-2">Department / College</label>
                <input type="text" name="department" value="<?php echo htmlspecialchars($faculty['department']); ?>" 
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-800 outline-none transition">
            </div>

            <div>
                <label class="block text-xs font-black uppercase text-gray-500 mb-2">Employment Status</label>
                <select name="status" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-800 outline-none transition">
                    <option value="active" <?php echo $faculty['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                    <option value="inactive" <?php echo $faculty['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive / Resigned</option>
                </select>
            </div>

            <div class="flex items-center justify-between pt-6 border-t">
                <a href="dashboard.php?view=faculty" class="text-gray-500 font-bold hover:text-gray-800 transition">
                    ← Back to List
                </a>
                <button type="submit" name="update_faculty" class="bg-red-800 text-white px-8 py-3 rounded-lg font-bold hover:bg-red-900 shadow-md transition">
                    Update Faculty Record
                </button>
            </div>
        </form>
    </div>
</div>