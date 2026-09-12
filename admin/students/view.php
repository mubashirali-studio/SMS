<?php
include('./database/db.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    die("No student ID provided.");
}

$stmt = $conn->prepare("SELECT * FROM students WHERE id = $id");
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    die("Student not found.");
}

// Look up section name, if one is assigned
$sectionName = "Not Assigned";
if (!empty($student['section_id'])) {
    $section_id = $student['section_id'] ?? null;
    $secStmt = $conn->prepare("SELECT section_name FROM sections WHERE id = $section_id");
    $secStmt->execute();
    $secResult = $secStmt->get_result()->fetch_assoc();
    if ($secResult) {
        $sectionName = $secResult['section_name'];
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Student Details</h3>
    <a href="?students=true" class="btn btn-secondary">&larr; Back to List</a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex align-items-center gap-3 py-3">

        <?php if (!empty($student['pic'])): ?>
            <img src="/Website/SMS/assets/uploads/students/<?= htmlspecialchars($student['pic']) ?>" 
                 alt="Student Photo" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
        <?php else: ?>
            <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: bold;">
                <?= strtoupper(substr($student['name'], 0, 1)) ?>
            </div>
        <?php endif; ?>

        <div>
            <h4 class="mb-0"><?= htmlspecialchars($student['name']) ?></h4>
            <small>Class <?= htmlspecialchars($student['classno']) ?> &middot; Section <?= htmlspecialchars($sectionName) ?> &middot; CNIC: <?= htmlspecialchars($student['cnic']) ?></small>
        </div>
    </div>

    <div class="card-body">

        <h6 class="text-primary text-uppercase mb-3">Personal Information</h6>
        <div class="row mb-4">
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Date of Birth</small><?= htmlspecialchars($student['dob']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Gender</small><?= htmlspecialchars($student['gender']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Blood Group</small><span class="badge bg-danger"><?= htmlspecialchars($student['bloodgrp']) ?></span></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Religion</small><?= htmlspecialchars($student['religion']) ?></div>
        </div>

        <hr>

        <h6 class="text-primary text-uppercase mb-3 mt-3">Admission Details</h6>
        <div class="row mb-4">
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Academic Year</small><?= htmlspecialchars($student['acad-year']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Admission Date</small><?= htmlspecialchars($student['add-date']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Previous School</small><?= htmlspecialchars($student['pre-scl']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Section</small><?= htmlspecialchars($sectionName) ?></div>
        </div>

        <hr>

        <h6 class="text-primary text-uppercase mb-3 mt-3">Parent / Guardian Information</h6>
        <div class="row mb-4">
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Father's Name</small><?= htmlspecialchars($student['father-name']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Mother's Name</small><?= htmlspecialchars($student['mother-name']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Guardian CNIC</small><?= htmlspecialchars($student['gurd-cnic']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Guardian Occupation</small><?= htmlspecialchars($student['gurd-ocp']) ?></div>
        </div>

        <hr>

        <h6 class="text-primary text-uppercase mb-3 mt-3">Contact Information</h6>
        <div class="row">
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Primary Contact</small><?= htmlspecialchars($student['prim-no']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Emergency Contact</small><?= htmlspecialchars($student['emg-no']) ?></div>
            <div class="col-md-8 mb-2"><small class="text-muted d-block">Address</small><?= htmlspecialchars($student['address']) ?></div>
        </div>

    </div>

    <div class="card-footer d-flex gap-2">
        <a href="?edit=true&id=<?= $student['id'] ?>" class="btn btn-warning btn-sm">Edit Student</a>
        <a href="?delete=true&id=<?= $student['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this student?')">Delete Student</a>
    </div>
</div>