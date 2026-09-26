<?php
include('database/db.php');

$classno    = (int) $_GET['classno'];
$section_id = (int) $_GET['section_id'];
$teacher_id = (int) $_SESSION['teacher_id'];
$today      = date('Y-m-d');

// make sure this teacher is really assigned to this class+section
$check = mysqli_query($conn, "SELECT id FROM attendance_assignment
                              WHERE classno = $classno AND section_id = $section_id AND teacher_id = $teacher_id");
if (mysqli_num_rows($check) == 0) {
    echo '<div class="container mt-4"><div class="alert alert-danger">You are not assigned to this class.</div></div>';
    return;
}

// students of this class+section
$students = mysqli_query($conn, "SELECT * FROM students
                                  WHERE classno = $classno AND section_id = $section_id
                                  ORDER BY name");

// any attendance already marked today, so the form opens pre-filled
$already = array();
$sql = "SELECT student_id, status FROM attendance
        WHERE classno = $classno AND section_id = $section_id AND att_date = '$today'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $already[$row['student_id']] = $row['status'];
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Attendance - <?php echo date('l, d F Y'); ?></h3>
        <a href="/Website/SMS/index.php?attendance=true" class="btn btn-secondary">Back</a>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'saved') { ?>
        <div class="alert alert-success">Attendance saved.</div>
    <?php } ?>

    <form method="POST" action="/Website/SMS/database/requests.php">
        <input type="hidden" name="classno" value="<?php echo $classno; ?>">
        <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">

        <table class="table table-bordered align-middle">
            <tr class="table-dark">
                <th>Student</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Leave</th>
            </tr>

            <?php while ($s = mysqli_fetch_assoc($students)) {
                $current = isset($already[$s['id']]) ? $already[$s['id']] : 'present';
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($s['name']); ?></td>
                    <td class="text-center">
                        <input type="radio" name="status[<?php echo $s['id']; ?>]" value="present"
                               <?php echo ($current == 'present') ? 'checked' : ''; ?>>
                    </td>
                    <td class="text-center">
                        <input type="radio" name="status[<?php echo $s['id']; ?>]" value="absent"
                               <?php echo ($current == 'absent') ? 'checked' : ''; ?>>
                    </td>
                    <td class="text-center">
                        <input type="radio" name="status[<?php echo $s['id']; ?>]" value="leave"
                               <?php echo ($current == 'leave') ? 'checked' : ''; ?>>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <button type="submit" name="save_attendance" class="btn btn-primary">Save Attendance</button>
    </form>
</div>