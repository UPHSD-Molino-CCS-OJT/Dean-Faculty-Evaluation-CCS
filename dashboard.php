<?php 
include 'header.php'; 

// Fetch all evaluations sorted by latest
$sql = "SELECT * FROM evaluations ORDER BY date_submitted DESC";
$result = $conn->query($sql);
?>

<div class="max-w-7xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Faculty Evaluation Summaries</h2>
            <span class="text-sm text-gray-500">Total Records: <?php echo $result->num_rows; ?></span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                        <th class="p-4 border-b">Faculty Name</th>
                        <th class="p-4 border-b">Subject</th>
                        <th class="p-4 border-b text-center">Sec II (60%)</th>
                        <th class="p-4 border-b text-center">Total Points</th>
                        <th class="p-4 border-b text-center">Overall Rating</th>
                        <th class="p-4 border-b">Complaints?</th>
                        <th class="p-4 border-b">Date Submitted</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): 
                            $rating = $row['overall_rating'];
                            $badgeClass = $rating >= 4.5 ? 'bg-green-100 text-green-800' : ($rating >= 3.0 ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800');
                        ?>
                            <tr class="hover:bg-gray-50 border-b transition">
                                <td class="p-4 font-semibold text-gray-900"><?php echo $row['faculty_name']; ?></td>
                                <td class="p-4 text-gray-500"><?php echo $row['subject_handled']; ?></td>
                                <td class="p-4 text-center font-medium"><?php echo number_format($row['sec2_avg'], 2); ?></td>
                                <td class="p-4 text-center"><?php echo $row['total_points']; ?></td>
                                <td class="p-4 text-center">
                                    <span class="px-3 py-1 rounded-full font-bold <?php echo $badgeClass; ?>">
                                        <?php echo number_format($rating, 2); ?>
                                    </span>
                                </td>
                                <td class="p-4">
                                    <?php if($row['official_complaint'] == 'yes'): ?>
                                        <span class="text-red-600 font-bold">⚠️ Yes</span>
                                    <?php else: ?>
                                        <span class="text-gray-400">None</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 text-xs text-gray-400">
                                    <?php echo date('M d, Y', strtotime($row['date_submitted'])); ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="p-10 text-center text-gray-500 italic">No evaluations found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
<?php $conn->close(); ?>