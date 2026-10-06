<?php
include_once __DIR__ . '/../../database/db.php';

$result = mysqli_query($conn, "SELECT admission_requests.*, `class`.name AS classname
                               FROM admission_requests
                               LEFT JOIN `class` ON `class`.id = admission_requests.classno
                               WHERE admission_requests.status = 'pending'
                               ORDER BY admission_requests.created_at DESC");
?>

<div class="container mt-4 mb-5">
    <h3 class="fw-bold mb-4">Admission Queries</h3>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'added') { ?>
        <div class="alert alert-success">Student added successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'rejected') { ?>
        <div class="alert alert-info">Request rejected.</div>
    <?php } ?>

    <?php if (mysqli_num_rows($result) == 0) { ?>
        <div class="alert alert-info">No pending admission requests.</div>
    <?php } ?>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="mb-1"><?php echo htmlspecialchars($row['name']); ?></h5>
                    <p class="text-muted mb-1">
                        Applying for Class <?php echo htmlspecialchars($row['classname']); ?> -
                        <?php echo htmlspecialchars($row['academic_year']); ?>
                    </p>
                    <p class="mb-1"><strong>Father:</strong> <?php echo htmlspecialchars($row['father_name']); ?></p>
                    <p class="mb-1"><strong>Contact:</strong> <?php echo htmlspecialchars($row['contact']); ?></p>
                    <p class="mb-0"><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                </div>
                <form method="POST" action="/Website/SMS/database/requests.php">
                    <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                    <a href="?admission_view=true&request_id=<?php echo $row['id']; ?>" class="btn btn-outline-primary mb-1">View</a>
                    <button type="submit" name="approve_admission" class="btn btn-success mb-1">Add Student</button>
                    <button type="submit" name="reject_admission" class="btn btn-outline-danger">Reject</button>
                </form>
            </div>
        </div>
    <?php } ?>
</div>