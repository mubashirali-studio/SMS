<?php
include('database/db.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    die("No student ID provided.");
}

$stmt = $conn->prepare("SELECT * FROM students WHERE id = $id");
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    die("Student not found.");
}

$classno = $student['classno'];

$secStmt = $conn->prepare("SELECT * FROM sections WHERE classno = $classno");
$secStmt->execute();
$sections = $secStmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<div class="d-flex justify-content-center">
    <div class="card shadow-sm" style="width: 100%; max-width: 500px;">
        <div class="card-body p-4">
            <h3 class="mb-4">Assign Section</h3>
            <p><strong>Student:</strong> <?= htmlspecialchars($student['name']) ?> (Class <?= htmlspecialchars($classno) ?>)</p>

            <form method="POST" action="/Website/SMS/database/requests.php">
                <input type="hidden" name="student_id" value="<?= htmlspecialchars($student['id']) ?>">

                <div class="mb-3">
                    <label for="section_id" class="form-label">Section</label>
                    <select class="form-control" name="section_id" id="section_id" required>
                        <option value="">Select a section</option>
                        <?php foreach ($sections as $sec): ?>
                            <option value="<?= $sec['id'] ?>" <?= $student['section_id'] == $sec['id'] ? 'selected' : '' ?>>
                                Section <?= htmlspecialchars($sec['section_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (empty($sections)): ?>
                        <small class="text-danger">No sections exist yet for this class. Add one from the Sections page first.</small>
                    <?php endif; ?>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="assign_section" class="btn btn-primary">Save</button>
                    <a href="?students=true" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>