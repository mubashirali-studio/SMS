<?php
include_once __DIR__ . '/../database/db.php';
$days = array(
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday'
);
$periodCount = 8;

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'teacher') {
    header("Location: /Website/SMS/index.php?login=true");
    exit;
}
$teacher_id = (int) $_SESSION['user']['id'];

// all periods of this teacher, from the timetable the admin filled
$sql = "SELECT timetable.day_no, timetable.period_no,
               subjects.name AS subject_name, `class`.name AS classname
        FROM timetable
        JOIN subjects ON subjects.id = timetable.subject_id
        JOIN `class` ON `class`.id = timetable.classno
        WHERE timetable.teacher_id = $teacher_id";
$result = mysqli_query($conn, $sql);

$slots = array();
while ($row = mysqli_fetch_assoc($result)) {
    $key = $row['day_no'] . '-' . $row['period_no'];
    $slots[$key] = $row;
}

$total_periods = mysqli_num_rows($result);
$today_no = date('N'); // 1 = Monday ... 7 = Sunday
?>

<div class="container mt-4 mb-5">

    <div class="mb-4">
        <h3 class="fw-bold mb-1">My Timetable</h3>
        <p class="text-muted mb-0">
            You teach <strong><?php echo $total_periods; ?></strong> periods per week.
        </p>
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
                                        <span class="badge bg-info text-dark">
                                            Class <?php echo htmlspecialchars($slots[$key]['classname']); ?>
                                        </span>
                                    <?php } else { ?>
                                        <span class="text-muted">Free</span>
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