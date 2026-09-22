<?php
include('./assets/bootstrap.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="./index.php">School Management System</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="nav-link text-light">Hi, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                <?php endif; ?>
            </li>

            <?php if(isset($_SESSION['user']['username'])) { ?>
            <li class="nav-item"> 
                <a class="nav-link" href="#">Logout</a>
            </li>
            <?php } ?>
            
            <?php if(!isset($_SESSION['user']['username'])) { ?>
            <li class="nav-item">
            <a class="nav-link" href="?login=true">Log In</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="?signup=true">Sign Up</a>
            </li>
            <?php } ?>

        </ul>
    </div>
</nav>

<?php if(!isset($_GET['signup']) && !isset($_GET['login'])){ ?>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-light p-3" style="width: 220px; min-height: 100vh;">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="?dashboard=true">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="?students=true">Students</a></li>
            <li class="nav-item"><a class="nav-link" href="?teachers=true">Teachers</a></li>
            <li class="nav-item"><a class="nav-link" href="?classes=true">Classes</a></li>
            <li class="nav-item"><a class="nav-link" href="?sections=true">Sections</a></li>
            <li class="nav-item"><a class="nav-link" href="?subjects=true">Subjects</a></li>
            <li class="nav-item"><a class="nav-link" href="?fees=true">Fees</a></li>
        </ul>
    </div>
<?php } ?>
    <!-- Main content -->
    <div class="p-4 flex-grow-1">
</body>
</html>