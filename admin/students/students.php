<?php
include('database/db.php');

$sectionFilter = $_GET['section'] ?? null;

if ($sectionFilter) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE section_id = $sectionFilter ORDER BY id DESC");
    $stmt->execute();
    $students = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    $stmt = $conn->query("SELECT * FROM students ORDER BY id DESC");
    $students = $stmt->fetch_all(MYSQLI_ASSOC);
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">
        Students
        <?php if ($sectionFilter): ?>
            <a href="?classes=true" class="btn btn-sm btn-outline-secondary ms-2">&larr; Back to Classes</a>
        <?php endif; ?>
    </h3>
    <a href="?addstd=true" class="btn btn-primary">+ Add Student</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
    <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Name</th>
        <th>DOB</th>
        <th>Gender</th>
        <th>CNIC</th>
        <th>Class No</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['id']) ?></td>
                    <td>
                        <?php
                        $photoPath = __DIR__ . '/../../assets/uploads/students/' . $student['pic'];
                        if (!empty($student['pic']) && file_exists($photoPath)):
                        ?>
                            <img src="/Website/SMS/assets/uploads/students/<?= htmlspecialchars($student['pic']) ?>" 
                                class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                style="width: 40px; height: 40px; font-size: 0.9rem;">
                                <?= strtoupper(substr($student['name'], 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($student['name']) ?></td>
                    <td><?= htmlspecialchars($student['dob']) ?></td>
                    <td><?= htmlspecialchars($student['gender']) ?></td>
                    <td><?= htmlspecialchars($student['cnic']) ?></td>
                    <td><?= htmlspecialchars($student['classno']) ?></td>
                    <td><?= htmlspecialchars($student['prim-no']) ?></td>
                    <td><?= htmlspecialchars($student['address']) ?></td>
                    <td>
                        <a href="?view=true&id=<?= $student['id'] ?>" class="btn btn-sm btn-info">View</a>
                        <a href="?edit=true&id=<?= $student['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="?assignsec=true&id=<?= $student['id'] ?>" class="btn btn-sm btn-secondary">Section</a>
                        <a href="?delete=true&id=<?= $student['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>