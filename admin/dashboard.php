<?php
include(__DIR__ . '/../database/db.php');

$totalStudents = $conn->query("SELECT COUNT(*) AS cnt FROM students")->fetch_assoc()['cnt'];
$totalTeachers = $conn->query("SELECT COUNT(*) AS cnt FROM teachers")->fetch_assoc()['cnt'];
$totalClasses = $conn->query("SELECT COUNT(*) AS cnt FROM class")->fetch_assoc()['cnt'];
$totalSubjects = $conn->query("SELECT COUNT(*) AS cnt FROM subjects")->fetch_assoc()['cnt'];

$feeStats = $conn->query("SELECT SUM(amount_paid) AS collected, SUM(amount_due - amount_paid) AS pending FROM fees")->fetch_assoc();
$totalCollected = $feeStats['collected'] ?? 0;
$totalPending = $feeStats['pending'] ?? 0;

$classBreakdown = $conn->query("SELECT class.name, COUNT(students.id) AS student_count 
                                 FROM class 
                                 LEFT JOIN students ON students.classno = class.id 
                                 GROUP BY class.id, class.name 
                                 ORDER BY class.id")->fetch_all(MYSQLI_ASSOC);

$recentStudents = $conn->query("SELECT id, name, classno, `add-date` FROM students ORDER BY id DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);
?>

<h3 class="mb-4">Dashboard</h3>

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Students</h6>
                <h3><?= $totalStudents ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Teachers</h6>
                <h3><?= $totalTeachers ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Classes</h6>
                <h3><?= $totalClasses ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Subjects</h6>
                <h3><?= $totalSubjects ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="card text-center shadow-sm border-success">
            <div class="card-body">
                <h6 class="text-muted">Fees Collected</h6>
                <h3 class="text-success">Rs. <?= number_format($totalCollected) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card text-center shadow-sm border-danger">
            <div class="card-body">
                <h6 class="text-muted">Fees Pending</h6>
                <h3 class="text-danger">Rs. <?= number_format($totalPending) ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm">
            <div class="card-header">Students per Class</div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <?php foreach ($classBreakdown as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars(ucfirst($row['name'])) ?></td>
                            <td class="text-end"><?= $row['student_count'] ?> students</td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card shadow-sm">
            <div class="card-header">Recently Added Students</div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <?php foreach ($recentStudents as $s): ?>
                        <tr>
                            <td><?= htmlspecialchars($s['name']) ?></td>
                            <td><?= htmlspecialchars($s['add-date']) ?></td>
                            <td class="text-end"><a href="?view=true&id=<?= $s['id'] ?>" class="btn btn-sm btn-info">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>