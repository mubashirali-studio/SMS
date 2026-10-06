<?php
include_once __DIR__ . '/../database/db.php';

$student_id = 34; // TEMP: replace with (int) $_SESSION['student_id'] after login

// student name for the heading
$result = mysqli_query($conn, "SELECT name FROM students WHERE id = $student_id");
$student = mysqli_fetch_assoc($result);

if (!$student) {
    echo '<div class="container mt-4"><div class="alert alert-danger">Student not found.</div></div>';
    return;
}

// all fees of this student, newest first
$result = mysqli_query($conn, "SELECT * FROM fees WHERE student_id = $student_id ORDER BY due_date DESC");

$fees = array();
$total_due = 0;
$total_paid = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $fees[] = $row;
    $total_due = $total_due + $row['amount_due'];
    $total_paid = $total_paid + $row['amount_paid'];
}

$balance = $total_due - $total_paid;
if ($balance < 0) {
    $balance = 0;
}
?>

<div class="container mt-4 mb-5">

    <div class="mb-4">
        <h3 class="fw-bold mb-1">Account Book</h3>
        <p class="text-muted mb-0">Fee record of <?php echo htmlspecialchars($student['name']); ?></p>
    </div>

    <!-- Summary boxes -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <div class="text-muted">Total Charged</div>
                    <div class="fs-3 fw-bold text-primary">Rs <?php echo number_format($total_due); ?></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <div class="text-muted">Total Paid</div>
                    <div class="fs-3 fw-bold text-success">Rs <?php echo number_format($total_paid); ?></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <div class="text-muted">Balance Due</div>
                    <div class="fs-3 fw-bold <?php echo ($balance > 0) ? 'text-danger' : 'text-success'; ?>">
                        Rs <?php echo number_format($balance); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fee list -->
    <?php if (count($fees) == 0) { ?>
        <div class="alert alert-info">No fee record found yet.</div>
    <?php } else { ?>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center mb-0">
                <tr class="table-dark">
                    <th class="text-start">Fee</th>
                    <th>Month</th>
                    <th>Due Date</th>
                    <th>Amount Due</th>
                    <th>Amount Paid</th>
                    <th>Balance</th>
                    <th>Paid On</th>
                    <th>Status</th>
                </tr>

                <?php foreach ($fees as $f) {

                    $row_balance = $f['amount_due'] - $f['amount_paid'];
                    if ($row_balance < 0) {
                        $row_balance = 0;
                    }

                    // work out the status
                    if ($f['amount_paid'] >= $f['amount_due']) {
                        $badge_class = 'bg-success';
                        $badge_text = 'Paid';
                    } else if (strtotime($f['due_date']) < time()) {
                        $badge_class = 'bg-danger';
                        $badge_text = 'Overdue';
                    } else if ($f['amount_paid'] > 0) {
                        $badge_class = 'bg-warning text-dark';
                        $badge_text = 'Partial';
                    } else {
                        $badge_class = 'bg-secondary';
                        $badge_text = 'Unpaid';
                    }
                ?>
                    <tr>
                        <td class="text-start"><?php echo htmlspecialchars($f['fee_type']); ?></td>
                        <td><?php echo htmlspecialchars($f['month']); ?></td>
                        <td><?php echo date('d M Y', strtotime($f['due_date'])); ?></td>
                        <td>Rs <?php echo number_format($f['amount_due']); ?></td>
                        <td>Rs <?php echo number_format($f['amount_paid']); ?></td>
                        <td>Rs <?php echo number_format($row_balance); ?></td>
                        <td>
                            <?php if ($f['paid_date'] != '') {
                                echo date('d M Y', strtotime($f['paid_date']));
                            } else {
                                echo '-';
                            } ?>
                        </td>
                        <td><span class="badge <?php echo $badge_class; ?>"><?php echo $badge_text; ?></span></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <?php } ?>
</div>