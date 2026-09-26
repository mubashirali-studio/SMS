<?php
include_once __DIR__ . '/../../database/db.php';

// 6 days x 8 periods
$total_slots = 48;

// each class with the number of boxes already filled
$sql = "SELECT `class`.id, `class`.name, COUNT(timetable.id) AS filled
        FROM `class`
        LEFT JOIN timetable ON timetable.classno = `class`.id
        GROUP BY `class`.id, `class`.name
        ORDER BY `class`.id";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4 mb-5">

    <!-- Page heading -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Timetable</h3>
        <p class="text-muted mb-0">Select a class to create or edit its weekly timetable.</p>
    </div>

    <!-- Class cards -->
    <div class="row g-4">

        <?php while ($row = mysqli_fetch_assoc($result)) {

            $filled = (int) $row['filled'];
            $percent = round(($filled / $total_slots) * 100);

            if ($filled == 0) {
                $badge_class = 'bg-secondary';
                $badge_text = 'Not started';
                $bar_class = 'bg-secondary';
            } else if ($filled < $total_slots) {
                $badge_class = 'bg-warning text-dark';
                $badge_text = 'In progress';
                $bar_class = 'bg-warning';
            } else {
                $badge_class = 'bg-success';
                $badge_text = 'Complete';
                $bar_class = 'bg-success';
            }
        ?>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="/Website/SMS/index.php?timetable=true&classno=<?php echo $row['id']; ?>"
                   class="text-decoration-none text-dark">

                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body p-4">

                            <div class="fs-1 fw-bold text-primary">
                                <?php echo htmlspecialchars($row['name']); ?>
                            </div>
                            <div class="text-muted mb-3">Class</div>

                            <span class="badge <?php echo $badge_class; ?> mb-3">
                                <?php echo $badge_text; ?>
                            </span>

                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar <?php echo $bar_class; ?>"
                                     style="width: <?php echo $percent; ?>%;"></div>
                            </div>
                            <small class="text-muted">
                                <?php echo $filled; ?> / <?php echo $total_slots; ?> periods filled
                            </small>

                        </div>

                        <div class="card-footer bg-primary text-white text-center border-0">
                            Open timetable
                        </div>
                    </div>

                </a>
            </div>

        <?php } ?>

    </div>
</div>