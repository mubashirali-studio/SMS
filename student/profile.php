<?php
include_once __DIR__ . '/../database/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'student') {
    header("Location: /Website/SMS/index.php?login=true");
    exit;
}
$student_id = (int) $_SESSION['user']['id'];

$sql = "SELECT students.*, `class`.name AS classname, sections.section_name
        FROM students
        LEFT JOIN `class` ON `class`.id = students.classno
        LEFT JOIN sections ON sections.id = students.section_id
        WHERE students.id = $student_id";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    echo '<div class="container mt-4"><div class="alert alert-danger">Student not found.</div></div>';
    return;
}

$section_text = ($student['section_name'] != '') ? 'Section ' . $student['section_name'] : 'Section not assigned';
?>

<div class="container mt-4 mb-5">
    <h3 class="fw-bold mb-4">My Profile</h3>

    <div class="row g-4">

        <!-- Left card: photo and name -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">

                    <?php if (!empty($student['pic'])) { ?>
                        <img src="assets/uploads/students/<?php echo htmlspecialchars($student['pic']); ?>"
                             class="rounded-circle mb-3"
                             style="width: 140px; height: 140px; object-fit: cover;">
                    <?php } else { ?>
                        <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center mx-auto mb-3"
                             style="width: 140px; height: 140px; font-size: 56px;">
                            <?php echo strtoupper(substr($student['name'], 0, 1)); ?>
                        </div>
                    <?php } ?>

                    <h4 class="mb-1"><?php echo htmlspecialchars($student['name']); ?></h4>
                    <p class="text-muted mb-2">
                        Class <?php echo htmlspecialchars($student['classname']); ?>
                    </p>
                    <span class="badge bg-primary"><?php echo htmlspecialchars($section_text); ?></span>

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
                            <td><?php echo htmlspecialchars($student['dob']); ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo htmlspecialchars($student['gender']); ?></td>
                        </tr>
                        <tr>
                            <th>Blood Group</th>
                            <td><?php echo htmlspecialchars($student['bloodgrp']); ?></td>
                        </tr>
                        <tr>
                            <th>CNIC / B-Form</th>
                            <td><?php echo htmlspecialchars($student['cnic']); ?></td>
                        </tr>
                        <tr>
                            <th>Religion</th>
                            <td><?php echo htmlspecialchars($student['religion']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Academic Information</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th style="width: 200px;">Class</th>
                            <td><?php echo htmlspecialchars($student['classname']); ?></td>
                        </tr>
                        <tr>
                            <th>Section</th>
                            <td><?php echo htmlspecialchars($student['section_name']); ?></td>
                        </tr>
                        <tr>
                            <th>Academic Year</th>
                            <td><?php echo htmlspecialchars($student['acad-year']); ?></td>
                        </tr>
                        <tr>
                            <th>Previous School</th>
                            <td><?php echo htmlspecialchars($student['pre-scl']); ?></td>
                        </tr>
                        <tr>
                            <th>Admission Date</th>
                            <td><?php echo htmlspecialchars($student['add-date']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Family / Guardian</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th style="width: 200px;">Father Name</th>
                            <td><?php echo htmlspecialchars($student['father-name']); ?></td>
                        </tr>
                        <tr>
                            <th>Mother Name</th>
                            <td><?php echo htmlspecialchars($student['mother-name']); ?></td>
                        </tr>
                        <tr>
                            <th>Guardian CNIC</th>
                            <td><?php echo htmlspecialchars($student['gurd-cnic']); ?></td>
                        </tr>
                        <tr>
                            <th>Guardian Occupation</th>
                            <td><?php echo htmlspecialchars($student['gurd-ocp']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">Contact</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th style="width: 200px;">Primary Number</th>
                            <td><?php echo htmlspecialchars($student['prim-no']); ?></td>
                        </tr>
                        <tr>
                            <th>Emergency Number</th>
                            <td><?php echo htmlspecialchars($student['emg-no']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>