<?php
$id = $_GET['id'] ?? 0;
// Mock data loading
?>
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h4 class="card-title fw-bold mb-4">Claim Found Item</h4>
        <div class="alert alert-info border-0 shadow-sm rounded-3 mb-4">
            <i class="ri-information-line fs-4 align-middle me-2"></i>
            You are claiming <strong>Item #<?= htmlspecialchars($id) ?></strong>. Please provide as much detail as possible to prove ownership.
        </div>
        
        <form action="" id="claim-form" class="row g-3">
            <input type="hidden" name="item_id" value="<?= htmlspecialchars($id) ?>">
            
            <div class="col-12">
                <label class="form-label fw-bold">Proof of Ownership / Distinguishing Marks</label>
                <textarea name="proof_description" class="form-control" rows="5" required placeholder="Describe hidden marks, serial numbers, passwords, lock screen wallpaper, or any detail only the owner would know..."></textarea>
            </div>
            
            <div class="col-12">
                <label class="form-label fw-bold">Supporting Evidence (Optional)</label>
                <p class="text-muted small mb-2">Upload a receipt, an older photo of you with the item, or a warranty card.</p>
                <input type="file" name="proof_file" class="form-control" accept="image/*,.pdf">
            </div>
            
            <div class="col-12 mt-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="declareCheck" required>
                    <label class="form-check-label fw-bold text-danger" for="declareCheck">
                        I declare that I am the rightful owner of this item. I understand that submitting a false claim is a violation of University policy.
                    </label>
                </div>
            </div>
            
            <div class="col-12 text-end mt-4 border-top pt-3">
                <button type="button" class="btn btn-secondary rounded-pill me-2 px-4" onclick="history.back()">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-pill px-5 shadow fw-bold">Submit Claim</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#claim-form').submit(function(e){
        e.preventDefault();
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_claim",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: err => {
                console.log(err);
                alert_toast("An error occurred", 'error');
                end_loader();
            },
            success: function(resp){
                if(resp.status == 'success'){
                    location.href = './?page=my_claims';
                }else{
                    alert_toast("An error occurred", 'error');
                    end_loader();
                }
            }
        })
    })
</script>
