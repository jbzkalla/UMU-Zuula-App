<?php
require_once('classes/DBConnection.php');
$db = new DBConnection();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $db->pdo->prepare("SELECT i.*, c.name as category_name FROM item_list i LEFT JOIN category_list c ON i.category_id = c.id WHERE i.id = :id");
$stmt->execute([':id' => $id]);
$item = $stmt->fetch();

if(!$item) {
    echo "<script>alert('Item not found!'); location.href='./?page=search';</script>";
    exit;
}

// Fetch any additional images from item_images
$imgs_stmt = $db->pdo->prepare("SELECT * FROM item_images WHERE item_id = :id");
$imgs_stmt->execute([':id' => $id]);
$gallery = $imgs_stmt->fetchAll();
?>
<div class="container py-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-light p-3 rounded-pill shadow-sm px-4">
            <li class="breadcrumb-item"><a href="./" style="color:#134E8E;"><i class="ri-home-4-line"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="./?page=items" style="color:#134E8E;">Directory</a></li>
            <li class="breadcrumb-item active fw-bold" aria-current="page" style="color:#9B0F06;"><?= htmlspecialchars($item['title']) ?></li>
        </ol>
    </nav>
    
    <div class="row g-4">
        <!-- Gallery Section -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">
                <div class="position-absolute top-0 start-0 p-3 z-3">
                    <?php if($item['status'] == 1): ?>
                        <span class="badge rounded-pill fs-6 shadow-sm bg-danger">
                            <i class="ri-error-warning-line me-1"></i> Lost Item
                        </span>
                    <?php elseif($item['status'] == 2): ?>
                        <span class="badge rounded-pill fs-6 shadow-sm bg-success">
                            <i class="ri-checkbox-circle-line me-1"></i> Found Item
                        </span>
                    <?php elseif($item['status'] == 3): ?>
                        <span class="badge rounded-pill fs-6 shadow-sm bg-primary">
                            <i class="ri-checkbox-circle-line me-1"></i> Claimed / Resolved
                        </span>
                    <?php else: ?>
                        <span class="badge rounded-pill fs-6 shadow-sm bg-secondary">
                            <i class="ri-time-line me-1"></i> Pending Review
                        </span>
                    <?php endif; ?>
                </div>
                <?php if(!empty($item['image_path'])): ?>
                    <img src="<?= validate_image($item['image_path']) ?>" class="img-fluid w-100" style="height: 450px; object-fit: cover;">
                <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center" style="height: 400px; background: #ECE7D1;">
                        <i class="ri-image-line" style="font-size: 5rem; color:#134E8E; opacity:0.3;"></i>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if(!empty($gallery)): ?>
            <div class="d-flex gap-2 overflow-auto py-2">
                <?php foreach($gallery as $g): ?>
                    <img src="<?= validate_image($g['image_path']) ?>" class="rounded-3 shadow-sm border" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Info Section -->
        <div class="col-lg-6">
            <div class="ps-lg-4">
                <h1 class="fw-bold mb-2" style="color:#134E8E;"><?= htmlspecialchars($item['title']) ?></h1>
                
                <div class="d-flex align-items-center gap-3 text-muted mb-4 small fw-bold">
                    <span class="px-2 py-1 bg-light rounded text-uppercase" style="letter-spacing:0.5px;"><i class="ri-folder-2-line me-1"></i> <?= htmlspecialchars($item['category_name']) ?></span>
                    <span><i class="ri-calendar-line me-1"></i> Reported: <?= date("M d, Y", strtotime($item['created_at'])) ?></span>
                </div>
                
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2" style="color:#134E8E;"><i class="ri-information-line me-1"></i> Description</h5>
                        <div class="lh-lg mb-4 text-muted">
                            <?= nl2br(htmlspecialchars_decode($item['description'])) ?>
                        </div>
                        
                        <h5 class="fw-bold mb-3 mt-4" style="color:#9B0F06;"><i class="ri-map-pin-2-line me-1"></i> Location & Contact</h5>
                        <div class="p-3 rounded-4 border-start border-4" style="background:#ECE7D1; border-color:#9B0F06 !important;">
                            <p class="mb-2"><strong><i class="ri-building-line me-1"></i> Pickup Location:</strong> <?= htmlspecialchars($item['pickup_location'] ?? 'UMU Nkozi Main Campus') ?></p>
                            <p class="mb-0"><strong><i class="ri-phone-line me-1"></i> Contact:</strong> <?= htmlspecialchars($item['contact'] ?? 'Office of the Dean') ?></p>
                        </div>
                        <div class="mt-3 text-muted small px-2">
                            <i class="ri-error-warning-line me-1 text-danger"></i> <em>Note: Owners must provide proof of ownership (e.g. ID, password, receipt) to claim items.</em>
                        </div>
                    </div>
                </div>

                <!-- Action Card -->
                <div class="card border-0 shadow rounded-4 overflow-hidden" style="background:#134E8E;">
                    <div class="card-body p-4 text-center text-white">
                        <h5 class="fw-bold mb-2">Claim / Inquire Now</h5>
                        <p class="opacity-75 small mb-4">Interested in this item? Contact the reporter or visit the UMU-Zuula office.</p>
                        
                        <?php if($item['status'] == 2): ?>
                            <button onclick="alert_toast('Feature Coming Soon! Please visit the office located at Nkozi Main Campus.')" class="btn btn-lg w-100 rounded-pill fw-bold shadow-sm" style="background:#ECE7D1; color:#134E8E;">
                                <i class="ri-question-answer-line me-1"></i> This is My Item
                            </button>
                        <?php else: ?>
                            <button onclick="alert_toast('Feature Coming Soon! Please contact the student/office directly.')" class="btn btn-lg w-100 rounded-pill fw-bold shadow-sm" style="background:#ECE7D1; color:#134E8E;">
                                <i class="ri-chat-3-line me-1"></i> I Found This Item
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
