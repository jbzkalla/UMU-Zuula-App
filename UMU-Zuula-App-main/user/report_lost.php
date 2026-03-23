<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="card-title fw-bold">Report a Lost Item</h5>
        <form action="" id="report-lost-form" class="row g-3">
            <input type="hidden" name="status" value="1">
            <div class="col-md-6">
                <label class="form-label fw-bold">Item Title/Name</label>
                <input type="text" name="title" class="form-control" required placeholder="e.g. Blue Dell Laptop">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="1">Mobile Phones</option>
                    <option value="2">Keys</option>
                    <option value="3">Watches</option>
                    <option value="4">Laptops</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Description & Distinguishing Features</label>
                <textarea name="description" class="form-control" rows="4" required placeholder="Describe the item. Include any marks, colors, or serial numbers if known..."></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Date Lost</label>
                <input type="date" name="date_lost" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Last Known Location on Campus</label>
                <input type="text" name="contact" class="form-control" placeholder="e.g. Main Library, 2nd Floor" required>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Upload Photos (Optional)</label>
                <input type="file" name="images[]" class="form-control" multiple accept="image/*">
            </div>
            <div class="col-12 text-end mt-4">
                <button type="button" class="btn btn-secondary rounded-pill me-2" onclick="location.href='./'">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">Submit Report</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#report-lost-form').submit(function(e){
        e.preventDefault();
        start_loader();
        setTimeout(() => {
            alert_toast("Lost Item Report successfully submitted!", "success");
            location.href = './?page=my_reports';
        }, 1000);
    })
</script>
