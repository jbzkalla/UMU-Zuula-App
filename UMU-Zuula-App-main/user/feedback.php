<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="ri-star-line fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Rate Your Experience</h4>
                    <p class="text-muted">Help us improve the UMU Lost and Found System</p>
                </div>
                
                <form id="feedback-form" action="" class="row g-3">
                    <div class="col-12 text-center mb-3">
                        <label class="form-label fw-bold d-block">Overall Satisfaction</label>
                        <div class="fs-2 text-warning" style="cursor: pointer;">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-line"></i>
                        </div>
                        <input type="hidden" name="rating" value="4">
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Feedback Category</label>
                        <select name="category" class="form-select bg-light" required>
                            <option value="system">System Usability</option>
                            <option value="process">Claim Process</option>
                            <option value="staff">Staff Helpfulness</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="col-12 mb-4">
                        <label class="form-label fw-bold">Additional Comments</label>
                        <textarea name="comment" rows="4" class="form-control bg-light" placeholder="Tell us what you liked or what could be better..."></textarea>
                    </div>
                    
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm fw-bold">Submit Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#feedback-form').submit(function(e){
        e.preventDefault();
        start_loader();
        setTimeout(() => {
            alert_toast("Thank you for your feedback!", "success");
            $('[name="comment"]').val('');
            end_loader();
        }, 1000);
    })
</script>
