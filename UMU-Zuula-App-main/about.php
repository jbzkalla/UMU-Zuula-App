<?php
// Enhanced about.php for UMU-Zuula
?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5">
                <h1 class="fw-bold display-4" style="color:#134E8E;"><i class="ri-information-line me-2"></i>About UMU-Zuula</h1>
                <p class="lead text-muted mx-auto" style="max-width: 700px;">The official Lost and Found Information System for Uganda Martyrs University, Nkozi Main Campus.</p>
                <hr class="mx-auto opacity-100" style="width:100px; border-width:4px; border-color:#9B0F06;">
            </div>
            
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                        <div class="p-4 bg-primary text-white" style="background: linear-gradient(135deg, #134E8E, #1a6ab5) !important;">
                            <h4 class="fw-bold mb-0"><i class="ri-focus-3-line me-2"></i>Our Mission</h4>
                        </div>
                        <div class="card-body p-4">
                            <p class="lh-lg text-muted">
                                At <strong style="color:#9B0F06;">UMU-Zuula</strong>, our mission is to foster a culture of honesty and community support at Uganda Martyrs University. We aim to bridge the gap between lost properties and their rightful owners by providing a centralized, digital platform that replaces traditional noticeboards.
                            </p>
                            <p class="lh-lg text-muted">
                                We believe that technology can simplify the stressful experience of losing valuable items, from electronics and IDs to books and personal accessories, ensuring they find their way home safely.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                        <div class="p-4 bg-primary text-white" style="background: linear-gradient(135deg, #9B0F06, #bc1308) !important;">
                            <h4 class="fw-bold mb-0"><i class="ri-community-line me-2"></i>The Community</h4>
                        </div>
                        <div class="card-body p-4">
                            <p class="lh-lg text-muted">
                                This system specifically targets the students, faculty, and administrative staff at the **Nkozi Main Campus**. We recognize the bustling nature of university life where items can easily be misplaced in lecture halls, libraries, or recreational areas.
                            </p>
                            <ul class="list-unstyled text-muted lh-lg">
                                <li><strong><i class="ri-check-line text-success"></i> Secure:</strong> Verification required for all claims.</li>
                                <li><strong><i class="ri-check-line text-success"></i> Real-time:</strong> Instant updates on new reports.</li>
                                <li><strong><i class="ri-check-line text-success"></i> Inclusive:</strong> Accessible to everyone around Nkozi.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-5 text-center mb-5" style="background:#ECE7D1;">
                <h3 class="fw-bold mb-3" style="color:#134E8E;">How UMU-Zuula Works</h3>
                <p class="text-muted mb-4 px-lg-5">
                    Our platform simplifies retrieval into three easy steps: **Report, Search, and Claim.** If you find an item, report it with details and photos. If you lost something, browse our directory or search by keyword. Once a match is found, visit the office of the Dean of Students with your ID to securely claim your property.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="./?page=items" class="btn btn-lg rounded-pill px-4 fw-bold" style="background:#134E8E; color:#fff;">Browse Directory</a>
                    <a href="./?page=contact" class="btn btn-lg rounded-pill px-4 fw-bold" style="background:#9B0F06; color:#fff;">Contact Office</a>
                </div>
            </div>

            <div class="text-center text-muted small">
                <p>&copy; <?= date("Y") ?> UMU-Zuula Information System. Developed for Uganda Martyrs University.</p>
            </div>
        </div>
    </div>
</div>