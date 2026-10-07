<?php
include_once __DIR__ . '/../database/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'teacher') {
    header("Location: /Website/SMS/index.php?login=true");
    exit;
}
$teacher_id = (int) $_SESSION['user']['id'];
$today = date('Y-m-d');

// ---------- VIEW 2: student list of one class + section ----------
if (isset($_GET['classno']) && isset($_GET['section_id'])) {

    $classno    = (int) $_GET['classno'];
    $section_id = (int) $_GET['section_id'];

    // make sure this teacher is really assigned to this class + section
    $check = mysqli_query($conn, "SELECT id FROM attendance_assignment
                                  WHERE classno = $classno AND section_id = $section_id
                                  AND teacher_id = $teacher_id");
    if (mysqli_num_rows($check) == 0) {
        echo '<div class="container mt-4"><div class="alert alert-danger">You are not assigned to this class.</div></div>';
        return;
    }

    // class and section names for the heading
    $info = mysqli_query($conn, "SELECT `class`.name AS classname, sections.section_name
                                 FROM sections
                                 JOIN `class` ON `class`.id = sections.classno
                                 WHERE sections.id = $section_id");
    $head = mysqli_fetch_assoc($info);

    // students
    $students = mysqli_query($conn, "SELECT * FROM students
                                      WHERE classno = $classno AND section_id = $section_id
                                      ORDER BY name");

    // attendance already saved today, so the form opens pre-filled
    $already = array();
    $result = mysqli_query($conn, "SELECT student_id, status FROM attendance
                                   WHERE classno = $classno AND section_id = $section_id
                                   AND att_date = '$today'");
    while ($row = mysqli_fetch_assoc($result)) {
        $already[$row['student_id']] = $row['status'];
    }
?>

<div class="container mt-4 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-1">
                Class <?php echo htmlspecialchars($head['classname']); ?> -
                Section <?php echo htmlspecialchars($head['section_name']); ?>
            </h3>
            <p class="text-muted mb-0"><?php echo date('l, d F Y'); ?></p>
        </div>
        <a href="?teacher_attendance=true" class="btn btn-secondary">Back</a>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'saved') { ?>
        <div class="alert alert-success">Attendance saved.</div>
    <?php } ?>

    <?php if (mysqli_num_rows($students) == 0) { ?>
        <div class="alert alert-info">No students in this section yet.</div>
    <?php } else { ?>

    <form method="POST" action="/Website/SMS/database/requests.php">
        <input type="hidden" name="classno" value="<?php echo $classno; ?>">
        <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
        <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>">

        <div class="card border-0 shadow-sm mb-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center mb-0">
                    <tr class="table-dark">
                        <th class="text-start">Student</th>
                        <th>Present</th>
                        <th>Absent</th>
                        <th>Leave</th>
                    </tr>

                    <?php while ($s = mysqli_fetch_assoc($students)) {
                        $current = isset($already[$s['id']]) ? $already[$s['id']] : 'present';
                    ?>
                        <tr>
                            <td class="text-start"><?php echo htmlspecialchars($s['name']); ?></td>
                            <td>
                                <input type="radio" class="form-check-input"
                                       name="status[<?php echo $s['id']; ?>]" value="present"
                                       <?php echo ($current == 'present') ? 'checked' : ''; ?>>
                            </td>
                            <td>
                                <input type="radio" class="form-check-input"
                                       name="status[<?php echo $s['id']; ?>]" value="absent"
                                       <?php echo ($current == 'absent') ? 'checked' : ''; ?>>
                            </td>
                            <td>
                                <input type="radio" class="form-check-input"
                                       name="status[<?php echo $s['id']; ?>]" value="leave"
                                       <?php echo ($current == 'leave') ? 'checked' : ''; ?>>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

        <button type="submit" name="save_attendance" class="btn btn-primary">Save Attendance</button>
    </form>

    <?php } ?>
</div>

<?php
    return;
}

// ---------- VIEW 1: classes assigned to this teacher ----------
$sql = "SELECT attendance_assignment.classno, attendance_assignment.section_id,
               `class`.name AS classname, sections.section_name
        FROM attendance_assignment
        JOIN `class` ON `class`.id = attendance_assignment.classno
        JOIN sections ON sections.id = attendance_assignment.section_id
        WHERE attendance_assignment.teacher_id = $teacher_id
        ORDER BY `class`.id, sections.section_name";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4 mb-5">

    <div class="mb-4">
        <h3 class="fw-bold mb-1">Take Attendance</h3>
        <p class="text-muted mb-0">Today is <?php echo date('l, d F Y'); ?>. Choose a class to mark attendance.</p>
    </div>

    <?php if (mysqli_num_rows($result) == 0) { ?>
        <div class="alert alert-info">No class has been assigned to you yet. Please contact the admin.</div>
    <?php } ?>

    <div class="row g-4">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="?teacher_attendance=true&classno=<?php echo $row['classno']; ?>&section_id=<?php echo $row['section_id']; ?>"
                   class="text-decoration-none text-dark">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <div class="fs-1 fw-bold text-primary">
                                <?php echo htmlspecialchars($row['classname']); ?>
                            </div>
                            <div class="text-muted">Class</div>
                            <span class="badge bg-secondary mt-2">
                                Section <?php echo htmlspecialchars($row['section_name']); ?>
                            </span>
                        </div>
                        <div class="card-footer bg-primary text-white text-center border-0">
                            Mark attendance
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>