<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body>
  <style>
    body{
      background-color: #f6f9ff;
      overflow-x:hidden;
    }
    /* #page-title{
      text-shadow: 6px 4px 7px black;
      font-size: 3.5em;
      color: #fff4f4 !important;
      background: #8080801c;
    } */
    .logo img {
        max-height: 55px;
        margin-right: 25px;
    }
    .logo span{
      color: #9B0F06;
      font-weight: bold;
    }
  </style>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <span class="d-none d-lg-block text-center"><?= $_settings->info('name') ?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <div class="text-center mb-3">
                        <span class="badge rounded-pill bg-danger px-3 py-2 fs-6 shadow-sm"><i class="bi bi-shield-lock me-1"></i> ADMINISTRATOR ACCESS</span>
                    </div>
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate id="login-frm" autocomplete="off">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required autocomplete="off">
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required autocomplete="new-password">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <!-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div> -->
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12 text-center mt-3">
                      <a href="<?= base_url ?>?page=forgot_password" class="text-decoration-none small">Forgot Password?</a>
                    </div>
                    <div class="col-12 text-center mt-2">
                      <a href="<?= base_url ?>" class="text-decoration-none text-muted small"><i class="bi bi-house-door me-1"></i> Go Back to Home</a>
                    </div>
                    <!-- <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                    </div> -->
                  </form>

                </div>
              </div>



            </div>
          </div>
        </div>

      </section>

    </div>
  </main>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- jQuery -->
<script src="<?= base_url ?>assets/js/jquery-3.6.4.min.js"></script>
<script src="<?= base_url ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url ?>assets/vendor/chart.js/chart.umd.js"></script>
<script src="<?= base_url ?>assets/vendor/echarts/echarts.min.js"></script>
<script src="<?= base_url ?>assets/vendor/quill/quill.min.js"></script>
<script src="<?= base_url ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?= base_url ?>assets/vendor/tinymce/tinymce.min.js"></script>
<script src="<?= base_url ?>assets/vendor/php-email-form/validate.js"></script>
<script src="<?= base_url ?>assets/js/main.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
    $('#login-frm').submit(function(e){
        e.preventDefault()
        start_loader()
        if($('.err_msg').length > 0)
            $('.err_msg').remove()
        $.ajax({
            url:_base_url_+"classes/Login.php?f=login",
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
                console.log(err)
                alert_toast("An error occured",'error')
                end_loader()
            },
            success:function(resp){
                if(resp){
                    resp = JSON.parse(resp)
                    if(resp.status == 'success'){
                        if(resp.type == 'admin'){
                            location.replace(_base_url_+'admin');
                        } else {
                            // If they are not admin, they shouldn't be here, but we can redirect to user panel
                            location.replace(_base_url_+'user');
                        }
                    }else if(resp.status == 'incorrect'){
                        var _err = $('<div>')
                            _err.addClass('alert alert-danger err_msg')
                            _err.text("Incorrect Username or Password.")
                            $('#login-frm').prepend(_err)
                            end_loader()
                    }else{
                            console.log(resp)
                            alert_toast("An error occured",'error')
                            end_loader()
                    }
                }
            }
        })
    })
  })
</script>
</body>
</html>