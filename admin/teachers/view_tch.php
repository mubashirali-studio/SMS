<?php
include('database/db.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    die("No teacher ID provided.");
}

$stmt = $conn->prepare("SELECT * FROM teachers WHERE id = $id");
$stmt->execute();
$result = $stmt->get_result();
$teacher = $result->fetch_assoc();

if (!$teacher) {
    die("Teacher not found.");
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Teacher Details</h3>
    <a href="?teachers=true" class="btn btn-secondary">&larr; Back to List</a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex align-items-center gap-3 py-3">
        <?php if (!empty($teacher['photo'])): ?>
            <img src="<?= htmlspecialchars($teacher['photo']) ?>" alt="Teacher Photo" class="rounded-circle object-fit-cover" style="width: 60px; height: 60px;">
        <?php else: ?>
            <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: bold;">
                <?= strtoupper(substr($teacher['name'], 0, 1)) ?>
            </div>
        <?php endif; ?>
        <div>
            <h4 class="mb-0"><?= htmlspecialchars($teacher['name']) ?></h4>
            <small><?= htmlspecialchars($teacher['specialization']) ?> &middot; CNIC: <?= htmlspecialchars($teacher['cnic']) ?></small>
        </div>
    </div>

    <div class="card-body">

        <!-- Personal Information -->
        <h6 class="text-primary text-uppercase mb-3">Personal Information</h6>
        <div class="row mb-4">
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Date of Birth</small><?= htmlspecialchars($teacher['dob']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Gender</small><?= htmlspecialchars($teacher['gender']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">CNIC</small><?= htmlspecialchars($teacher['cnic']) ?></div>
        </div>

        <hr>

        <!-- Professional & Employment Details -->
        <h6 class="text-primary text-uppercase mb-3 mt-3">Professional & Employment Details</h6>
        <div class="row mb-4">
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Qualification</small><?= htmlspecialchars($teacher['qualification']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Specialization</small><?= htmlspecialchars($teacher['specialization']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Experience</small><?= htmlspecialchars($teacher['experience_years']) ?> Years</div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Joining Date</small><?= htmlspecialchars($teacher['joining_date']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Salary</small><span class="badge bg-success">Rs. <?= number_format($teacher['salary']) ?></span></div>
        </div>

        <hr>

        <!-- Contact Information -->
        <h6 class="text-primary text-uppercase mb-3 mt-3">Contact Information</h6>
        <div class="row">
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Primary Contact</small><?= htmlspecialchars($teacher['contact']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Emergency Contact</small><?= htmlspecialchars($teacher['emergency_contact']) ?></div>
            <div class="col-md-4 mb-2"><small class="text-muted d-block">Email Address</small><?= htmlspecialchars($teacher['email']) ?></div>
            <div class="col-md-12 mb-2"><small class="text-muted d-block">Address</small><?= htmlspecialchars($teacher['address']) ?></div>
        </div>

    </div>

    <div class="card-footer d-flex gap-2">
        <a href="?edit_tch=true&id=<?= $teacher['id'] ?>" class="btn btn-warning btn-sm">Edit Teacher</a>
        <a href="?delete_tch=true&id=<?= $teacher['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this teacher?')">Delete Teacher</a>
    </div>
</div>