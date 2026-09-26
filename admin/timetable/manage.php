<?php
include_once __DIR__ . '/../../database/db.php';

$classno = (int) $_GET['classno'];

// class name
$classResult = mysqli_query($conn, "SELECT * FROM class WHERE id = $classno");
$class = mysqli_fetch_assoc($classResult);

// days and number of periods
$days = array(
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday'
);
$total_periods = 8;

// get all saved boxes of this class
$saved = array();
$sql = "SELECT timetable.day_no, timetable.period_no, timetable.subject_id, timetable.teacher_id,
               subjects.name AS subject_name, teachers.name AS teacher_name
        FROM timetable
        LEFT JOIN subjects ON subjects.id = timetable.subject_id
        LEFT JOIN teachers ON teachers.id = timetable.teacher_id
        WHERE timetable.classno = $classno";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $key = $row['day_no'] . '-' . $row['period_no'];
    $saved[$key] = $row;
}

// lists for the dropdowns
$subjectList = mysqli_query($conn, "SELECT * FROM subjects ORDER BY name");
$teacherList = mysqli_query($conn, "SELECT * FROM teachers ORDER BY name");
?>

<div class="container mt-4">

    <h3>Timetable - Class <?php echo $class['name']; ?></h3>
    <a href="/Website/SMS/index.php?timetable=true" class="btn btn-secondary mb-3">Back to classes</a>

    <?php if (isset($_GET['msg'])) { ?>
        <?php if ($_GET['msg'] == 'saved') { ?>
            <div class="alert alert-success">Timetable updated.</div>
        <?php } ?>
        <?php if ($_GET['msg'] == 'cleared') { ?>
            <div class="alert alert-info">Box cleared.</div>
        <?php } ?>
    <?php } ?>

    <?php if (isset($_GET['error'])) { ?>
        <?php if ($_GET['error'] == 'clash') { ?>
            <div class="alert alert-danger">
                Not saved. This teacher is already teaching <?php echo htmlspecialchars($_GET['with']); ?> at that day and period.
            </div>
        <?php } else { ?>
            <div class="alert alert-danger">Something went wrong. Please try again.</div>
        <?php } ?>
    <?php } ?>

    <table class="table table-bordered text-center">
        <tr class="table-dark">
            <th>Day / Period</th>
            <?php for ($p = 1; $p <= $total_periods; $p++) { ?>
                <th>Period <?php echo $p; ?></th>
            <?php } ?>
        </tr>

        <?php foreach ($days as $day_no => $day_name) { ?>
            <tr>
                <th class="table-light"><?php echo $day_name; ?></th>

                <?php for ($p = 1; $p <= $total_periods; $p++) {

                    $key = $day_no . '-' . $p;
                    $subject_id = '';
                    $teacher_id = '';
                    $subject_name = '';
                    $teacher_name = '';

                    if (isset($saved[$key])) {
                        $subject_id = $saved[$key]['subject_id'];
                        $teacher_id = $saved[$key]['teacher_id'];
                        $subject_name = $saved[$key]['subject_name'];
                        $teacher_name = $saved[$key]['teacher_name'];
                    }
                ?>
                    <td style="cursor:pointer;"
                        data-bs-toggle="modal"
                        data-bs-target="#slotModal"
                        data-day="<?php echo $day_no; ?>"
                        data-dayname="<?php echo $day_name; ?>"
                        data-period="<?php echo $p; ?>"
                        data-subject="<?php echo $subject_id; ?>"
                        data-teacher="<?php echo $teacher_id; ?>">

                        <?php if ($subject_id != '') { ?>
                            <strong><?php echo htmlspecialchars($subject_name); ?></strong><br>
                            <small><?php echo htmlspecialchars($teacher_name); ?></small>
                        <?php } else { ?>
                            +
                        <?php } ?>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
</div>

<!-- Popup form -->
<div class="modal fade" id="slotModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="/Website/SMS/database/requests.php">

            <div class="modal-header">
                <h5 class="modal-title" id="slotTitle">Edit period</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="classno" value="<?php echo $classno; ?>">
                <input type="hidden" name="day_no" id="f_day">
                <input type="hidden" name="period_no" id="f_period">

                <label class="form-label">Subject</label>
                <select name="subject_id" id="f_subject" class="form-select mb-3" required>
                    <option value="">Select subject</option>
                    <?php while ($s = mysqli_fetch_assoc($subjectList)) { ?>
                        <option value="<?php echo $s['id']; ?>"><?php echo htmlspecialchars($s['name']); ?></option>
                    <?php } ?>
                </select>

                <label class="form-label">Teacher</label>
                <select name="teacher_id" id="f_teacher" class="form-select" required>
                    <option value="">Select teacher</option>
                    <?php while ($t = mysqli_fetch_assoc($teacherList)) { ?>
                        <option value="<?php echo $t['id']; ?>"><?php echo htmlspecialchars($t['name']); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="modal-footer">
                <button type="submit" name="clear_slot" class="btn btn-outline-danger me-auto" formnovalidate>Clear</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="save_slot" class="btn btn-primary">Update</button>
            </div>

        </form>
    </div>
</div>

<script>
document.getElementById('slotModal').addEventListener('show.bs.modal', function (event) {
    var cell = event.relatedTarget;
    document.getElementById('f_day').value = cell.dataset.day;
    document.getElementById('f_period').value = cell.dataset.period;
    document.getElementById('f_subject').value = cell.dataset.subject;
    document.getElementById('f_teacher').value = cell.dataset.teacher;
    document.getElementById('slotTitle').textContent = cell.dataset.dayname + ' - Period ' + cell.dataset.period;
});
</script>