<!-- Main Container to center the form vertically and horizontally -->
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!-- Restrict width using row and columns -->
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-5">
            <!-- Bootstrap Card wrapper -->
            <div class="card p-4 shadow-sm">
                
                <h3 class="text-center mb-4">Create Admin Account</h3>
                
                <form action="" method="POST">
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" placeholder="Enter your name">
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                    </div>

                    <!-- Role/Username Field (Fixed position based on your text "Admin") -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" value="Admin" readonly>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password">
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-4">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Re-enter password">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
