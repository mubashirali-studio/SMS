<?php
include('database/db.php');

$result = mysqli_query($conn, "SELECT * FROM teachers ORDER BY name");
?>

<div class="container mt-4">
    <h3>Who is taking attendance?</h3>
    <p class="text-muted">Click your name to continue. (Temporary until login is added.)</p>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <a class="btn btn-outline-primary m-1"
           href="/Website/SMS/index.php?attendance=true&setteacher=<?php echo $row['id']; ?>">
            <?php echo htmlspecialchars($row['name']); ?>
        </a>
    <?php } ?>
</div>