<?php
// reset_password.php included by index.php
$token = $_GET['token'] ?? '';
if(empty($token)){
    echo "<script>location.href='./?page=login';</script>";
}
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="bg-dark text-white text-center py-4 px-4">
                    <i class="ri-lock-password-line fs-1"></i>
                    <h3 class="fw-bold mb-1 mt-2">New Password</h3>
                    <p class="mb-0 fs-6">Secure your account</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form id="reset-password-form" action="" method="POST">
                        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                        <div class="mb-3">
                            <label class="form-label fw-bold">New Password</label>
                            <input type="password" name="password" class="form-control form-control-lg rounded-pill px-4 bg-light" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Confirm Password</label>
                            <input type="password" name="cpassword" class="form-control form-control-lg rounded-pill px-4 bg-light" required>
                        </div>
                        <button class="btn btn-dark btn-lg w-100 rounded-pill shadow fw-bold mb-2" type="submit">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#reset-password-form').submit(function(e){
            e.preventDefault();
            var p1 = $('[name="password"]').val();
            var p2 = $('[name="cpassword"]').val();
            if(p1 !== p2){
                alert_toast("Passwords do not match", "error");
                return false;
            }
            start_loader();
            setTimeout(() => {
                alert_toast("Password updated successfully!", "success");
                location.href = './?page=login';
                end_loader();
            }, 1000);
        })
    })
</script>
