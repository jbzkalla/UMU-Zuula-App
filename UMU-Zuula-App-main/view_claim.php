<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT c.*, i.title as item_title, i.image_path as item_image, i.pickup_location 
                        FROM `claims` c 
                        INNER JOIN `item_list` i ON c.item_id = i.id 
                        WHERE c.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    } else {
        echo '<script>alert("Claim ID is unknown"); location.replace("./")</script>';
    }
} else {
    echo '<script>alert("Claim ID is required"); location.replace("./")</script>';
}
?>
<div class="container mt-5 pt-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="p-4 bg-light d-flex justify-content-between align-items-center">
            <h4 class="fw-bold mb-0" style="color:#134E8E;"><i class="ri-shield-check-line me-2"></i>Claim Details</h4>
            <div>
                <?php if($status == 0): ?>
                    <span class="badge bg-secondary rounded-pill px-4 shadow-sm">Pending Review</span>
                <?php elseif($status == 1): ?>
                    <span class="badge bg-success rounded-pill px-4 shadow-sm">Approved</span>
                <?php else: ?>
                    <span class="badge bg-danger rounded-pill px-4 shadow-sm">Rejected</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body p-5">
            <div class="row">
                <div class="col-md-5 text-center mb-4 mb-md-0 border-end">
                    <h6 class="text-muted fw-bold text-uppercase mb-3" style="font-size: 0.8rem;">Item Information</h6>
                    <img src="<?= validate_image($item_image) ?>" alt="" class="img-fluid rounded-4 shadow-sm mb-3" style="max-height: 250px;">
                    <h5 class="fw-bold"><?php echo $item_title ?></h5>
                    <p class="text-muted"><i class="ri-map-pin-2-line"></i> <?php echo $pickup_location ?? 'UMU Campus' ?></p>
                </div>
                <div class="col-md-7 ps-md-5">
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold text-uppercase mb-2" style="font-size: 0.8rem;">Your Proof of Ownership</h6>
                        <div class="bg-light p-4 rounded-4 border border-1">
                            <?php echo nl2br($proof_description) ?>
                        </div>
                    </div>

                    <?php if(!empty($admin_note)): ?>
                    <div class="mb-4">
                        <h6 class="text-success fw-bold text-uppercase mb-2" style="font-size: 0.8rem;">Administrative Feedback</h6>
                        <div class="alert alert-success rounded-4 border-0 shadow-sm">
                            <i class="ri-chat-1-line me-2"></i> <?php echo $admin_note ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="mt-5 pt-3">
                        <a href="./?page=user/my_claims" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm" style="background:#134E8E;"><i class="ri-arrow-left-line me-2"></i> Back to My Claims</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
