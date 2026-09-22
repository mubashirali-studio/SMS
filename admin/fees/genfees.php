<?php
include(__DIR__ . '/../../database/db.php');

$currentMonth = date('F Y');
$dueDate = date('Y-m-d');

// Get every student along with their class's fee amount
$students = $conn->query("SELECT students.id, class.fee_amount 
                           FROM students 
                           JOIN class ON students.classno = class.id");

$generated = 0;
$skipped = 0;

foreach ($students as $student) {
    // Check if a tuition fee for this student, this month, already exists
    $check = $conn->prepare("SELECT id FROM fees WHERE student_id = ? AND fee_type = 'Tuition' AND month = ?");
    $check->bind_param("is", $student['id'], $currentMonth);
    $check->execute();
    $exists = $check->get_result()->fetch_assoc();

    if ($exists) {
        $skipped++;
        continue;
    }

    $insert = $conn->prepare("Insert into `fees` 
            (`id`,`student_id`,`fee_type`,`month`,`amount_due`,`amount_paid`,`due_date`,`paid_date`)
            values(NULL, ?, 'Tuition', ?, ?, 0, ?, NULL);
            ");
    $insert->bind_param("isis", $student['id'], $currentMonth, $student['fee_amount'], $dueDate);
    $insert->execute();
    $generated++;
}

header("Location: /Website/SMS/?fees=true&generated=$generated&skipped=$skipped");
exit();
?>