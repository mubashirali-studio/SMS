<div class="d-flex justify-content-center">
    <div class="card shadow-sm" style="width: 100%; max-width: 500px;">
        <div class="card-body p-4">
            <h3 class="mb-4">Add Section</h3>

            <form method="POST" action="/Website/SMS/database/requests.php">
                <div class="mb-3">
                    <label for="class" class="form-label">Class</label>
                    <select class="form-control" name="classno" id="class">
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

                <div class="mb-3">
                    <label for="section_name" class="form-label">Section Name</label>
                    <select class="form-control" name="section_name" id="section_name" required>
                        <option value="">Select a section</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="save_sec" class="btn btn-primary">Save Section</button>
                    <a href="?sections=true" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>