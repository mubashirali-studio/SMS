<?php
include('../database/db.php');
if (isset($_POST["save_std"])) {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $cnic = $_POST['b_form_no'];
    $religion = $_POST['religion'];
    $class = $_POST['class'];
    $academic_year = $_POST['academic_year'];
    $admission_date = $_POST['admission_date'];
    $previous_school = $_POST['previous_school'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $guardian_cnic = $_POST['guardian_cnic'];
    $guardian_occupation = $_POST['guardian_occupation'];
    $contact = $_POST['contact'];
    $emergency_contact = $_POST['emergency_contact'];
    $address = $_POST['address'];

    $student_photo = "";
    if (isset($_FILES['student_photo']) && $_FILES['student_photo']['error'] === 0) {
        $student_photo = time() . '_' . $_FILES['student_photo']['name'];
        $target = __DIR__ . '/../assets/uploads/students/' . $student_photo;
        move_uploaded_file($_FILES['student_photo']['tmp_name'], $target);
    }

    $student = $conn->prepare("Insert into `students` 
            (`id`,`name`,`dob`, `gender`, `bloodgrp` ,`cnic`,`religion`,`pic`, `classno`, `acad-year` , `add-date`,`pre-scl`,`father-name`, `mother-name`, `gurd-cnic` , `gurd-ocp`,`prim-no`,`emg-no`, `address`)
            values(NULL, '$name' , '$dob' , '$gender' , '$blood_group', '$cnic' , '$religion' , '$student_photo' , '$class', '$academic_year' , '$admission_date' , '$previous_school' , '$father_name', '$mother_name' , '$guardian_cnic' , '$guardian_occupation' , '$contact' , '$emergency_contact' , '$address');
            ");
    $result = $student->execute();
    $student->insert_id;

    if ($result) {
    $newStudentId = $conn->insert_id;

    $admissionFee = $conn->prepare("Insert into `fees` 
            (`id`,`student_id`,`fee_type`,`month`,`amount_due`,`amount_paid`,`due_date`,`paid_date`)
            values(NULL, ?, 'Admission', ?, 5000, 0, ?, NULL);
            ");
    $currentMonth = date('F Y');
    $today = date('Y-m-d');
    $admissionFee->bind_param("iss", $newStudentId, $currentMonth, $today);
    $admissionFee->execute();

        header("location: /Website/SMS/?students=true");
    } else {
        echo "Failed To Add Student";
    }

} else if (isset($_POST["update_std"])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $cnic = $_POST['b_form_no'];
    $religion = $_POST['religion'];
    $class = $_POST['class'];
    $academic_year = $_POST['academic_year'];
    $admission_date = $_POST['admission_date'];
    $previous_school = $_POST['previous_school'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $guardian_cnic = $_POST['guardian_cnic'];
    $guardian_occupation = $_POST['guardian_occupation'];
    $contact = $_POST['contact'];
    $emergency_contact = $_POST['emergency_contact'];
    $address = $_POST['address'];

    // Only touch the photo field if a new file was actually uploaded
    $photoSql = "";
    if (isset($_FILES['student_photo']) && $_FILES['student_photo']['error'] === 0) {
        $student_photo = time() . '_' . $_FILES['student_photo']['name'];
        $target = __DIR__ . '/../assets/uploads/students/' . $student_photo;
        move_uploaded_file($_FILES['student_photo']['tmp_name'], $target);
        $photoSql = "`pic` = '$student_photo',";
    }

    $student = $conn->prepare("UPDATE `students` SET
            $photoSql
            `name` = '$name',
            `dob` = '$dob',
            `gender` = '$gender',
            `bloodgrp` = '$blood_group',
            `cnic` = '$cnic',
            `religion` = '$religion',
            `classno` = '$class',
            `acad-year` = '$academic_year',
            `add-date` = '$admission_date',
            `pre-scl` = '$previous_school',
            `father-name` = '$father_name',
            `mother-name` = '$mother_name',
            `gurd-cnic` = '$guardian_cnic',
            `gurd-ocp` = '$guardian_occupation',
            `prim-no` = '$contact',
            `emg-no` = '$emergency_contact',
            `address` = '$address'
            WHERE `id` = '$id'
            ");
    $result = $student->execute();

    if ($result) {
        header("location: /Website/SMS/?students=true");
    } else {
        echo "Failed To Update Student";
    }
} else if (isset($_POST["assign_section"])) {
    $student_id = $_POST['student_id'];
    $section_id = $_POST['section_id'];

    $stmt = $conn->prepare("UPDATE students SET section_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $section_id, $student_id);
    $result = $stmt->execute();

    if ($result) {
        header("location: /Website/SMS/?students=true");
    } else {
        echo "Failed To Assign Section";
    }
}
else if (isset($_POST["save_tch"])) {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $cnic = $_POST['cnic'];
    $qualification = $_POST['qualification'];
    $specialization = $_POST['specialization'];
    $experience_years = $_POST['experience_years'];
    $joining_date = $_POST['joining_date'];
    $salary = $_POST['salary'];
    $contact = $_POST['contact'];
    $emergency_contact = $_POST['emergency_contact'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $address = $_POST['address'];
    $photo = "";
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $photo = time() . '_' . $_FILES['photo']['name'];
        $target = __DIR__ . '/../assets/uploads/teachers/' . $photo;
        move_uploaded_file($_FILES['photo']['tmp_name'], $target);
    }

    $teacher = $conn->prepare("Insert into `teachers` 
            (`id`,`name`,`dob`, `gender`, `cnic` ,`photo`,`qualification`,`specialization`, `experience_years`, `joining_date` , `salary`,`contact`,`emergency_contact`, `email`, `password`, `address`)
            values(NULL, '$name' , '$dob' , '$gender' , '$cnic', '$photo' , '$qualification' , '$specialization' , '$experience_years', '$joining_date' , '$salary' , '$contact' , '$emergency_contact', '$email' , '$password' , '$address');
            ");
    $result = $teacher->execute();
    $teacher->insert_id;

    if ($result) {
        header("location: /Website/SMS/?teachers=true");
    } else {
        echo "Failed To Add Teacher";
    }

} else if (isset($_POST["update_tch"])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $cnic = $_POST['cnic'];
    $qualification = $_POST['qualification'];
    $specialization = $_POST['specialization'];
    $experience_years = $_POST['experience_years'];
    $joining_date = $_POST['joining_date'];
    $salary = $_POST['salary'];
    $contact = $_POST['contact'];
    $emergency_contact = $_POST['emergency_contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $photoSql = "";
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $photo = time() . '_' . $_FILES['photo']['name'];
        $target = __DIR__ . '/../assets/uploads/teachers/' . $photo;
        move_uploaded_file($_FILES['photo']['tmp_name'], $target);
        $photoSql = "`photo` = '$photo',";
    }

    $teacher = $conn->prepare("UPDATE `teachers` SET
            $photoSql
            `name` = '$name',
            `dob` = '$dob',
            `gender` = '$gender',
            `cnic` = '$cnic',
            `qualification` = '$qualification',
            `specialization` = '$specialization',
            `experience_years` = '$experience_years',
            `joining_date` = '$joining_date',
            `salary` = '$salary',
            `contact` = '$contact',
            `emergency_contact` = '$emergency_contact',
            `email` = '$email',
            `address` = '$address'
            WHERE `id` = '$id'
            ");
    $result = $teacher->execute();

    if ($result) {
        header("location: /Website/SMS/?teachers=true");
    } else {
        echo "Failed To Update Teacher";
    }
} else if (isset($_POST["save_sub"])) {
    $name = $_POST['name'];

    $subject = $conn->prepare("Insert into `subjects` 
            (`id`,`name`)
            values(NULL, '$name');
            ");
    $result = $subject->execute();

    if ($result) {
        header("location: /Website/SMS/?subjects=true");
    } else {
        echo "Failed To Add Subject";
    }
} else if (isset($_POST["save_sec"])) {
    $classno = $_POST['classno'];
    $section_name = $_POST['section_name'];

    $section = $conn->prepare("Insert into `sections` 
            (`id`,`classno`,`section_name`)
            values(NULL, '$classno', '$section_name');
            ");
    $result = $section->execute();

    if ($result) {
        header("location: /Website/SMS/?sections=true");
    } else {
        echo "Failed To Add Section";
    }
} else if (isset($_POST["save_fee"])) {
    $apply_to = $_POST['apply_to'];
    $fee_type = $_POST['fee_type'];
    $month = $_POST['month'];
    $amount_due = $_POST['amount_due'];
    $due_date = $_POST['due_date'];

    if ($apply_to === 'student') {
        $student_id = $_POST['student_id'];

        $fee = $conn->prepare("Insert into `fees` 
                (`id`,`student_id`,`fee_type`,`month`,`amount_due`,`amount_paid`,`due_date`,`paid_date`)
                values(NULL, ?, ?, ?, ?, 0, ?, NULL);
                ");
        $fee->bind_param("issis", $student_id, $fee_type, $month, $amount_due, $due_date);
        $fee->execute();

    } else if ($apply_to === 'class') {
        $classno = $_POST['classno'];
        $students = $conn->query("SELECT id FROM students WHERE classno = $classno");

        foreach ($students as $s) {
            $fee = $conn->prepare("Insert into `fees` 
                    (`id`,`student_id`,`fee_type`,`month`,`amount_due`,`amount_paid`,`due_date`,`paid_date`)
                    values(NULL, ?, ?, ?, ?, 0, ?, NULL);
                    ");
            $fee->bind_param("issis", $s['id'], $fee_type, $month, $amount_due, $due_date);
            $fee->execute();
        }

    } else if ($apply_to === 'school') {
        $students = $conn->query("SELECT id FROM students");

        foreach ($students as $s) {
            $fee = $conn->prepare("Insert into `fees` 
                    (`id`,`student_id`,`fee_type`,`month`,`amount_due`,`amount_paid`,`due_date`,`paid_date`)
                    values(NULL, ?, ?, ?, ?, 0, ?, NULL);
                    ");
            $fee->bind_param("issis", $s['id'], $fee_type, $month, $amount_due, $due_date);
            $fee->execute();
        }
    }

    header("location: /Website/SMS/?fees=true");
} else if (isset($_POST["record_payment"])) {
    $fee_id = $_POST['fee_id'];
    $payment_amount = $_POST['payment_amount'];

    $stmt = $conn->prepare("UPDATE fees SET amount_paid = amount_paid + $payment_amount, paid_date = CURDATE() WHERE id = $fee_id");
    // $stmt->bind_param("di", $payment_amount, $fee_id);
    $result = $stmt->execute();

    if ($result) {
        header("location: /Website/SMS/?fees=true");
    } else {
        echo "Failed To Record Payment";
    }
} else if (isset($_POST['save_slot'])) {

    $classno = (int) $_POST['classno'];
    $day     = (int) $_POST['day_no'];
    $period  = (int) $_POST['period_no'];
    $subject = (int) $_POST['subject_id'];
    $teacher = (int) $_POST['teacher_id'];

    $back = "/Website/SMS/index.php?timetable=true&classno=" . $classno;

    // 1. check if this teacher is already busy in another class at this day and period
    $sql = "SELECT class.name FROM timetable
            JOIN class ON class.id = timetable.classno
            WHERE timetable.teacher_id = $teacher
            AND timetable.day_no = $day
            AND timetable.period_no = $period
            AND timetable.classno != $classno";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        header("Location: " . $back . "&error=clash&with=" . urlencode("Class " . $row['name']));
        exit;
    }

    // 2. check if this box already has data
    $check = mysqli_query($conn, "SELECT id FROM timetable
                                  WHERE classno = $classno AND day_no = $day AND period_no = $period");

    if (mysqli_num_rows($check) > 0) {
        // box already filled, so update it
        mysqli_query($conn, "UPDATE timetable SET subject_id = $subject, teacher_id = $teacher
                             WHERE classno = $classno AND day_no = $day AND period_no = $period");
    } else {
        // empty box, so insert
        mysqli_query($conn, "INSERT INTO timetable (classno, day_no, period_no, subject_id, teacher_id)
                             VALUES ($classno, $day, $period, $subject, $teacher)");
    }

    header("Location: " . $back . "&msg=saved");
    exit;
}
else if (isset($_POST['clear_slot'])) {

    $classno = (int) $_POST['classno'];
    $day     = (int) $_POST['day_no'];
    $period  = (int) $_POST['period_no'];

    mysqli_query($conn, "DELETE FROM timetable
                         WHERE classno = $classno AND day_no = $day AND period_no = $period");

    header("Location: /Website/SMS/index.php?timetable=true&classno=" . $classno . "&msg=cleared");
    exit;
} else if (isset($_POST['assign_attendance'])) {

    $classno    = (int) $_POST['classno'];
    $section_id = (int) $_POST['section_id'];
    $teacher_id = (int) $_POST['teacher_id'];

    $check = mysqli_query($conn, "SELECT id FROM attendance_assignment
                                  WHERE classno = $classno AND section_id = $section_id");

    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE attendance_assignment SET teacher_id = $teacher_id
                             WHERE classno = $classno AND section_id = $section_id");
    } else {
        mysqli_query($conn, "INSERT INTO attendance_assignment (classno, section_id, teacher_id)
                             VALUES ($classno, $section_id, $teacher_id)");
    }

    header("Location: /Website/SMS/index.php?attendance=true&assign=true&msg=assigned");
    exit;
}
else if (isset($_POST['save_attendance'])) {

    $classno    = (int) $_POST['classno'];
    $section_id = (int) $_POST['section_id'];
    $teacher_id = (int) $_SESSION['teacher_id'];
    $today      = date('Y-m-d');

    foreach ($_POST['status'] as $student_id => $status) {

        $teacher_id = (int) $_SESSION['user']['id'];

        // status comes from a fixed set of radio values, but check it anyway
        if ($status != 'present' && $status != 'absent' && $status != 'leave') {
            continue;
        }

        $check = mysqli_query($conn, "SELECT id FROM attendance
                                      WHERE student_id = $student_id AND att_date = '$today'");

        if (mysqli_num_rows($check) > 0) {
            mysqli_query($conn, "UPDATE attendance SET status = '$status'
                                 WHERE student_id = $student_id AND att_date = '$today'");
        } else {
            mysqli_query($conn, "INSERT INTO attendance (student_id, classno, section_id, att_date, status, marked_by)
                                 VALUES ($student_id, $classno, $section_id, '$today', '$status', $teacher_id)");
        }
    }

        header("Location: /Website/SMS/index.php?teacher_attendance=true&classno=$classno&section_id=$section_id&msg=saved");
    exit;
} else if (isset($_POST['submit_admission'])) {

    $name                = mysqli_real_escape_string($conn, $_POST['name']);
    $dob                 = $_POST['dob'];
    $gender              = mysqli_real_escape_string($conn, $_POST['gender']);
    $blood_group         = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $b_form_no           = mysqli_real_escape_string($conn, $_POST['b_form_no']);
    $religion            = mysqli_real_escape_string($conn, $_POST['religion']);
    $classno             = (int) $_POST['class'];
    $academic_year       = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $admission_date      = $_POST['admission_date'];
    $previous_school     = mysqli_real_escape_string($conn, $_POST['previous_school']);
    $father_name         = mysqli_real_escape_string($conn, $_POST['father_name']);
    $mother_name         = mysqli_real_escape_string($conn, $_POST['mother_name']);
    $guardian_cnic       = mysqli_real_escape_string($conn, $_POST['guardian_cnic']);
    $guardian_occupation = mysqli_real_escape_string($conn, $_POST['guardian_occupation']);
    $contact             = mysqli_real_escape_string($conn, $_POST['contact']);
    $emergency_contact   = mysqli_real_escape_string($conn, $_POST['emergency_contact']);
    $address             = mysqli_real_escape_string($conn, $_POST['address']);
    $email               = mysqli_real_escape_string($conn, $_POST['email']);
    $password            = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // stop duplicate applications with the same email
    $check = mysqli_query($conn, "SELECT id FROM admission_requests WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        header("Location: /Website/SMS/admission.php?error=email");
        exit;
    }

    // photo upload
    $photo_name = '';
    if (isset($_FILES['student_photo']) && $_FILES['student_photo']['error'] == 0) {
        $photo_name = time() . '_' . basename($_FILES['student_photo']['name']);
        move_uploaded_file($_FILES['student_photo']['tmp_name'], __DIR__ . '/../assets/uploads/admission/' . $photo_name);
    }

    $sql = "INSERT INTO admission_requests
            (name, dob, gender, blood_group, b_form_no, religion, photo, classno, academic_year, admission_date,
             previous_school, father_name, mother_name, guardian_cnic, guardian_occupation, contact, emergency_contact,
             address, email, password, status)
            VALUES
            ('$name', '$dob', '$gender', '$blood_group', '$b_form_no', '$religion', '$photo_name', $classno, '$academic_year', '$admission_date',
             '$previous_school', '$father_name', '$mother_name', '$guardian_cnic', '$guardian_occupation', '$contact', '$emergency_contact',
             '$address', '$email', '$password', 'pending')";
    mysqli_query($conn, $sql);

    header("Location: /Website/SMS/");
    exit;
}else if (isset($_POST['approve_admission'])) {

    $request_id = (int) $_POST['request_id'];

    // pull the full request
    $result = mysqli_query($conn, "SELECT * FROM admission_requests WHERE id = $request_id");
    $req = mysqli_fetch_assoc($result);

    if (!$req) {
        header("Location: /Website/SMS/index.php?admission=true&error=notfound");
        exit;
    }

    // escape every text field before inserting
    $name                = mysqli_real_escape_string($conn, $req['name']);
    $dob                 = $req['dob'];
    $gender              = mysqli_real_escape_string($conn, $req['gender']);
    $bloodgrp            = mysqli_real_escape_string($conn, $req['blood_group']);
    $cnic                = mysqli_real_escape_string($conn, $req['b_form_no']);
    $religion            = mysqli_real_escape_string($conn, $req['religion']);
    $pic                 = mysqli_real_escape_string($conn, $req['photo']);
    $classno             = (int) $req['classno'];
    $acad_year           = mysqli_real_escape_string($conn, $req['academic_year']);
    $pre_scl             = mysqli_real_escape_string($conn, $req['previous_school']);
    $add_date            = $req['admission_date'];
    $father_name         = mysqli_real_escape_string($conn, $req['father_name']);
    $mother_name         = mysqli_real_escape_string($conn, $req['mother_name']);
    $gurd_cnic           = mysqli_real_escape_string($conn, $req['guardian_cnic']);
    $gurd_ocp            = mysqli_real_escape_string($conn, $req['guardian_occupation']);
    $prim_no             = mysqli_real_escape_string($conn, $req['contact']);
    $emg_no              = mysqli_real_escape_string($conn, $req['emergency_contact']);
    $address             = mysqli_real_escape_string($conn, $req['address']);
    $email               = mysqli_real_escape_string($conn, $req['email']);
    $password            = $req['password']; // already hashed when it was first saved

    // move the photo from the admission uploads folder into the students uploads folder
    if (!empty($pic)) {
        $from = __DIR__ . '/../assets/uploads/admission/' . $pic;
        $to   = __DIR__ . '/../assets/uploads/students/' . $pic;
        if (file_exists($from)) {
            copy($from, $to);
        }
    }

    $sql = "INSERT INTO students
            (name, dob, gender, bloodgrp, cnic, religion, pic, classno, `acad-year`, `pre-scl`, `add-date`,
             `father-name`, `mother-name`, `gurd-cnic`, `gurd-ocp`, `prim-no`, `emg-no`, address, email, password)
            VALUES
            ('$name', '$dob', '$gender', '$bloodgrp', '$cnic', '$religion', '$pic', $classno, '$acad_year', '$pre_scl', '$add_date',
             '$father_name', '$mother_name', '$gurd_cnic', '$gurd_ocp', '$prim_no', '$emg_no', '$address', '$email', '$password')";
    mysqli_query($conn, $sql); // insert into students

    $newStudentId = mysqli_insert_id($conn);

    $currentMonth = date('F Y');
    $today = date('Y-m-d');

    $admissionFee = $conn->prepare("INSERT INTO `fees` 
            (`id`,`student_id`,`fee_type`,`month`,`amount_due`,`amount_paid`,`due_date`,`paid_date`)
            VALUES (NULL, ?, 'Admission', ?, 5000, 0, ?, NULL)");
    $admissionFee->bind_param("iss", $newStudentId, $currentMonth, $today);
    $admissionFee->execute();

    // mark the request as handled so it drops off the pending list
    mysqli_query($conn, "DELETE FROM admission_requests WHERE id = $request_id");

    header("Location: /Website/SMS/index.php?admission=true&msg=added");
    exit;
}
else if (isset($_POST['reject_admission'])) {

    $request_id = (int) $_POST['request_id'];

    mysqli_query($conn, "DELETE FROM admission_requests WHERE id = $request_id");

    header("Location: /Website/SMS/index.php?admission=true&msg=rejected");
    exit;
}
else if (isset($_POST['login_user'])) {

    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // 1. check admins first
    $result = mysqli_query($conn, "SELECT * FROM admins WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);
    $role = 'admin';

    // 2. not an admin, check teachers
    if (!$user) {
        $result = mysqli_query($conn, "SELECT * FROM teachers WHERE email = '$email'");
        $user = mysqli_fetch_assoc($result);
        $role = 'teacher';
    }

    // 3. not a teacher either, check students
    if (!$user) {
        $result = mysqli_query($conn, "SELECT * FROM students WHERE email = '$email'");
        $user = mysqli_fetch_assoc($result);
        $role = 'student';
    }

    // not found anywhere, or that account has no password set
    if (!$user || empty($user['password'])) {
        header("Location: /Website/SMS/index.php?login=true&error=1");
        exit;
    }

    // check the password
    if (!password_verify($password, $user['password'])) {
        header("Location: /Website/SMS/index.php?login=true&error=1");
        exit;
    }

    // success — store the session
    $_SESSION['user'] = array(
        'id'   => $user['id'],
        'name' => $user['name'],
        'role' => $role
    );

    if ($role == 'admin') {
        header("Location: /Website/SMS/index.php?dashboard=true");
    } else if ($role == 'teacher') {
        $_SESSION['teacher_id'] = $user['id']; // keeps the attendance module working as is
        header("Location: /Website/SMS/index.php?teacher_profile=true");
    } else {
        $_SESSION['student_id'] = $user['id'];
        header("Location: /Website/SMS/index.php?student_profile=true");
    }
    exit;
}
else if (isset($_POST['logout_user']) || isset($_GET['logout_user'])) {
    session_unset();
    session_destroy();
    header("Location: /Website/SMS/index.php");
    exit;
}
?>