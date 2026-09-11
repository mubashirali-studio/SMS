<div class="d-flex justify-content-center align-items-center" style="min-height: 50vh;">
    <div class="card shadow-sm" style="width: 100%; max-width: 420px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">Admin Login</h3>

            <form method="POST" action="login.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Log In</button>
            </form>
        </div>
    </div>
</div>