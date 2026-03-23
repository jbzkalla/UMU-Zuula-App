<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title fw-bold mb-4 text-center">Change Password</h5>
                
                <form id="change-pwd-form" action="" class="row g-3">
                    <div class="col-12 mb-2">
                        <label class="form-label fw-bold">Current Password</label>
                        <input type="password" name="oldpassword" class="form-control bg-light" required>
                    </div>
                    <div class="col-12 mb-2">
                        <label class="form-label fw-bold">New Password</label>
                        <input type="password" name="newpassword" class="form-control bg-light" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Confirm New Password</label>
                        <input type="password" name="cpassword" class="form-control bg-light" required>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-dark w-100 rounded-pill shadow-sm fw-bold">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#change-pwd-form').submit(function(e){
        e.preventDefault();
        var n = $('[name="newpassword"]').val();
        var c = $('[name="cpassword"]').val();
        if(n !== c){
            alert_toast("New passwords do not match", "error");
            return false;
        }
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Users.php?f=update_password",
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp == 1){
                    alert_toast("Password changed successfully", "success");
                    $('[type="password"]').val('');
                }else if(resp == 2){
                    alert_toast("Current password is incorrect", "error");
                }else{
                    alert_toast("An error occured", "error");
                }
                end_loader();
            }
        })
    })
</script>
