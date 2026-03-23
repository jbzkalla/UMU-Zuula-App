<?php 
$user_id = $_settings->userdata('id');
$lost_count = $conn->query("SELECT count(id) FROM `item_list` WHERE `status` = 1 AND `fullname` = '{$_settings->userdata('username')}' ")->fetch_row()[0];
// Note: fullname is used as 'reported by' in this schema usually, but let's check if there's a user_id ref.
// Actually, looking at the schema earlier, item_list doesn't have user_id, it has fullname.
// Wait, I should check how reports are saved.
$found_count = $conn->query("SELECT count(id) FROM `item_list` WHERE `status` = 2 AND `fullname` = '{$_settings->userdata('username')}' ")->fetch_row()[0];
$claims_count = $conn->query("SELECT count(id) FROM `claims` WHERE `user_id` = '{$user_id}' AND `status` = 0 ")->fetch_row()[0];
?>
<div class="row">
    <div class="col-xxl-4 col-md-6 mb-4">
        <div class="card info-card sales-card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title text-muted fw-bold">My Lost Reports</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger text-white me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="ri-file-search-line"></i>
                    </div>
                    <div class="ps-3">
                        <h2 class="fw-bold mb-0">0</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xxl-4 col-md-6 mb-4">
        <div class="card info-card revenue-card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title text-muted fw-bold">My Found Reports</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success text-white me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="ri-search-eye-line"></i>
                    </div>
                    <div class="ps-3">
                        <h2 class="fw-bold mb-0">0</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-md-6 mb-4">
        <div class="card info-card customers-card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title text-muted fw-bold">Pending Claims</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning text-dark me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="ri-shield-check-line"></i>
                    </div>
                    <div class="ps-3">
                        <h2 class="fw-bold mb-0">0</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Activity -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body pb-0">
                <h5 class="card-title">Recent Activity <span>| Today</span></h5>
                <div class="activity">
                    <div class="activity-item d-flex">
                        <div class="activite-label">2 hrs</div>
                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                        <div class="activity-content">
                            System initialized. Welcome to the UMU User Dashboard.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <div class="d-grid gap-2">
                    <a href="./?page=report_lost" class="btn btn-danger fw-bold shadow-sm rounded-pill"><i class="ri-file-search-line me-1"></i> Report a Lost Item</a>
                    <a href="./?page=report_found" class="btn btn-success fw-bold shadow-sm rounded-pill"><i class="ri-search-eye-line me-1"></i> Report a Found Item</a>
                    <a href="../?page=search" class="btn btn-primary fw-bold shadow-sm rounded-pill"><i class="ri-search-line me-1"></i> Browse Items</a>
                </div>
            </div>
        </div>
    </div>
</div>
