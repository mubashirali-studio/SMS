<?php
include('database/db.php');

$stmt = $conn->query("SELECT * FROM subjects");
$subjects = $stmt->fetch_all(MYSQLI_ASSOC);
?> 

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Subjects</h3>
    <a href="?addsub=true" class="btn btn-primary">+ Add Subject</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Subject Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subjects as $subject): ?>
                <tr>
                    <td><?= htmlspecialchars($subject['id']) ?></td>
                    <td><?= htmlspecialchars(ucfirst($subject['name'])) ?></td>
                    <td>
                        <a href="?delsub=true&id=<?= $subject['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this subject?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>