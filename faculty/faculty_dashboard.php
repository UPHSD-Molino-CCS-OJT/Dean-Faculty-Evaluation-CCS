<?php
session_start();

// 1. Security Check
if (!isset($_SESSION['faculty_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

// 2. Database Connection
require_once __DIR__ . '/../includes/config.php';

// 3. Get faculty information
$faculty_id = $_SESSION['faculty_id'];
$faculty_name = $_SESSION['faculty_name'];

// Pagination Settings
$records_per_page = 10;
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($current_page - 1) * $records_per_page;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Portal - CCS Faculty Evaluation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,600;0,700;1,700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .nav-gradient { 
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f0fdfa 100%);
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
        .animate-slide-in {
            animation: slideInUp 0.5s ease-out;
        }
        .btn-logout {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(220, 38, 38, 0.3);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-teal-50 min-h-screen">

    <nav class="nav-gradient text-white shadow-2xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="uppercase">
                        <div class="font-black text-xl tracking-tight leading-tight">Faculty Portal</div>
                        <div class="font-medium text-teal-200 text-xs tracking-wide">College of Computer Studies</div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="faculty_signature.php" class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg font-bold text-sm transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        My Signature
                    </a>
                    <div class="text-right">
                        <div class="text-sm font-semibold"><?php echo htmlspecialchars($faculty_name); ?></div>
                        <div class="text-xs text-teal-200">Faculty Member</div>
                    </div>
                    <a href="faculty_logout.php" class="btn-logout px-5 py-2 rounded-lg font-bold text-sm shadow-lg flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="mb-8 animate-slide-in">
            <h1 class="text-4xl font-black text-gray-800 mb-2">Welcome, <?php echo htmlspecialchars(explode(' ', $faculty_name)[0]); ?>!</h1>
            <p class="text-gray-600">View your evaluation history and performance ratings.</p>
        </div>

        <?php
        // Get evaluation statistics
        $stats_query = "SELECT 
                            COUNT(*) as total_evaluations,
                            AVG(overall_rating) as avg_rating,
                            MAX(overall_rating) as highest_rating,
                            MIN(overall_rating) as lowest_rating
                        FROM evaluations 
                        WHERE faculty_name = '" . $conn->real_escape_string($faculty_name) . "'";
        $stats_result = $conn->query($stats_query);
        $stats = $stats_result->fetch_assoc();
        ?>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-slide-in">
            <div class="stat-card p-6 rounded-xl shadow-lg card-hover border-2 border-teal-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Evaluations</p>
                        <p class="text-3xl font-black text-teal-800 mt-2"><?php echo $stats['total_evaluations'] ?? 0; ?></p>
                    </div>
                    <div class="w-14 h-14 bg-teal-100 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card p-6 rounded-xl shadow-lg card-hover border-2 border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Average Rating</p>
                        <p class="text-3xl font-black text-blue-800 mt-2"><?php echo $stats['avg_rating'] ? number_format($stats['avg_rating'], 2) : 'N/A'; ?></p>
                    </div>
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card p-6 rounded-xl shadow-lg card-hover border-2 border-green-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Highest Rating</p>
                        <p class="text-3xl font-black text-green-800 mt-2"><?php echo $stats['highest_rating'] ? number_format($stats['highest_rating'], 2) : 'N/A'; ?></p>
                    </div>
                    <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card p-6 rounded-xl shadow-lg card-hover border-2 border-orange-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Lowest Rating</p>
                        <p class="text-3xl font-black text-orange-800 mt-2"><?php echo $stats['lowest_rating'] ? number_format($stats['lowest_rating'], 2) : 'N/A'; ?></p>
                    </div>
                    <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Evaluations Table -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200 animate-slide-in">
            <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Your Evaluation History
                </h2>
            </div>

            <?php
            // Get total count for pagination
            $count_query = "SELECT COUNT(*) as total FROM evaluations 
                           WHERE faculty_name = '" . $conn->real_escape_string($faculty_name) . "'";
            $count_result = $conn->query($count_query);
            $total_records = $count_result->fetch_assoc()['total'];
            $total_pages = ceil($total_records / $records_per_page);
            
            // Get all evaluations for this faculty member with pagination
            $eval_query = "SELECT * FROM evaluations 
                          WHERE faculty_name = '" . $conn->real_escape_string($faculty_name) . "' 
                          ORDER BY date_submitted DESC 
                          LIMIT $records_per_page OFFSET $offset";
            $eval_result = $conn->query($eval_query);

            if ($eval_result->num_rows > 0):
            ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Semester</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">School Year</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Total Units</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Overall Rating</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date Submitted</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php while($row = $eval_result->fetch_assoc()): ?>
                        <tr class="hover:bg-teal-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-teal-100 text-teal-800">
                                    <?php echo htmlspecialchars($row['semester']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                                <?php echo htmlspecialchars($row['school_year']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <?php echo htmlspecialchars($row['total_units']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php 
                                $rating = $row['overall_rating'];
                                $color = $rating >= 4.5 ? 'green' : ($rating >= 4.0 ? 'blue' : ($rating >= 3.5 ? 'yellow' : 'red'));
                                ?>
                                <span class="px-3 py-1 inline-flex text-sm font-black rounded-lg bg-<?php echo $color; ?>-100 text-<?php echo $color; ?>-800">
                                    <?php echo number_format($rating, 2); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <?php echo date('M d, Y', strtotime($row['date_submitted'])); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="faculty_view_evaluation.php?id=<?php echo $row['id']; ?>" 
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold rounded-lg shadow transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Details
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Controls -->
            <?php if ($total_pages > 1): ?>
            <div class="px-6 py-4 bg-gray-50 border-t-2 border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Showing <span class="font-bold text-gray-900"><?php echo $offset + 1; ?></span> to 
                        <span class="font-bold text-gray-900"><?php echo min($offset + $records_per_page, $total_records); ?></span> of 
                        <span class="font-bold text-gray-900"><?php echo $total_records; ?></span> evaluations
                    </div>
                    <div class="flex items-center gap-2">
                        <?php if ($current_page > 1): ?>
                        <a href="faculty_dashboard.php?page=<?php echo $current_page - 1; ?>" 
                           class="px-4 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-700 font-bold hover:bg-gray-100 hover:border-teal-500 transition flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Previous
                        </a>
                        <?php endif; ?>
                        
                        <div class="flex gap-1">
                            <?php 
                            $start_page = max(1, $current_page - 2);
                            $end_page = min($total_pages, $current_page + 2);
                            
                            if ($start_page > 1): ?>
                                <a href="faculty_dashboard.php?page=1" 
                                   class="px-4 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-700 font-bold hover:bg-gray-100 hover:border-teal-500 transition">1</a>
                                <?php if ($start_page > 2): ?>
                                <span class="px-3 py-2 text-gray-500">...</span>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <a href="faculty_dashboard.php?page=<?php echo $i; ?>" 
                                   class="px-4 py-2 rounded-lg font-bold transition <?php echo $i == $current_page ? 'bg-gradient-to-r from-teal-600 to-teal-700 text-white shadow-lg' : 'bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-100 hover:border-teal-500'; ?>">
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>
                            
                            <?php if ($end_page < $total_pages): ?>
                                <?php if ($end_page < $total_pages - 1): ?>
                                <span class="px-3 py-2 text-gray-500">...</span>
                                <?php endif; ?>
                                <a href="faculty_dashboard.php?page=<?php echo $total_pages; ?>" 
                                   class="px-4 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-700 font-bold hover:bg-gray-100 hover:border-teal-500 transition"><?php echo $total_pages; ?></a>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($current_page < $total_pages): ?>
                        <a href="faculty_dashboard.php?page=<?php echo $current_page + 1; ?>" 
                           class="px-4 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-700 font-bold hover:bg-gray-100 hover:border-teal-500 transition flex items-center gap-1">
                            Next
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <?php else: ?>
            <div class="text-center py-16">
                <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-bold text-gray-600">No Evaluations Yet</h3>
                <p class="mt-2 text-gray-500">You don't have any evaluations in the system yet.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
