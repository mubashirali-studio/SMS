<?php
include(__DIR__ . '/../../database/db.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    die("No fee record ID provided.");
}

$stmt = $conn->prepare("SELECT fees.*, students.name AS student_name 
                         FROM fees JOIN students ON fees.student_id = students.id 
                         WHERE fees.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$fee = $stmt->get_result()->fetch_assoc();

if (!$fee) {
    die("Fee record not found.");
}

$balance = $fee['amount_due'] - $fee['amount_paid'];
?>

<div class="d-flex justify-content-center">
    <div class="card shadow-sm" style="width: 100%; max-width: 500px;">
        <div class="card-body p-4">
            <h3 class="mb-4">Record Payment</h3>
            <p><strong>Student:</strong> <?= htmlspecialchars($fee['student_name']) ?></p>
            <p><strong>Fee:</strong> <?= htmlspecialchars($fee['fee_type']) ?> — <?= htmlspecialchars($fee['month']) ?></p>
            <p><strong>Amount Due:</strong> <?= htmlspecialchars($fee['amount_due']) ?></p>
            <p><strong>Already Paid:</strong> <?= htmlspecialchars($fee['amount_paid']) ?></p>
            <p><strong>Balance Remaining:</strong> <?= htmlspecialchars($balance) ?></p>

            <form method="POST" action="/Website/SMS/database/requests.php">
                <input type="hidden" name="fee_id" value="<?= $fee['id'] ?>">

                <div class="mb-3">
                    <label for="payment_amount" class="form-label">Payment Amount</label>
                    <input type="number" class="form-control" id="payment_amount" name="payment_amount" min="1" max="<?= $balance ?>" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="record_payment" class="btn btn-success">Record Payment</button>
                    <a href="?fees=true" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>