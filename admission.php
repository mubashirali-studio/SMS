<?php
include_once __DIR__ . '/database/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Admission - School Management System</title>
    <link href="assets/bootstrap.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-center">
        <div class="card shadow-sm" style="width: 100%; max-width: 750px;">
            <div class="card-body p-4">
                <h3 class="mb-4">Student Admission Form</h3>

                <?php if (isset($_GET['msg']) && $_GET['msg'] == 'submitted') { ?>
                    <div class="alert alert-success">
                        Your admission request has been submitted. The school will contact you soon.
                    </div>
                <?php } ?>
                <?php if (isset($_GET['error']) && $_GET['error'] == 'email') { ?>
                    <div class="alert alert-danger">
                        This email has already been used for an admission request.
                    </div>
                <?php } ?>

                <form method="POST" action="database/requests.php" enctype="multipart/form-data">

                    <h5 class="mt-2 mb-3 text-primary">Student Information</h5>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter student's name" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="" selected disabled>Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="blood_group" class="form-label">Blood Group</label>
                            <select class="form-select" id="blood_group" name="blood_group">
                                <option value="" selected disabled>Select</option>
                                <option>A+</option><option>A-</option>
                                <option>B+</option><option>B-</option>
                                <option>O+</option><option>O-</option>
                                <option>AB+</option><option>AB-</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="b_form_no" class="form-label">B-Form / CNIC No</label>
                            <input type="text" class="form-control" id="b_form_no" name="b_form_no" placeholder="XXXXXXXXXXXXX">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="religion" class="form-label">Religion</label>
                            <input type="text" class="form-control" id="religion" name="religion">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="student_photo" class="form-label">Student Photo</label>
                        <input type="file" class="form-control" id="student_photo" name="student_photo" accept="image/*">
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3 text-primary">Admission Details</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="classno" class="form-label">Class Applying For</label>
                            <?php include('./admin/students/class.php'); // FIX THIS PATH — see note above ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="academic_year" class="form-label">Academic Year</label>
                            <input type="text" class="form-control" id="academic_year" name="academic_year" placeholder="2026-2027" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="admission_date" class="form-label">Admission Date</label>
                            <input type="date" class="form-control" id="admission_date" name="admission_date" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="previous_school" class="form-label">Previous School (if any)</label>
                        <input type="text" class="form-control" id="previous_school" name="previous_school" placeholder="Name of last attended school">
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3 text-primary">Parent / Guardian Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="father_name" class="form-label">Father's Name</label>
                            <input type="text" class="form-control" id="father_name" name="father_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mother_name" class="form-label">Mother's Name</label>
                            <input type="text" class="form-control" id="mother_name" name="mother_name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="guardian_cnic" class="form-label">Guardian CNIC</label>
                            <input type="text" class="form-control" id="guardian_cnic" name="guardian_cnic" placeholder="XXXXX-XXXXXXX-X">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="guardian_occupation" class="form-label">Guardian Occupation</label>
                            <input type="text" class="form-control" id="guardian_occupation" name="guardian_occupation">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contact" class="form-label">Primary Contact Number</label>
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="03XX-XXXXXXX" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="emergency_contact" class="form-label">Emergency Contact Number</label>
                            <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" placeholder="03XX-XXXXXXX">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Home Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3 text-primary">Account Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" minlength="6" required>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" name="submit_admission" class="btn btn-primary">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>