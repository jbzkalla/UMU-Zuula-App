<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="container-lg d-flex justify-content-between px-4">
    <div class="d-flex align-items-center justify-content-between">
      <a href="<?= base_url ?>" class="logo d-flex align-items-center">
        <img src="<?= base_url ?>uploads/logo.png" alt="UMU-Zuula" style="max-height:36px; margin-right:8px;">
        <span class="d-none d-lg-block"><?= $_settings->info('short_name') ?></span>
      </a>
    </div><!-- End Logo -->
    <nav class="header-nav me-auto">
      <ul class="d-flex align-items-center h-100 flex-wrap gap-1">
        <li class="nav-item">
            <a href="<?= base_url ?>" class="btn btn-sm btn-zuula-nav rounded-pill px-3"><i class="ri-home-4-line me-1"></i> Home</a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url.'?page=items' ?>" class="btn btn-sm btn-zuula-nav rounded-pill px-3"><i class="ri-search-line me-1"></i> Found Items</a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url.'?page=found' ?>" class="btn btn-sm btn-zuula-nav rounded-pill px-3"><i class="ri-add-circle-line me-1"></i> Report an Item</a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url.'?page=faqs' ?>" class="btn btn-sm btn-zuula-nav rounded-pill px-3"><i class="ri-question-line me-1"></i> FAQs</a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url."?page=about" ?>" class="btn btn-sm btn-zuula-nav rounded-pill px-3"><i class="ri-information-line me-1"></i> About</a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url.'?page=contact' ?>" class="btn btn-sm btn-zuula-nav rounded-pill px-3"><i class="ri-mail-send-line me-1"></i> Contact Us</a>
        </li>
      </ul>
    </nav><!-- End Icons Navigation -->
    <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url.'?page=login' ?>" class="btn btn-zuula-primary rounded-pill px-4 fw-bold shadow-sm"><i class="ri-login-box-line me-1"></i> Login</a>
    </div>
  </div>
</header><!-- End Header -->