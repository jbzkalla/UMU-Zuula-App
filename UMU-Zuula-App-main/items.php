<?php
require_once('classes/DBConnection.php');
$db = new DBConnection();

$q = $_GET['q'] ?? '';
$cat_id = $_GET['category'] ?? '';
$status_filter = $_GET['status'] ?? '';

// Build Query
$sql = "SELECT i.*, c.name as category_name FROM item_list i LEFT JOIN category_list c ON i.category_id = c.id WHERE i.status IN (1,2)";
$params = [];

if($q !== '') {
    $sql .= " AND (i.title LIKE :q1 OR i.description LIKE :q2)";
    $params[':q1'] = "%$q%";
    $params[':q2'] = "%$q%";
}

if($cat_id !== '') {
    $sql .= " AND i.category_id = :cat_id";
    $params[':cat_id'] = $cat_id;
}

if($status_filter !== '') {
    $sql .= " AND i.status = :status";
    $params[':status'] = $status_filter;
}

$sql .= " ORDER BY i.created_at DESC";
$stmt = $db->pdo->prepare($sql);
$stmt->execute($params);
$items = $stmt->fetchAll();

$categories = $db->pdo->query("SELECT * FROM category_list WHERE status = 1")->fetchAll();
?>

<!-- Found Items Hero Banner -->
<div class="rounded-4 shadow overflow-hidden mb-4" style="position:relative;">
    <img src="<?= base_url ?>uploads/hero_banner.png" alt="UMU-Zuula Lost & Found" class="w-100" style="height:220px; object-fit:cover; filter:brightness(0.5);">
    <div style="position:absolute; top:0; left:0; right:0; bottom:0; display:flex; flex-direction:column; align-items:center; justify-content:center;">
        <h2 class="fw-bold text-white mb-3 text-shadow"><i class="ri-search-eye-line me-2"></i>Items Directory</h2>
        <p class="text-white-50 mb-3">Search through all reported lost and found items across UMU campus</p>
        <form action="./" method="GET" class="d-flex justify-content-center px-3" style="width: 100%; max-width: 600px;">
            <input type="hidden" name="page" value="items">
            <input type="text" name="q" class="form-control form-control-lg border-0 shadow-sm me-2 rounded-pill px-4" placeholder="Search by name, description..." value="<?= htmlspecialchars($q) ?>">
            <button type="submit" class="btn btn-lg fw-bold shadow-sm px-4 rounded-pill" style="background:#9B0F06; color:#fff; white-space:nowrap;"><i class="ri-search-line"></i> Search</button>
        </form>
    </div>
</div>

<div class="row g-4">
    <!-- Filters Sidebar -->
    <div class="col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3" style="color:#134E8E;"><i class="ri-filter-3-line me-1"></i> Quick Filters</h5>
                
                <div class="mb-4">
                    <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Item Status</label>
                    <div class="list-group list-group-flush border-0">
                        <a href="./?page=items&status=<?= $status_filter == '' ? '' : '' ?>&q=<?= $q ?>&category=<?= $cat_id ?>" class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center <?= $status_filter == '' ? 'fw-bold text-primary' : '' ?>">
                            <span><i class="ri-grid-fill me-2"></i> All Items</span>
                        </a>
                        <a href="./?page=items&status=1&q=<?= $q ?>&category=<?= $cat_id ?>" class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center <?= $status_filter == '1' ? 'fw-bold text-danger' : '' ?>">
                            <span><i class="ri-error-warning-fill me-2 text-danger"></i> Lost Items</span>
                        </a>
                        <a href="./?page=items&status=2&q=<?= $q ?>&category=<?= $cat_id ?>" class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center <?= $status_filter == '2' ? 'fw-bold text-success' : '' ?>">
                            <span><i class="ri-checkbox-circle-fill me-2 text-success"></i> Found Items</span>
                        </a>
                    </div>
                </div>

                <div class="mb-0">
                    <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Categories</label>
                    <div class="list-group list-group-flush border-0">
                        <?php foreach($categories as $cat): ?>
                        <a href="./?page=items&category=<?= $cat['id'] ?>&q=<?= $q ?>&status=<?= $status_filter ?>" class="list-group-item list-group-item-action border-0 px-0 <?= $cat_id == $cat['id'] ? 'fw-bold text-primary active-cat' : '' ?>">
                            <i class="ri-arrow-right-s-line me-1"></i> <?= htmlspecialchars($cat['name']) ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="background:#ECE7D1;">
            <div class="card-body p-4 text-center">
                <i class="ri-question-fill fs-2 mb-2 d-block" style="color:#134E8E;"></i>
                <h6 class="fw-bold mb-2">Can't find your item?</h6>
                <p class="small text-muted mb-3">Report it to our system to notify others who might find it.</p>
                <a href="./?page=found" class="btn btn-sm w-100 rounded-pill fw-bold" style="background:#9B0F06; color:#fff;">Report Missing Item</a>
            </div>
        </div>
    </div>

    <!-- Results Area -->
    <div class="col-lg-9">
        <?php if(empty($items)): ?>
            <div class="card border-0 shadow-sm rounded-4 text-center py-5">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width:80px; height:80px; background:#ECE7D1;">
                            <i class="ri-search-line fs-1" style="color:#9B0F06;"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold">No items found matching your filter</h4>
                    <p class="text-muted mb-4 px-lg-5">Try adjusting your keywords or switching filters to find what you are looking for.</p>
                    <a href="./?page=items" class="btn rounded-pill px-4 fw-bold" style="background:#134E8E; color:#fff;">View All Items</a>
                </div>
            </div>
        <?php else: ?>
            <div class="d-flex justify-content-between align-items-center mb-4 px-2">
                <h5 class="fw-bold mb-0">Showing <?= count($items) ?> Result(s)</h5>
                <div class="small text-muted">Sorted by Newest First</div>
            </div>
            
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach($items as $item): ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden item-card">
                        <div class="position-relative">
                            <?php if(!empty($item['image_path'])): ?>
                                <img src="<?= validate_image($item['image_path']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['title']) ?>" style="height:180px; object-fit:cover;">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center" style="height:180px; background:#ECE7D1;">
                                    <i class="ri-image-2-line fs-1" style="color:#134E8E;"></i>
                                </div>
                            <?php endif; ?>
                            <div class="position-absolute top-0 end-0 p-2">
                                <span class="badge rounded-pill shadow-sm <?= $item['status'] == 1 ? 'bg-danger' : 'bg-success' ?>">
                                    <?= $item['status'] == 1 ? 'Lost' : 'Found' ?>
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <span class="fw-bold x-small text-uppercase mb-1 d-block" style="color:#134E8E; letter-spacing:1px; font-size:10px;"><?= htmlspecialchars($item['category_name']) ?></span>
                            <h6 class="card-title fw-bold mb-2"><?= htmlspecialchars($item['title']) ?></h6>
                            <div class="mb-3">
                                <small class="text-muted d-block mb-1"><i class="ri-calendar-event-line me-1"></i> Reported: <?= date("M d, Y", strtotime($item['created_at'])) ?></small>
                                <small class="d-block mb-0 fw-bold" style="color:#9B0F06;"><i class="ri-map-pin-2-line me-1"></i> <?= htmlspecialchars($item['pickup_location'] ?? 'UMU Campus') ?></small>
                            </div>
                            <a href="./?page=item_detail&id=<?= $item['id'] ?>" class="btn btn-sm w-100 rounded-pill fw-bold mt-2" style="background:#134E8E; color:#fff;">View Details</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.active-cat { color: #134E8E !important; background: #f0f4f8; }
.item-card { transition: all 0.3s ease; }
.item-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
.text-shadow { text-shadow: 0 2px 4px rgba(0,0,0,0.5); }
.list-group-item { font-size: 14px; }
.list-group-item:hover { background: #f8f9fa; }
</style>
