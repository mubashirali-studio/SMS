<?php
include('database/db.php');

$sql = "SELECT sections.id AS section_id, sections.section_name, class.id AS classno, class.name AS classname,
               attendance_assignment.teacher_id
        FROM sections
        JOIN class ON class.id = sections.classno
        LEFT JOIN attendance_assignment ON attendance_assignment.section_id = sections.id
        ORDER BY class.id, sections.section_name";
$result = mysqli_query($conn, $sql);

$teacherList = mysqli_query($conn, "SELECT * FROM teachers ORDER BY name");
$teachers = array();
while ($t = mysqli_fetch_assoc($teacherList)) {
    $teachers[] = $t;
}
?>

<div class="container mt-4">
    <h3>Assign Attendance Duty</h3>
    <p>Choose which teacher takes attendance for each class and section.</p>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'assigned') { ?>
        <div class="alert alert-success">Teacher assigned.</div>
    <?php } ?>

    <table class="table table-bordered align-middle">
        <tr class="table-dark">
            <th>Class</th>
            <th>Section</th>
            <th>Teacher</th>
            <th></th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <form method="POST" action="/Website/SMS/database/requests.php">
                    <td>
                        Class <?php echo ucfirst(htmlspecialchars($row['classname'])); ?>
                        <input type="hidden" name="classno" value="<?php echo $row['classno']; ?>">
                        <input type="hidden" name="section_id" value="<?php echo $row['section_id']; ?>">
                    </td>
                    <td>Section <?php echo htmlspecialchars($row['section_name']); ?></td>
                    <td>
                        <select name="teacher_id" class="form-select" required>
                            <option value="">Select teacher</option>
                            <?php foreach ($teachers as $t) {
                                $selected = ($t['id'] == $row['teacher_id']) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $t['id']; ?>" <?php echo $selected; ?>>
                                    <?php echo ucfirst(htmlspecialchars($t['name'])); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <button type="submit" name="assign_attendance" class="btn btn-primary">Save</button>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>
</div>