<?php
include('./database/db.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    die("No student ID provided.");
}

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    die("Student not found.");
}
?>

<div class="d-flex justify-content-center">
    <div class="card shadow-sm" style="width: 100%; max-width: 750px;">
        <div class="card-body p-4">
            <h3 class="mb-4">Edit Student</h3>

            <form method="POST" action="/Website/SMS/database/requests.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']) ?>">

                <h5 class="mt-2 mb-3 text-primary">Student Information</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?= htmlspecialchars($student['dob']) ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="male" <?= $student['gender'] === 'male' ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= $student['gender'] === 'female' ? 'selected' : '' ?>>Female</option>
                            <option value="other" <?= $student['gender'] === 'other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="blood_group" class="form-label">Blood Group</label>
                        <select class="form-select" id="blood_group" name="blood_group">
                            <?php foreach (['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg): ?>
                                <option value="<?= $bg ?>" <?= $student['bloodgrp'] === $bg ? 'selected' : '' ?>><?= $bg ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="b_form_no" class="form-label">B-Form / CNIC No</label>
                        <input type="text" class="form-control" id="b_form_no" name="b_form_no" value="<?= htmlspecialchars($student['cnic']) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="religion" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="religion" name="religion" value="<?= htmlspecialchars($student['religion']) ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="student_photo" class="form-label">Student Photo</label>
                    <?php if (!empty($student['pic'])): ?>
                        <div class="mb-2">
                            <img src="/Website/SMS/assets/uploads/students/<?= htmlspecialchars($student['pic']) ?>" style="width: 80px; height: 80px; object-fit: cover;" class="rounded">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="student_photo" name="student_photo" accept="image/*">
                    <small class="text-muted">Leave empty to keep the current photo.</small>
                </div>

                <hr class="my-4">

                <h5 class="mb-3 text-primary">Admission Details</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="class" class="form-label">Class Applying For</label>
                        <?php $currentClass = $student['classno']; ?>
                        <?php include('class.php'); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="academic_year" class="form-label">Academic Year</label>
                        <input type="text" class="form-control" id="academic_year" name="academic_year" value="<?= htmlspecialchars($student['acad-year']) ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="admission_date" class="form-label">Admission Date</label>
                        <input type="date" class="form-control" id="admission_date" name="admission_date" value="<?= htmlspecialchars($student['add-date']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="previous_school" class="form-label">Previous School (if any)</label>
                    <input type="text" class="form-control" id="previous_school" name="previous_school" value="<?= htmlspecialchars($student['pre-scl']) ?>">
                </div>

                <hr class="my-4">

                <h5 class="mb-3 text-primary">Parent / Guardian Information</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="father_name" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" id="father_name" name="father_name" value="<?= htmlspecialchars($student['father-name']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mother_name" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" id="mother_name" name="mother_name" value="<?= htmlspecialchars($student['mother-name']) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="guardian_cnic" class="form-label">Guardian CNIC</label>
                        <input type="text" class="form-control" id="guardian_cnic" name="guardian_cnic" value="<?= htmlspecialchars($student['gurd-cnic']) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="guardian_occupation" class="form-label">Guardian Occupation</label>
                        <input type="text" class="form-control" id="guardian_occupation" name="guardian_occupation" value="<?= htmlspecialchars($student['gurd-ocp']) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact" class="form-label">Primary Contact Number</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="<?= htmlspecialchars($student['prim-no']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="emergency_contact" class="form-label">Emergency Contact Number</label>
                        <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" value="<?= htmlspecialchars($student['emg-no']) ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Home Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required><?= htmlspecialchars($student['address']) ?></textarea>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" name="update_std" class="btn btn-primary">Update Student</button>
                    <a href="?students=true" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>