<?php
include('database/db.php');

$teacher_id = (int) $_SESSION['teacher_id'];

$teacherResult = mysqli_query($conn, "SELECT * FROM teachers WHERE id = $teacher_id");
$teacher = mysqli_fetch_assoc($teacherResult);

$sql = "SELECT attendance_assignment.classno, attendance_assignment.section_id,
               class.name AS classname, sections.section_name
        FROM attendance_assignment
        JOIN class ON class.id = attendance_assignment.classno
        JOIN sections ON sections.id = attendance_assignment.section_id
        WHERE attendance_assignment.teacher_id = $teacher_id";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Welcome, <?php echo htmlspecialchars($teacher['name']); ?></h3>
        <a href="/Website/SMS/index.php?attendance=true&logout=true" class="btn btn-sm btn-secondary">Not you?</a>
    </div>

    <p class="text-muted">Today's date: <?php echo date('l, d F Y'); ?></p>

    <?php if (mysqli_num_rows($result) == 0) { ?>
        <div class="alert alert-info">No class has been assigned to you yet.</div>
    <?php } ?>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <a class="btn btn-primary m-1"
           href="/Website/SMS/index.php?attendance=true&classno=<?php echo $row['classno']; ?>&section_id=<?php echo $row['section_id']; ?>">
            Class <?php echo htmlspecialchars($row['classname']); ?> -
            Section <?php echo htmlspecialchars($row['section_name']); ?>
        </a>
    <?php } ?>
</div>