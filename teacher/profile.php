<?php
include_once __DIR__ . '/../database/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'teacher') {
    header("Location: /Website/SMS/index.php?login=true");
    exit;
}
$teacher_id = (int) $_SESSION['user']['id'];

$result = mysqli_query($conn, "SELECT * FROM teachers WHERE id = $teacher_id");
$teacher = mysqli_fetch_assoc($result);

if (!$teacher) {
    echo '<div class="container mt-4"><div class="alert alert-danger">Teacher not found.</div></div>';
    return;
}
?>

<div class="container mt-4 mb-5">
    <h3 class="fw-bold mb-4">My Profile</h3>

    <div class="row g-4">

        <!-- Left card: photo and name -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">

                    <?php if (!empty($teacher['photo'])) { ?>
                        <img src="assets/uploads/teachers/<?php echo htmlspecialchars($teacher['photo']); ?>"
                             class="rounded-circle mb-3"
                             style="width: 140px; height: 140px; object-fit: cover;">
                    <?php } else { ?>
                        <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center mx-auto mb-3"
                             style="width: 140px; height: 140px; font-size: 56px;">
                            <?php echo strtoupper(substr($teacher['name'], 0, 1)); ?>
                        </div>
                    <?php } ?>

                    <h4 class="mb-1"><?php echo htmlspecialchars($teacher['name']); ?></h4>
                    <p class="text-muted mb-2"><?php echo htmlspecialchars($teacher['specialization']); ?></p>
                    <span class="badge bg-primary"><?php echo htmlspecialchars($teacher['qualification']); ?></span>

                </div>
            </div>
        </div>

        <!-- Right side: details -->
        <div class="col-12 col-md-8">

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Personal Information</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th style="width: 200px;">Date of Birth</th>
                            <td><?php echo htmlspecialchars($teacher['dob']); ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo htmlspecialchars($teacher['gender']); ?></td>
                        </tr>
                        <tr>
                            <th>CNIC</th>
                            <td><?php echo htmlspecialchars($teacher['cnic']); ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo htmlspecialchars($teacher['address']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Contact</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th style="width: 200px;">Email</th>
                            <td><?php echo htmlspecialchars($teacher['email']); ?></td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td><?php echo htmlspecialchars($teacher['contact']); ?></td>
                        </tr>
                        <tr>
                            <th>Emergency Contact</th>
                            <td><?php echo htmlspecialchars($teacher['emergency_contact']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">Professional Information</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th style="width: 200px;">Qualification</th>
                            <td><?php echo htmlspecialchars($teacher['qualification']); ?></td>
                        </tr>
                        <tr>
                            <th>Specialization</th>
                            <td><?php echo htmlspecialchars($teacher['specialization']); ?></td>
                        </tr>
                        <tr>
                            <th>Experience</th>
                            <td><?php echo htmlspecialchars($teacher['experience_years']); ?> years</td>
                        </tr>
                        <tr>
                            <th>Joining Date</th>
                            <td><?php echo htmlspecialchars($teacher['joining_date']); ?></td>
                        </tr>
                        <tr>
                            <th>Salary</th>
                            <td><?php echo htmlspecialchars($teacher['salary']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>