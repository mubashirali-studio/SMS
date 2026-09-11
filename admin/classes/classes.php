<?php
include('database/db.php');

$classes = $conn->query("SELECT * FROM class ORDER BY id")->fetch_all(MYSQLI_ASSOC);
$sections = $conn->query("SELECT * FROM sections ORDER BY classno, section_name")->fetch_all(MYSQLI_ASSOC);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Classes</h3>
</div>

<?php foreach ($classes as $class): ?>
    <div class="card mb-3">
        <div class="card-header bg-dark text-white">
            <?= htmlspecialchars(ucfirst($class['name'])) ?>
        </div>
        <div class="card-body d-flex flex-wrap gap-2">
            <?php
            $hasSection = false;
            foreach ($sections as $sec):
                if ($sec['classno'] == $class['id']):
                    $hasSection = true;
            ?>
                <a href="?students=true&section=<?= $sec['id'] ?>" class="btn btn-outline-primary">
                    Section <?= htmlspecialchars($sec['section_name']) ?>
                </a>
            <?php
                endif;
            endforeach;

            if (!$hasSection):
            ?>
                <span class="text-muted">No sections added yet</span>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>