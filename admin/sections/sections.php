<?php
include(__DIR__ . '/../../database/db.php');

$stmt = $conn->query("SELECT * FROM sections ORDER BY classno, section_name");
$sections = $stmt->fetch_all(MYSQLI_ASSOC);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Sections</h3>
    <a href="?addsec=true" class="btn btn-primary">+ Add Section</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Class No</th>
                <th>Section Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sections as $section): ?>
                <tr>
                    <td><?= htmlspecialchars($section['id']) ?></td>
                    <td><?= htmlspecialchars($section['classno']) ?></td>
                    <td><?= htmlspecialchars($section['section_name']) ?></td>
                    <td>
                        <a href="?students=true&section=<?= $section['id'] ?>" class="btn btn-sm btn-info">View Students</a>
                        <a href="?delsec=true&id=<?= $section['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this section?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>