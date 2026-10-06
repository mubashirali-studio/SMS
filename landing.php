<?php
include_once __DIR__ . '/database/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Management System</title>
    <link href="assets/bootstrap.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>

<!-- Top bar -->
<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand mb-0 h1">School Management System</span>
    <div>
        <a href="?admission_form=true" class="btn btn-outline-light btn-sm me-2">Apply for Admission</a>
        <a href="?login=true" class="btn btn-outline-light btn-sm me-2">Log In</a>
        <a href="?signup=true" class="btn btn-light btn-sm">Sign Up</a>
    </div>
</nav>

<!-- Hero section -->
<div class="bg-primary text-white text-center py-5">
    <div class="container">
        <h1 class="fw-bold mb-3">Welcome to Greenfield Public School</h1>
        <p class="fs-5 mb-4">Providing quality education and a nurturing environment for students to grow, learn and succeed since 2005.</p>
        <a href="?admission_form=true" class="btn btn-light btn-lg fw-bold">Take Admission</a>
    </div>
</div>

<!-- About / feature cards -->
<div class="container py-5">
    <div class="row g-4 text-center">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2">Quality Education</h5>
                    <p class="text-muted mb-0">A well-rounded curriculum designed to help every student reach their full potential.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2">Experienced Teachers</h5>
                    <p class="text-muted mb-0">Our dedicated and qualified staff work closely with students both in and outside the classroom.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2">Modern Facilities</h5>
                    <p class="text-muted mb-0">Well-equipped classrooms, labs and a safe campus that supports learning every day.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <small>&copy; <?php echo date('Y'); ?> Greenfield Public School. All rights reserved.</small>
</footer>

</body>
</html>