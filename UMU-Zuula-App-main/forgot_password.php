<?php
// forgot_password.php included by index.php
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="bg-warning text-dark text-center py-4 px-4" style="background: linear-gradient(135deg, #ffc107, #ffeb3b);">
                    <i class="ri-key-2-line fs-1"></i>
                    <h3 class="fw-bold mb-1 mt-2">Recover Password</h3>
                    <p class="mb-0 fs-6">We'll send you a reset link</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form id="forgot-password-form" action="" method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-bold"><i class="ri-mail-line me-1"></i> Registered Email</label>
                            <input type="email" name="email" class="form-control form-control-lg rounded-pill px-4 bg-light" placeholder="account@umu.ac.ug" required>
                        </div>
                        <button class="btn btn-warning btn-lg w-100 rounded-pill shadow fw-bold mb-4" type="submit">Send Reset Link</button>
                    </form>
                    <div class="text-center text-muted">
                        Remember your password? <a href="./?page=login" class="fw-bold text-decoration-none text-primary ms-1">Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#forgot-password-form').submit(function(e){
            e.preventDefault();
            start_loader();
            setTimeout(() => {
                alert_toast("If the email exists, a reset link will be sent.", "info");
                $('[name="email"]').val('');
                end_loader();
            }, 1000);
        })
    })
</script>
