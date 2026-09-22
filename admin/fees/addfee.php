<div class="d-flex justify-content-center">
    <div class="card shadow-sm" style="width: 100%; max-width: 600px;">
        <div class="card-body p-4">
            <h3 class="mb-4">Add Fee Record</h3>

            <form method="POST" action="/Website/SMS/database/requests.php">

                <div class="mb-3">
                    <label class="form-label">Apply Fee To</label>
                    <select class="form-control" name="apply_to" id="apply_to" onchange="toggleFeeTarget()" required>
                        <option value="school">Whole School</option>
                        <option value="class">Specific Class</option>
                        <option value="student">Specific Student</option>
                    </select>
                </div>

                <div class="mb-3" id="classField" style="display:none;">
                    <label for="classno" class="form-label">Select Class</label>
                    <select class="form-control" name="classno" id="classno">
                        <option value="">Select a class</option>
                        <?php
                            include(__DIR__ . '/../../database/db.php');
                            $result = $conn->query("SELECT * FROM class");
                            foreach ($result as $row) {
                                echo "<option value={$row['id']}>" . ucfirst($row['name']) . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-3" id="studentField" style="display:none;">
                    <label for="student_id" class="form-label">Select Student</label>
                    <select class="form-control" name="student_id" id="student_id">
                        <option value="">Select a student</option>
                        <?php
                            $result2 = $conn->query("SELECT id, name FROM students ORDER BY name");
                            foreach ($result2 as $row) {
                                echo "<option value={$row['id']}>" . htmlspecialchars($row['name']) . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fee_type" class="form-label">Fee Type</label>
                    <select class="form-control" name="fee_type" id="fee_type" required>
                        <option value="Exam Fee">Exam Fee</option>
                        <option value="Library Fee">Library Fee</option>
                        <option value="Transport Fee">Transport Fee</option>
                        <option value="Annual Fund">Annual Fund</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="month" class="form-label">Month</label>
                    <input type="text" class="form-control" id="month" name="month" placeholder="e.g. September 2026" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="amount_due" class="form-label">Amount Due</label>
                        <input type="number" class="form-control" id="amount_due" name="amount_due" min="0" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" required>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="save_fee" class="btn btn-primary">Save Fee Record</button>
                    <a href="?fees=true" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleFeeTarget() {
    var value = document.getElementById('apply_to').value;
    document.getElementById('classField').style.display = (value === 'class') ? 'block' : 'none';
    document.getElementById('studentField').style.display = (value === 'student') ? 'block' : 'none';
}
</script>