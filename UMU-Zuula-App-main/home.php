<?php 
require_once('classes/DBConnection.php');
$db = new DBConnection();
// Query counts for ticker (status 1 is lost? Need to be sure but assuming 1: Lost, 2: Found, 3: Claimed)
try {
    $lost_count = $db->pdo->query("SELECT count(id) from item_list where status = 1")->fetchColumn();
    $found_count = $db->pdo->query("SELECT count(id) from item_list where status = 2")->fetchColumn(); // Still show count of found items? Or only active found?
    // Let's stick to status 1 for "Active Gallery"
    $categories = $db->pdo->query("SELECT * FROM category_list WHERE status = 1")->fetchAll();
    $recent_items = $db->pdo->query("SELECT * FROM item_list WHERE status = 1 ORDER BY created_at DESC LIMIT 30")->fetchAll();
} catch (Exception $e) {
    $lost_count = $found_count = 0;
    $categories = [];
    $recent_items = [];
}
?>
<div class="col-12" style="margin-top: -24px; margin-left: -24px; margin-right: -24px; width: calc(100% + 48px); padding: 0;">
    <!-- Hero Section -->
    <div class="text-white px-4 py-5 text-center" style="background: linear-gradient(135deg, #134E8E, #1a6ab5);">
        <h1 class="display-4 fw-bold mb-3" style="color: #ECE7D1;">UMU-Zuula</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4" style="color: rgba(255,255,255,0.9);">Easily report, search, and reclaim your lost properties across the Uganda Martyrs University campus.</p>
            <form action="./" method="GET" class="d-flex justify-content-center mb-4">
                <input type="hidden" name="page" value="search">
                <input type="text" name="q" class="form-control form-control-lg border-0 shadow-sm me-2" placeholder="Search items (e.g., ID Card, Laptop)..." style="max-width: 450px;" required>
                <button type="submit" class="btn btn-lg shadow-sm fw-bold" style="background:#9B0F06; color:#fff;">Search</button>
            </form>
            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                <a href="./?page=login&action=report_lost" class="btn btn-lg px-4 fw-bold shadow" style="background:#9B0F06; color:#fff;">Report Lost Item</a>
                <a href="./?page=found" class="btn btn-lg px-4 fw-bold shadow" style="background:#ECE7D1; color:#134E8E;">Report Found Item</a>
            </div>
            <div class="mt-4 d-flex justify-content-center gap-5 fs-5">
                <div><i class="ri-error-warning-line me-1"></i> <strong><?= $lost_count ?></strong> Listed Lost</div>
                <div><i class="ri-checkbox-circle-line me-1"></i> <strong><?= $found_count ?></strong> Listed Found</div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <!-- How it works -->
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-4" style="color:#134E8E;">How it Works</h2>
        <div class="row g-4 px-4 py-2">
            <div class="col-md-4">
                <div class="bg-light rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i class="ri-search-eye-line fs-1" style="color:#134E8E;"></i>
                </div>
                <h4 class="fw-bold">1. Search</h4>
                <p class="text-muted small">Browse our responsive database or search for your lost item using keywords and location filters.</p>
                <a href="./?page=items" class="btn btn-sm rounded-pill px-3 mt-1" style="border:1px solid #134E8E; color:#134E8E;"><i class="ri-search-line me-1"></i> Browse All</a>
            </div>
            <div class="col-md-4">
                <div class="bg-light rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i class="ri-megaphone-line fs-1" style="color:#9B0F06;"></i>
                </div>
                <h4 class="fw-bold">2. Report</h4>
                <p class="text-muted small">Can't find it? Submit a detailed report of what you lost or what you found on campus.</p>
                <a href="./?page=found" class="btn btn-sm rounded-pill px-3 mt-1" style="border:1px solid #9B0F06; color:#9B0F06;"><i class="ri-add-circle-line me-1"></i> Report Item</a>
            </div>
            <div class="col-md-4">
                <div class="bg-light rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i class="ri-hand-coin-line fs-1" style="color:#134E8E;"></i>
                </div>
                <h4 class="fw-bold">3. Claim</h4>
                <p class="text-muted">Provide adequate proof of ownership to claim your property from the designated office securely.</p>
            </div>
        </div>
    </div>

    <!-- Category Chips -->
    <div class="text-center mb-5">
        <h4 class="fw-bold mb-3" style="color:#134E8E;">Filter by Category</h4>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="./?page=items" class="btn rounded-pill fw-bold text-white" style="background:#134E8E;">All Items</a>
            <?php foreach($categories as $cat): ?>
                <a href="./?page=search&category=<?= $cat['id'] ?>" class="btn rounded-pill fw-bold text-white" style="background:#134E8E;"><?= htmlspecialchars($cat['name']) ?></a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Recent Items Grid -->
    <div class="mb-5 pb-5">
        <h2 class="fw-bold mb-4" style="color:#9B0F06;">Recent Items</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php foreach($recent_items as $item): ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="position-relative">
                        <?php if(!empty($item['image_path']) && is_file(base_app.$item['image_path'])): ?>
                            <img src="<?= validate_image($item['image_path']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['title']) ?>" style="height:220px; object-fit:cover;">
                        <?php else: ?>
                            <div class="bg-dark text-white d-flex align-items-center justify-content-center" style="height:220px;">
                                <i class="ri-image-line fs-1 text-muted"></i>
                            </div>
                        <?php endif; ?>
                        <div class="position-absolute top-0 end-0 p-2">
                            <span class="badge rounded-pill fs-6 <?= $item['status'] == 1 ? 'bg-danger' : 'bg-success' ?> shadow-sm">
                                <?= $item['status'] == 1 ? 'Lost' : 'Found' ?>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <small class="text-muted d-block mb-1"><i class="ri-calendar-line"></i> <?= date("M d, Y", strtotime($item['created_at'])) ?></small>
                        <h5 class="card-title fw-bold text-truncate"><?= htmlspecialchars($item['title']) ?></h5>
                        <p class="card-text text-muted" style="display: -webkit-box; -webkit-line-clamp: 2; line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            <?= strip_tags(htmlspecialchars_decode($item['description'])) ?>
                        </p>
                        <div class="text-primary small fw-bold mt-2 text-truncate">
                            <i class="ri-map-pin-2-line me-1"></i> <?= htmlspecialchars($item['pickup_location'] ?? 'UMU Campus') ?>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 pt-0 pb-3">
                        <a href="./?page=item_detail&id=<?= $item['id'] ?>" class="btn btn-outline-primary w-100 rounded-pill fw-bold">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="./?page=search" class="btn btn-primary btn-lg rounded-pill shadow-sm px-5">Browse All Items</a>
        </div>
    </div>
</div>