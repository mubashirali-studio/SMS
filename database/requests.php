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
    $address = $_POST['address'];
    $photo = "";
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $photo = time() . '_' . $_FILES['photo']['name'];
        $target = __DIR__ . '/../assets/uploads/teachers/' . $photo;
        move_uploaded_file($_FILES['photo']['tmp_name'], $target);
    }

    $teacher = $conn->prepare("Insert into `teachers` 
            (`id`,`name`,`dob`, `gender`, `cnic` ,`photo`,`qualification`,`specialization`, `experience_years`, `joining_date` , `salary`,`contact`,`emergency_contact`, `email`, `address`)
            values(NULL, '$name' , '$dob' , '$gender' , '$cnic', '$photo' , '$qualification' , '$specialization' , '$experience_years', '$joining_date' , '$salary' , '$contact' , '$emergency_contact', '$email' , '$address');
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
}
?>