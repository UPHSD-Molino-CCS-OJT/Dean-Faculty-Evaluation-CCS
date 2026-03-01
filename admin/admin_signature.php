<?php
session_start();

// Security Check
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

// Database Connection
require_once __DIR__ . '/../includes/config.php';

$message = "";
$message_type = "";

// Handle signature upload
if (isset($_POST['upload_signature'])) {
    $target_dir = "../signatures/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $file_extension = strtolower(pathinfo($_FILES["signature_file"]["name"], PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["signature_file"]["tmp_name"]);
    
    if($check !== false && in_array($file_extension, ['png', 'jpg', 'jpeg'])) {
        if ($_FILES["signature_file"]["size"] < 2000000) {
            // Generate hash for deduplication
            $file_hash = md5_file($_FILES["signature_file"]["tmp_name"]);
            $hash_filename = "sig_" . $file_hash . "." . $file_extension;
            $target_file = $target_dir . $hash_filename;
            
            // Only save if doesn't exist
            if (!file_exists($target_file)) {
                move_uploaded_file($_FILES["signature_file"]["tmp_name"], $target_file);
            }
            
            // Save to settings
            $sig_path = "signatures/" . $hash_filename;
            $sign_date = date('Y-m-d');
            
            $update1 = "UPDATE settings SET setting_value = '" . $conn->real_escape_string($sig_path) . "' WHERE setting_key = 'dean_signature_path'";
            $update2 = "UPDATE settings SET setting_value = '" . $sign_date . "' WHERE setting_key = 'dean_signature_date'";
            
            if ($conn->query($update1) && $conn->query($update2)) {
                $message = "Dean signature uploaded successfully! It will be applied to all new evaluations.";
                $message_type = "success";
            } else {
                $message = "Error updating signature: " . $conn->error;
                $message_type = "error";
            }
        } else {
            $message = "File is too large. Maximum size is 2MB.";
            $message_type = "error";
        }
    } else {
        $message = "Invalid file type. Please upload PNG or JPEG images only.";
        $message_type = "error";
    }
}

// Handle signature removal
if (isset($_POST['remove_signature'])) {
    $sig_sql = "SELECT setting_value FROM settings WHERE setting_key = 'dean_signature_path'";
    $sig_result = $conn->query($sig_sql);
    if ($sig_result && $sig_result->num_rows > 0) {
        $sig_row = $sig_result->fetch_assoc();
        if ($sig_row['setting_value']) {
            $file_path = $sig_row['setting_value'];
            
            // Clear from settings
            $conn->query("UPDATE settings SET setting_value = NULL WHERE setting_key = 'dean_signature_path'");
            $conn->query("UPDATE settings SET setting_value = NULL WHERE setting_key = 'dean_signature_date'");
            
            // Check if file is still used elsewhere
            $usage_check = $conn->query("SELECT COUNT(*) as count FROM evaluations WHERE 
                dean_signature_path = '" . $conn->real_escape_string($file_path) . "' OR 
                faculty_signature_path = '" . $conn->real_escape_string($file_path) . "'");
            $usage = $usage_check->fetch_assoc();
            
            if ($usage['count'] == 0) {
                $file_to_delete = '../' . $file_path;
                if (file_exists($file_to_delete)) {
                    unlink($file_to_delete);
                }
            }
            
            $message = "Dean signature removed successfully.";
            $message_type = "success";
        }
    }
}

// Fetch current signature
$signature_path = null;
$signature_date = null;
$sig_sql = "SELECT setting_key, setting_value FROM settings WHERE setting_key IN ('dean_signature_path', 'dean_signature_date')";
$sig_result = $conn->query($sig_sql);
if ($sig_result) {
    while($row = $sig_result->fetch_assoc()) {
        if ($row['setting_key'] == 'dean_signature_path') {
            $signature_path = $row['setting_value'];
        }
        if ($row['setting_key'] == 'dean_signature_date') {
            $signature_date = $row['setting_value'];
        }
    }
}

// Count evaluations using this signature
$usage_count = 0;
if ($signature_path) {
    $usage_sql = "SELECT COUNT(*) as count FROM evaluations WHERE dean_signature_path = '" . $conn->real_escape_string($signature_path) . "'";
    $usage_result = $conn->query($usage_sql);
    if ($usage_result) {
        $usage_row = $usage_result->fetch_assoc();
        $usage_count = $usage_row['count'];
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dean E-Signature - Admin Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .nav-gradient { 
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-purple-50 min-h-screen">

    <nav class="nav-gradient text-white shadow-2xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </div>
                    <div class="uppercase">
                        <div class="font-black text-xl tracking-tight leading-tight">Dean E-Signature</div>
                        <div class="font-medium text-purple-200 text-xs tracking-wide">Admin Portal</div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="dashboard.php" class="px-5 py-2 bg-white/20 hover:bg-white/30 rounded-lg font-bold text-sm transition">
                        ← Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-6 py-8">
        
        <?php if ($message): ?>
            <div class="mb-6 p-4 rounded-lg border-2 <?php echo $message_type === 'success' ? 'bg-green-50 border-green-500 text-green-800' : 'bg-red-50 border-red-500 text-red-800'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-8 py-6">
                <h1 class="text-3xl font-black text-white">Dean E-Signature Management</h1>
                <p class="text-purple-100 mt-2">Upload your signature once and it will be applied to all new evaluations</p>
            </div>

            <div class="p-8">
                <div class="grid md:grid-cols-2 gap-8">
                    
                    <!-- Signature Preview -->
                    <div>
                        <h2 class="text-xl font-bold mb-4 text-gray-800">Current Dean Signature</h2>
                        <div class="border-4 border-gray-200 rounded-lg p-6 bg-gray-50 flex items-center justify-center min-h-[200px]">
                            <?php if ($signature_path && file_exists('../' . $signature_path)): ?>
                                <div class="text-center">
                                    <img src="../<?php echo htmlspecialchars($signature_path); ?>" alt="Dean Signature" class="max-h-32 mx-auto mb-4">
                                    <p class="text-sm text-gray-600">Uploaded: <?php echo date('F d, Y', strtotime($signature_date)); ?></p>
                                    <?php if ($usage_count > 0): ?>
                                        <p class="text-xs text-purple-600 font-semibold mt-2">✓ Applied to <?php echo $usage_count; ?> evaluation(s)</p>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center text-gray-400">
                                    <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="font-medium">No dean signature uploaded yet</p>
                                    <p class="text-xs mt-1">Upload dean signature to automatically sign new evaluations</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($signature_path): ?>
                            <form method="POST" class="mt-4">
                                <button type="submit" name="remove_signature" onclick="return confirm('Remove dean signature? This will not affect already-signed evaluations.')" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition">
                                    🗑️ Remove Signature
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <!-- Upload Form -->
                    <div>
                        <h2 class="text-xl font-bold mb-4 text-gray-800"><?php echo $signature_path ? 'Update' : 'Upload'; ?> Signature</h2>
                        <form method="POST" enctype="multipart/form-data" class="space-y-4">
                            <div class="border-4 border-dashed border-purple-200 rounded-lg p-6 bg-purple-50">
                                <label class="block">
                                    <span class="text-sm font-semibold text-gray-700 mb-2 block">Select Image File</span>
                                    <input type="file" name="signature_file" accept="image/png,image/jpeg,image/jpg" required class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700 cursor-pointer">
                                </label>
                            </div>

                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h3 class="font-bold text-blue-900 mb-2">📌 Guidelines:</h3>
                                <ul class="text-sm text-blue-800 space-y-1">
                                    <li>• <strong>Format:</strong> PNG or JPEG images only</li>
                                    <li>• <strong>Size:</strong> Maximum 2MB</li>
                                    <li>• <strong>Background:</strong> Transparent or white recommended</li>
                                    <li>• <strong>Quality:</strong> Clear and legible signature</li>
                                </ul>
                            </div>

                            <button type="submit" name="upload_signature" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-4 px-6 rounded-lg transition shadow-lg flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <?php echo $signature_path ? 'Update Dean Signature' : 'Upload & Save'; ?>
                            </button>
                        </form>

                        <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-2">ℹ️ How It Works</h3>
                            <ol class="text-sm text-gray-700 space-y-1 list-decimal list-inside">
                                <li>Upload the dean's signature here once</li>
                                <li>Signature is saved to system settings</li>
                                <li>Automatically applied to all new evaluations</li>
                                <li>Each evaluation keeps its own signed copy</li>
                                <li>Updating here won't affect already-signed evaluations</li>
                            </ol>
                        </div>

                        <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <h3 class="font-bold text-yellow-900 mb-2">⚠️ Important</h3>
                            <p class="text-sm text-yellow-800">This signature represents <strong>MS. MARIBEL SANDAGON</strong>, Dean of the College of Computer Studies. Ensure you have proper authorization before uploading or changing this signature.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
