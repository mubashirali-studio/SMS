<div class="d-flex justify-content-center">
    <div class="card shadow-sm" style="width: 100%; max-width: 750px;">
        <div class="card-body p-4">
            <h3 class="mb-4">Add Teacher</h3>

            <form method="POST" action="./database/requests.php" enctype="multipart/form-data">

                <h5 class="mt-2 mb-3 text-primary">Personal Information</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter teacher's name" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="" selected disabled>Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cnic" class="form-label">CNIC</label>
                        <input type="text" class="form-control" id="cnic" name="cnic" placeholder="XXXXX-XXXXXXX-X" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Teacher Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                </div>

                <hr class="my-4">

                <h5 class="mb-3 text-primary">Professional Information</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="qualification" class="form-label">Qualification</label>
                        <input type="text" class="form-control" id="qualification" name="qualification" placeholder="e.g. MSc Mathematics" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="specialization" class="form-label">Specialization / Subject</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" placeholder="e.g. Physics">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="experience_years" class="form-label">Years of Experience</label>
                        <input type="number" class="form-control" id="experience_years" name="experience_years" min="0" placeholder="e.g. 5">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="joining_date" class="form-label">Joining Date</label>
                        <input type="date" class="form-control" id="joining_date" name="joining_date" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" class="form-control" id="salary" name="salary" min="0" placeholder="e.g. 50000">
                </div>

                <hr class="my-4">

                <h5 class="mb-3 text-primary">Contact Information</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="03XX-XXXXXXX" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="emergency_contact" class="form-label">Emergency Contact</label>
                        <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" placeholder="03XX-XXXXXXX">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="teacher@example.com">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Home Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button href = "./teachers.php" type="submit" name="save_tch" class="btn btn-primary">Save Teacher</button>
                    <a href="?teachers=true" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div> 