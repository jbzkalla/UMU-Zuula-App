<?php
// login.php included by index.php
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="text-white text-center py-4 px-4" style="background: linear-gradient(135deg, #134E8E, #1a6ab5);">
                    <i class="ri-user-lock-line fs-1"></i>
                    <h3 class="fw-bold mb-1 mt-2" style="color: #ECE7D1;">UMU-Zuula Portal Login</h3>
                    <div class="mt-2 mb-2">
                        <span class="badge rounded-pill bg-light text-primary px-3 py-2 fw-bold shadow-sm border"><i class="ri-user-smile-line me-1"></i> STUDENT & STAFF PORTAL</span>
                    </div>
                    <p class="mb-0 fs-6">Access your UMU-Zuula Dashboard</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form id="public-login-form" action="" method="POST" autocomplete="off">
                        <div class="mb-4">
                            <label class="form-label fw-bold"><i class="ri-user-line me-1"></i> UMU Email / ID</label>
                            <input type="text" name="username" class="form-control form-control-lg rounded-pill px-4 bg-light" placeholder="e.g. 2023-B293-11234" required autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold"><i class="ri-lock-line me-1"></i> Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control form-control-lg rounded-pill-start px-4 bg-light shadow-none" placeholder="Enter your password" required autocomplete="new-password">
                                <span class="input-group-text bg-light border-start-0 rounded-pill-end pe-4" style="cursor: pointer;" onclick="togglePassword()">
                                    <i class="ri-eye-off-line text-muted" id="toggleIcon"></i>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label text-muted" for="rememberMe">Remember me</label>
                            </div>
                            <a href="./?page=forgot_password" class="text-decoration-none fw-bold text-primary">Forgot Password?</a>
                        </div>
                        <button class="btn btn-primary btn-lg w-100 rounded-pill shadow fw-bold mb-4" type="submit">Login Now</button>
                    </form>
                    <div class="text-center text-muted">
                        Don't have an account? <a href="./?page=register" class="fw-bold text-decoration-none ms-1">Register here</a>
                    </div>
                    <div class="text-center mt-3">
                        <a href="./" class="text-decoration-none text-muted small"><i class="ri-home-4-line me-1"></i> Go Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        var x = document.getElementById("password");
        var y = document.getElementById("toggleIcon");
        if (x.type === "password") {
            x.type = "text";
            y.classList.remove("ri-eye-off-line");
            y.classList.add("ri-eye-line");
        } else {
            x.type = "password";
            y.classList.remove("ri-eye-line");
            y.classList.add("ri-eye-off-line");
        }
    }

    $(document).ready(function(){
        $('#public-login-form').submit(function(e){
            e.preventDefault();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Login.php?f=login",
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                error: err => {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function(resp){
                    if(resp.status == 'success'){
                        if(resp.type == 'admin'){
                            location.href = _base_url_ + 'admin/';
                        } else {
                            location.href = _base_url_ + 'user/';
                        }
                    } else if(resp.status == 'incorrect'){
                        alert_toast("Incorrect Email/Username or Password", 'error');
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
