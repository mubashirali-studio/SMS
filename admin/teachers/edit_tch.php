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
    echo ("Teacher not found.");
}
?>

<div class="d-flex justify-content-center">
    <div class="card shadow-sm" style="width: 100%; max-width: 750px;">
        <div class="card-body p-4">
            <h3 class="mb-4">Edit Teacher</h3>

            <form method="POST" action="./database/requests.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($teacher['id']) ?>">

                <!-- Personal Information -->
                <h5 class="mt-2 mb-3 text-primary">Personal Information</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($teacher['name']) ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?= htmlspecialchars($teacher['dob']) ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="male" <?= $teacher['gender'] === 'male' ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= $teacher['gender'] === 'female' ? 'selected' : '' ?>>Female</option>
                            <option value="other" <?= $teacher['gender'] === 'other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cnic" class="form-label">CNIC No</label>
                        <input type="text" class="form-control" id="cnic" name="cnic" value="<?= htmlspecialchars($teacher['cnic']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Teacher Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    <small class="text-muted">Leave empty to keep current photo.</small>
                </div>

                <hr class="my-4">

                <!-- Professional & Employment Details -->
                <h5 class="mb-3 text-primary">Professional Details</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="qualification" class="form-label">Qualification</label>
                        <input type="text" class="form-control" id="qualification" name="qualification" value="<?= htmlspecialchars($teacher['qualification']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="specialization" class="form-label">Specialization / Subject</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" value="<?= htmlspecialchars($teacher['specialization']) ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="experience_years" class="form-label">Experience (Years)</label>
                        <input type="number" step="0.1" class="form-control" id="experience_years" name="experience_years" value="<?= htmlspecialchars($teacher['experience_years']) ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="joining_date" class="form-label">Joining Date</label>
                        <input type="date" class="form-control" id="joining_date" name="joining_date" value="<?= htmlspecialchars($teacher['joining_date']) ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" class="form-control" id="salary" name="salary" value="<?= htmlspecialchars($teacher['salary']) ?>" required>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Contact Information -->
                <h5 class="mb-3 text-primary">Contact Information</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="contact" class="form-label">Primary Contact Number</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="<?= htmlspecialchars($teacher['contact']) ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="emergency_contact" class="form-label">Emergency Contact Number</label>
                        <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" value="<?= htmlspecialchars($teacher['emergency_contact']) ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($teacher['email']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Home Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required><?= htmlspecialchars($teacher['address']) ?></textarea>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" name="update_tch" class="btn btn-primary">Update Teacher</button>
                    <a href="?teachers=true" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>