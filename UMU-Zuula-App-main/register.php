<?php
// register.php included by index.php
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="text-white text-center py-4 px-4" style="background: linear-gradient(135deg, #9B0F06, #c0392b);">
                    <i class="ri-user-add-line fs-1"></i>
                    <h3 class="fw-bold mb-1 mt-2">UMU Registration</h3>
                    <p class="mb-0 fs-6">Create your student/staff account</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form id="public-register-form" action="" method="POST" autocomplete="off">
                        <div class="row g-3">
                            <div class="col-sm-6 mb-2">
                                <label class="form-label fw-bold"><i class="ri-user-line me-1"></i> First Name</label>
                                <input type="text" name="firstname" class="form-control bg-light rounded-pill px-3" required>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="form-label fw-bold"><i class="ri-user-line me-1"></i> Last Name</label>
                                <input type="text" name="lastname" class="form-control bg-light rounded-pill px-3" required>
                            </div>
                            <div class="col-12 mb-2">
                                <label class="form-label fw-bold"><i class="ri-hashtag me-1"></i> UMU Reg Number / Staff ID</label>
                                <input type="text" name="username" class="form-control bg-light rounded-pill px-3" placeholder="e.g. 2023-B293-11234" required>
                            </div>
                            <div class="col-12 mb-2">
                                <label class="form-label fw-bold"><i class="ri-mail-line me-1"></i> Email Address</label>
                                <input type="email" name="email" class="form-control bg-light rounded-pill px-3" placeholder="student@umu.ac.ug" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label fw-bold"><i class="ri-lock-line me-1"></i> Password</label>
                                <input type="password" name="password" id="reg_password" class="form-control bg-light rounded-pill px-3" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label fw-bold"><i class="ri-lock-check-line me-1"></i> Confirm Password</label>
                                <input type="password" name="cpassword" class="form-control bg-light rounded-pill px-3" required>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                    <label class="form-check-label text-muted small" for="terms">I agree to the <a href="#" class="text-decoration-none">Terms & Conditions</a> of the UMU Lost and Found System.</label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success btn-lg w-100 rounded-pill shadow fw-bold mb-4" type="submit">Complete Registration</button>
                    </form>
                    <div class="text-center text-muted">
                        Already have an account? <a href="./?page=login" class="fw-bold text-decoration-none text-success ms-1">Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#public-register-form').submit(function(e){
            e.preventDefault();
            
            var pass = $('[name="password"]').val();
            var cpass = $('[name="cpassword"]').val();
            if(pass !== cpass) {
                alert_toast("Passwords do not match!", "error");
                return false;
            }

            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Users.php?f=save",
                method: 'POST',
                data: $(this).serialize(),
                error: err => {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function(resp){
                    if(resp == 1){
                        alert_toast("Registration Successful. Please login.", "success");
                        setTimeout(() => {
                            location.href = './?page=login';
                        }, 2000);
                    } else if(resp == 2){
                         alert_toast("Username or Email already exists", "error");
                         end_loader();
                    } else {
                        alert_toast("An error occurred", 'error');
                        end_loader();
                    }
                }
            })
        })
    })
</script>
