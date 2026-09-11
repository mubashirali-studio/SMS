<?php
include(__DIR__ . '/../../database/db.php');

$stmt = $conn->query("SELECT * FROM teachers");
$teachers = $stmt->fetch_all(MYSQLI_ASSOC);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Teachers</h3>
    <a href="?addtch=true" class="btn btn-primary">+ Add Teacher</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>CNIC</th>
                <th>Qualification</th>
                <th>Specialization</th>
                <th>Contact</th>
                <th>Joining Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachers as $teacher): ?>
                <tr>
                    <td><?= htmlspecialchars($teacher['id']) ?></td>
                    <td><?= htmlspecialchars($teacher['name']) ?></td>
                    <td><?= htmlspecialchars($teacher['gender']) ?></td>
                    <td><?= htmlspecialchars($teacher['cnic']) ?></td>
                    <td><?= htmlspecialchars($teacher['qualification']) ?></td>
                    <td><?= htmlspecialchars($teacher['specialization']) ?></td>
                    <td><?= htmlspecialchars($teacher['contact']) ?></td>
                    <td><?= htmlspecialchars($teacher['joining_date']) ?></td>
                    <td>
                        <a href="?view_tch=true&id=<?= $teacher['id'] ?>" class="btn btn-sm btn-info">View</a>
                        <a href="?edit_tch=true&id=<?= $teacher['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="?delete_tch=true&id=<?= $teacher['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>