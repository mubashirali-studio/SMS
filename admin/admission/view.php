<?php
include_once __DIR__ . '/../../database/db.php';

$id = (int) $_GET['request_id'];

$sql = "SELECT admission_requests.*, `class`.name AS classname
        FROM admission_requests
        LEFT JOIN `class` ON `class`.id = admission_requests.classno
        WHERE admission_requests.id = $id";
$result = mysqli_query($conn, $sql);
$req = mysqli_fetch_assoc($result);

if (!$req) {
    echo '<div class="container mt-4"><div class="alert alert-danger">Request not found.</div></div>';
    return;
}
?>

<div class="container mt-4 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Admission Application</h3>
        <a href="?admission=true" class="btn btn-secondary">Back</a>
    </div>

    <div class="row g-4">

        <!-- Left card: photo and quick actions -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">

                    <?php if (!empty($req['photo'])) { ?>
                        <img src="/Website/SMS/assets/uploads/admission/<?php echo htmlspecialchars($req['photo']); ?>"
                             class="rounded-circle mb-3"
                             style="width: 140px; height: 140px; object-fit: cover;">
                    <?php } else { ?>
                        <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center mx-auto mb-3"
                             style="width: 140px; height: 140px; font-size: 56px;">
                            <?php echo strtoupper(substr($req['name'], 0, 1)); ?>
                        </div>
                    <?php } ?>

                    <h4 class="mb-1"><?php echo htmlspecialchars($req['name']); ?></h4>
                    <p class="text-muted mb-3">
                        Class <?php echo htmlspecialchars($req['classname']); ?> -
                        <?php echo htmlspecialchars($req['academic_year']); ?>
                    </p>

                    <span class="badge bg-secondary mb-3">Status: <?php echo htmlspecialchars($req['status']); ?></span>

                    <form method="POST" action="/Website/SMS/database/requests.php">
                        <input type="hidden" name="request_id" value="<?php echo $req['id']; ?>">
                        <button type="submit" name="approve_admission" class="btn btn-success w-100 mb-2">Add Student</button>
                        <button type="submit" name="reject_admission" class="btn btn-outline-danger w-100">Reject</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- Right side: full details -->
        <div class="col-12 col-md-8">

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Student Information</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr><th style="width: 220px;">Date of Birth</th><td><?php echo htmlspecialchars($req['dob']); ?></td></tr>
                        <tr><th>Gender</th><td><?php echo htmlspecialchars($req['gender']); ?></td></tr>
                        <tr><th>Blood Group</th><td><?php echo htmlspecialchars($req['blood_group']); ?></td></tr>
                        <tr><th>B-Form / CNIC No</th><td><?php echo htmlspecialchars($req['b_form_no']); ?></td></tr>
                        <tr><th>Religion</th><td><?php echo htmlspecialchars($req['religion']); ?></td></tr>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Admission Details</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr><th style="width: 220px;">Class Applying For</th><td><?php echo htmlspecialchars($req['classname']); ?></td></tr>
                        <tr><th>Academic Year</th><td><?php echo htmlspecialchars($req['academic_year']); ?></td></tr>
                        <tr><th>Admission Date</th><td><?php echo htmlspecialchars($req['admission_date']); ?></td></tr>
                        <tr><th>Previous School</th><td><?php echo htmlspecialchars($req['previous_school']); ?></td></tr>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Parent / Guardian</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr><th style="width: 220px;">Father's Name</th><td><?php echo htmlspecialchars($req['father_name']); ?></td></tr>
                        <tr><th>Mother's Name</th><td><?php echo htmlspecialchars($req['mother_name']); ?></td></tr>
                        <tr><th>Guardian CNIC</th><td><?php echo htmlspecialchars($req['guardian_cnic']); ?></td></tr>
                        <tr><th>Guardian Occupation</th><td><?php echo htmlspecialchars($req['guardian_occupation']); ?></td></tr>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Contact</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr><th style="width: 220px;">Primary Contact</th><td><?php echo htmlspecialchars($req['contact']); ?></td></tr>
                        <tr><th>Emergency Contact</th><td><?php echo htmlspecialchars($req['emergency_contact']); ?></td></tr>
                        <tr><th>Address</th><td><?php echo htmlspecialchars($req['address']); ?></td></tr>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">Account</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr><th style="width: 220px;">Email</th><td><?php echo htmlspecialchars($req['email']); ?></td></tr>
                        <tr><th>Submitted On</th><td><?php echo htmlspecialchars($req['created_at']); ?></td></tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>