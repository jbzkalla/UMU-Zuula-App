<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success"><i class="ri-search-eye-line me-2"></i> Report a Found Item</h5>
        <p class="text-muted">Thank you for bringing a found item to the system. Detail it carefully so the owner can claim it.</p>
        <form action="" id="report-found-form" class="row g-3">
            <input type="hidden" name="status" value="2">
            <div class="col-md-6">
                <label class="form-label fw-bold">Item Title</label>
                <input type="text" name="title" class="form-control" required placeholder="e.g. Black Wallet">
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
                <label class="form-label fw-bold">Description (Publicly Visible)</label>
                <textarea name="description" class="form-control" rows="4" required placeholder="Describe the item. DO NOT reveal highly sensitive internal details so the owner must prove ownership!"></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Where was it found?</label>
                <input type="text" name="contact" class="form-control" placeholder="e.g. Cafeteria Table" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Current Holding Location</label>
                <select name="holding_location" class="form-select" required>
                    <option value="security">Campus Security Desk</option>
                    <option value="dean">Dean of Students Office</option>
                    <option value="self">I am holding onto it</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Upload Photos</label>
                <input type="file" name="images[]" class="form-control" multiple accept="image/*">
            </div>
            <div class="col-12 text-end mt-4">
                <button type="button" class="btn btn-secondary rounded-pill me-2" onclick="location.href='./'">Cancel</button>
                <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm fw-bold">List Found Item</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#report-found-form').submit(function(e){
        e.preventDefault();
        start_loader();
        setTimeout(() => {
            alert_toast("Found Item successfully listed!", "success");
            location.href = './?page=my_reports';
        }, 1000);
    })
</script>
