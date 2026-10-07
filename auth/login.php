<?php
include_once __DIR__ . '/../database/db.php';
?>

<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="card shadow-sm" style="width: 100%; max-width: 420px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">Log In</h3>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger">Invalid email or password.</div>
            <?php } ?>

            <form method="POST" action="/Website/SMS/database/requests.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
                <button type="submit" name="login_user" class="btn btn-primary w-100">Log In</button>
            </form>

            <p class="text-center mt-3 mb-0">
                Applying as a new student? <a href="/Website/SMS/admission.php">Apply for Admission</a>
            </p>
        </div>
    </div>
</div>