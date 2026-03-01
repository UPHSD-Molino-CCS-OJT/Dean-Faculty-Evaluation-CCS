<?php
/**
 * Cleanup Orphaned Signature Files
 * 
 * This script identifies and removes signature image files that are no longer
 * referenced in the database, helping to free up storage space.
 */

require_once __DIR__ . '/includes/config.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Cleanup Orphaned Signatures</title>
    <script src='https://cdn.tailwindcss.com'></script>
</head>
<body class='bg-gray-100 p-8'>
<div class='max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8'>";

echo "<h1 class='text-2xl font-bold mb-6 text-gray-800'>🧹 Signature Storage Cleanup</h1>";

$signatures_dir = "signatures/";

if (!file_exists($signatures_dir)) {
    echo "<p class='text-yellow-600'>Signatures directory does not exist.</p>";
    echo "</div></body></html>";
    exit();
}

// Get all signature files in the directory
$files_in_directory = glob($signatures_dir . "*.{jpg,jpeg,png}", GLOB_BRACE);

if (empty($files_in_directory)) {
    echo "<p class='text-gray-600'>No signature files found in the signatures directory.</p>";
    echo "</div></body></html>";
    exit();
}

// Get all signature paths referenced in database
$referenced_files = [];

// From evaluations table (dean and faculty signatures)
$result1 = $conn->query("SELECT DISTINCT dean_signature_path FROM evaluations WHERE dean_signature_path IS NOT NULL");
if ($result1) {
    while ($row = $result1->fetch_assoc()) {
        $referenced_files[] = $row['dean_signature_path'];
    }
}

$result2 = $conn->query("SELECT DISTINCT faculty_signature_path FROM evaluations WHERE faculty_signature_path IS NOT NULL");
if ($result2) {
    while ($row = $result2->fetch_assoc()) {
        $referenced_files[] = $row['faculty_signature_path'];
    }
}

// From settings table (current dean signature)
$result3 = $conn->query("SELECT setting_value FROM settings WHERE setting_key = 'dean_signature_path' AND setting_value IS NOT NULL");
if ($result3 && $result3->num_rows > 0) {
    $row = $result3->fetch_assoc();
    if ($row['setting_value']) {
        $referenced_files[] = $row['setting_value'];
    }
}

// From faculty table (legacy faculty signatures if any)
$result4 = $conn->query("SELECT DISTINCT signature_path FROM faculty WHERE signature_path IS NOT NULL");
if ($result4) {
    while ($row = $result4->fetch_assoc()) {
        $referenced_files[] = $row['signature_path'];
    }
}

$referenced_files = array_unique($referenced_files);

echo "<div class='mb-6'>";
echo "<h2 class='text-lg font-bold mb-3'>📊 Analysis</h2>";
echo "<div class='grid grid-cols-2 gap-4'>";
echo "<div class='bg-blue-50 p-4 rounded border border-blue-200'>";
echo "<p class='text-sm text-gray-600'>Files in Directory</p>";
echo "<p class='text-3xl font-bold text-blue-800'>" . count($files_in_directory) . "</p>";
echo "</div>";
echo "<div class='bg-green-50 p-4 rounded border border-green-200'>";
echo "<p class='text-sm text-gray-600'>Referenced in Database</p>";
echo "<p class='text-3xl font-bold text-green-800'>" . count($referenced_files) . "</p>";
echo "</div>";
echo "</div>";
echo "</div>";

// Find orphaned files
$orphaned_files = [];
$total_size = 0;

foreach ($files_in_directory as $file_path) {
    $relative_path = str_replace("\\", "/", $file_path);
    $is_referenced = false;
    
    foreach ($referenced_files as $ref) {
        if (str_replace("\\", "/", $ref) === $relative_path) {
            $is_referenced = true;
            break;
        }
    }
    
    if (!$is_referenced) {
        $orphaned_files[] = $file_path;
        $total_size += filesize($file_path);
    }
}

if (empty($orphaned_files)) {
    echo "<div class='bg-green-100 border border-green-400 text-green-700 p-4 rounded'>";
    echo "✓ <strong>All clean!</strong> No orphaned files found. All signature files are properly referenced.";
    echo "</div>";
} else {
    echo "<div class='bg-yellow-50 border border-yellow-400 text-yellow-800 p-4 rounded mb-6'>";
    echo "<strong>⚠️ Found " . count($orphaned_files) . " orphaned file(s)</strong><br>";
    echo "Total wasted space: <strong>" . number_format($total_size / 1024, 2) . " KB</strong>";
    echo "</div>";
    
    if (isset($_POST['cleanup'])) {
        echo "<h2 class='text-lg font-bold mb-3 mt-6'>🗑️ Cleanup Results</h2>";
        $deleted_count = 0;
        $deleted_size = 0;
        
        foreach ($orphaned_files as $file) {
            $size = filesize($file);
            if (unlink($file)) {
                $deleted_count++;
                $deleted_size += $size;
                echo "<p class='text-sm text-green-600'>✓ Deleted: " . basename($file) . " (" . number_format($size / 1024, 2) . " KB)</p>";
            } else {
                echo "<p class='text-sm text-red-600'>✗ Failed to delete: " . basename($file) . "</p>";
            }
        }
        
        echo "<div class='bg-green-100 border border-green-400 text-green-700 p-4 rounded mt-4'>";
        echo "<strong>✓ Cleanup complete!</strong><br>";
        echo "Deleted $deleted_count file(s), freed " . number_format($deleted_size / 1024, 2) . " KB of storage.";
        echo "</div>";
    } else {
        echo "<h2 class='text-lg font-bold mb-3 mt-6'>📝 Orphaned Files</h2>";
        echo "<div class='bg-gray-50 p-4 rounded border border-gray-300 mb-4 max-h-64 overflow-y-auto'>";
        foreach ($orphaned_files as $file) {
            echo "<p class='text-sm text-gray-700'>• " . basename($file) . " (" . number_format(filesize($file) / 1024, 2) . " KB)</p>";
        }
        echo "</div>";
        
        echo "<form method='POST'>";
        echo "<button type='submit' name='cleanup' class='bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition'>";
        echo "🗑️ Delete All Orphaned Files";
        echo "</button>";
        echo "</form>";
        
        echo "<p class='text-xs text-gray-500 mt-3'>This will permanently delete files that are not referenced in the database.</p>";
    }
}

echo "<div class='mt-8 pt-6 border-t'>";
echo "<h2 class='text-lg font-bold mb-3'>ℹ️ About Deduplication</h2>";
echo "<p class='text-sm text-gray-600 mb-2'>This system uses hash-based storage to prevent duplicate images:</p>";
echo "<ul class='text-sm text-gray-600 list-disc list-inside space-y-1'>";
echo "<li>Files are stored with names based on their content hash (MD5)</li>";
echo "<li>Identical images share the same file, saving storage space</li>";
echo "<li>Multiple evaluations can reference the same signature file</li>";
echo "<li>Files are only deleted when no longer referenced anywhere</li>";
echo "</ul>";
echo "</div>";

echo "<div class='mt-6 flex gap-4'>";
echo "<a href='admin/dashboard.php' class='bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded transition'>← Back to Dashboard</a>";
echo "<a href='cleanup_orphaned_signatures.php' class='bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition'>🔄 Refresh Analysis</a>";
echo "</div>";

echo "</div></body></html>";

$conn->close();
?>
