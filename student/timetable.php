<?php
include_once __DIR__ . '/../database/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'student') {
    header("Location: /Website/SMS/index.php?login=true");
    exit;
}
$student_id = (int) $_SESSION['user']['id'];

$days = array(
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday'
);
$periodCount = 8;

// find the student's class
$sql = "SELECT students.classno, `class`.name AS classname
        FROM students
        JOIN `class` ON `class`.id = students.classno
        WHERE students.id = $student_id";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    echo '<div class="container mt-4"><div class="alert alert-danger">Student or class not found.</div></div>';
    return;
}

$classno = (int) $student['classno'];

// all periods of that class
$sql = "SELECT timetable.day_no, timetable.period_no,
               subjects.name AS subject_name, teachers.name AS teacher_name
        FROM timetable
        LEFT JOIN subjects ON subjects.id = timetable.subject_id
        LEFT JOIN teachers ON teachers.id = timetable.teacher_id
        WHERE timetable.classno = $classno";
$result = mysqli_query($conn, $sql);

$slots = array();
while ($row = mysqli_fetch_assoc($result)) {
    $key = $row['day_no'] . '-' . $row['period_no'];
    $slots[$key] = $row;
}

$today_no = date('N'); // 1 = Monday ... 7 = Sunday
?>

<div class="container mt-4 mb-5">

    <div class="mb-4">
        <h3 class="fw-bold mb-1">My Timetable</h3>
        <p class="text-muted mb-0">Class <?php echo htmlspecialchars($student['classname']); ?></p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle mb-0">
                    <tr class="table-dark">
                        <th>Day / Period</th>
                        <?php for ($p = 1; $p <= $periodCount; $p++) { ?>
                            <th>Period <?php echo $p; ?></th>
                        <?php } ?>
                    </tr>

                    <?php foreach ($days as $day_no => $day_name) {
                        $row_class = ($day_no == $today_no) ? 'table-warning' : '';
                    ?>
                        <tr class="<?php echo $row_class; ?>">
                            <th class="<?php echo ($day_no == $today_no) ? '' : 'table-light'; ?>">
                                <?php echo $day_name; ?>
                                <?php if ($day_no == $today_no) { ?>
                                    <br><span class="badge bg-primary">Today</span>
                                <?php } ?>
                            </th>

                            <?php for ($p = 1; $p <= $periodCount; $p++) {
                                $key = $day_no . '-' . $p;
                            ?>
                                <td style="min-width: 110px;">
                                    <?php if (isset($slots[$key])) { ?>
                                        <strong><?php echo htmlspecialchars($slots[$key]['subject_name']); ?></strong><br>
                                        <small class="text-muted"><?php echo htmlspecialchars($slots[$key]['teacher_name']); ?></small>
                                    <?php } else { ?>
                                        <span class="text-muted">-</span>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>