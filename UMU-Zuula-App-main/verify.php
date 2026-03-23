<?php
// verify.php included by index.php
$token = $_GET['token'] ?? '';
?>
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden py-5">
                <div class="card-body">
                    <?php if(empty($token)): ?>
                        <i class="ri-error-warning-fill text-danger mb-3" style="font-size: 5rem;"></i>
                        <h2 class="fw-bold mb-3">Invalid Link</h2>
                        <p class="text-muted mb-4">The verification link is invalid or has expired.</p>
                        <a href="./?page=login" class="btn btn-outline-primary rounded-pill px-4">Back to Login</a>
                    <?php else: ?>
                        <i class="ri-mail-check-fill text-success mb-3" style="font-size: 5rem;"></i>
                        <h2 class="fw-bold mb-3">Account Verified!</h2>
                        <p class="text-muted mb-4">Your email has been successfully verified. You can now access your UMU-Zuula Dashboard.</p>
                        <a href="./?page=login" class="btn btn-success rounded-pill px-5 shadow fw-bold">Login to Continue</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
