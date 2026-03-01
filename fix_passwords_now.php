<?php
// Quick Password Fix - Direct Execution
require_once __DIR__ . '/includes/config.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Password Fix</title>
    <script src='https://cdn.tailwindcss.com'></script>
</head>
<body class='bg-gray-100 p-8'>
<div class='max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8'>";

echo "<h1 class='text-2xl font-bold mb-4'>Faculty Password Reset</h1>";

// Check current faculty users
echo "<h2 class='text-xl font-bold mt-6 mb-3'>Current Faculty Accounts:</h2>";
$check = $conn->query("SELECT id, username, full_name, role, password FROM users WHERE role='faculty'");

if ($check && $check->num_rows > 0) {
    echo "<table class='w-full border mb-6'>";
    echo "<tr class='bg-gray-100'><th class='border p-2'>ID</th><th class='border p-2'>Username</th><th class='border p-2'>Name</th><th class='border p-2'>Password Hash</th></tr>";
    while ($row = $check->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='border p-2'>" . $row['id'] . "</td>";
        echo "<td class='border p-2'>" . $row['username'] . "</td>";
        echo "<td class='border p-2'>" . ($row['full_name'] ?? 'N/A') . "</td>";
        echo "<td class='border p-2 text-xs'>" . substr($row['password'], 0, 30) . "...</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p class='text-red-600 mb-6'>No faculty accounts found!</p>";
}

// Fix passwords
echo "<h2 class='text-xl font-bold mt-6 mb-3'>Resetting Passwords...</h2>";

$new_password = 'faculty123';
$new_hash = password_hash($new_password, PASSWORD_DEFAULT);

echo "<p class='mb-4'>New password hash: <code class='bg-gray-200 p-1'>" . substr($new_hash, 0, 50) . "...</code></p>";

// Update passwords
$update_sql = "UPDATE users SET password = ? WHERE role = 'faculty'";
$stmt = $conn->prepare($update_sql);
$stmt->bind_param("s", $new_hash);

if ($stmt->execute()) {
    $affected = $stmt->affected_rows;
    echo "<div class='bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-4'>";
    echo "<strong>✓ Success!</strong> Updated $affected faculty account(s)";
    echo "</div>";
} else {
    echo "<div class='bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4'>";
    echo "<strong>✗ Error:</strong> " . $stmt->error;
    echo "</div>";
}

// Test password verification
echo "<h2 class='text-xl font-bold mt-6 mb-3'>Verification Test:</h2>";
$test = $conn->query("SELECT username, password FROM users WHERE role='faculty' LIMIT 1");
if ($test && $test->num_rows > 0) {
    $row = $test->fetch_assoc();
    $test_verify = password_verify('faculty123', $row['password']);
    
    echo "<div class='bg-blue-100 border border-blue-400 text-blue-700 p-4 rounded mb-4'>";
    echo "<strong>Test Account:</strong> " . $row['username'] . "<br>";
    echo "<strong>Password 'faculty123' verification:</strong> " . ($test_verify ? "<span class='text-green-600 font-bold'>✓ PASS</span>" : "<span class='text-red-600 font-bold'>✗ FAIL</span>");
    echo "</div>";
}

echo "<div class='mt-6 space-x-4'>";
echo "<a href='login.php' class='bg-teal-500 text-white px-6 py-3 rounded-lg inline-block hover:bg-teal-600'>Go to Login Page</a>";
echo "<a href='admin/dashboard.php' class='bg-blue-500 text-white px-6 py-3 rounded-lg inline-block hover:bg-blue-600'>Go to Dashboard</a>";
echo "</div>";

echo "</div></body></html>";

$conn->close();
?>
