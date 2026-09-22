<?php
include(__DIR__ . '/../../database/db.php');

$stmt = $conn->query("SELECT fees.*, students.name AS student_name 
                       FROM fees 
                       JOIN students ON fees.student_id = students.id 
                       ORDER BY fees.due_date DESC");
$fees = $stmt->fetch_all(MYSQLI_ASSOC);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Fees</h3>
    <div class="d-flex gap-2">
        <a href="?addfee=true" class="btn btn-primary">+ Add Fee Record</a>
        <a href="?genfees=true" class="btn btn-success" onclick="return confirm('Generate this month\'s tuition fees for all students?')">Generate Monthly Fees</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Fee Type</th>
                <th>Month</th>
                <th>Amount Due</th>
                <th>Amount Paid</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fees as $fee): ?>
                <?php
                    $balance = $fee['amount_due'] - $fee['amount_paid'];
                    if ($balance <= 0) {
                        $statusBadge = '<span class="badge bg-success">Paid</span>';
                    } elseif ($fee['amount_paid'] > 0) {
                        $statusBadge = '<span class="badge bg-warning text-dark">Partial</span>';
                    } else {
                        $statusBadge = '<span class="badge bg-danger">Unpaid</span>';
                    }
                ?>
                <tr>
                    <td><?= htmlspecialchars($fee['id']) ?></td>
                    <td><?= htmlspecialchars($fee['student_name']) ?></td>
                    <td><?= htmlspecialchars($fee['fee_type']) ?></td>
                    <td><?= htmlspecialchars($fee['month']) ?></td>
                    <td><?= htmlspecialchars($fee['amount_due']) ?></td>
                    <td><?= htmlspecialchars($fee['amount_paid']) ?></td>
                    <td><?= $statusBadge ?></td>
                    <td><?= htmlspecialchars($fee['due_date']) ?></td>
                    <td>
                        <a href="?payfee=true&id=<?= $fee['id'] ?>" class="btn btn-sm btn-success">Record Payment</a>
                        <a href="?delfee=true&id=<?= $fee['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this fee record?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>