<div class="d-flex justify-content-center">
    <div class="card shadow-sm" style="width: 100%; max-width: 500px;">
        <div class="card-body p-4">
            <h3 class="mb-4">Add Subject</h3>

            <form method="POST" action="./database/requests.php">
                <div class="mb-3">
                    <label for="name" class="form-label">Subject Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Mathematics" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="save_sub" class="btn btn-primary">Save Subject</button>
                    <a href="?subjects=true" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>