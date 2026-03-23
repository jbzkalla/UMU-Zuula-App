<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold mb-0">Notifications</h5>
            <button class="btn btn-sm btn-outline-secondary rounded-pill">Mark all as read</button>
        </div>
        
        <div class="list-group list-group-flush">
            <?php 
            $user_id = $_settings->userdata('id');
            $qry = $conn->query("SELECT * FROM `notifications` WHERE user_id = '{$user_id}' ORDER BY created_at DESC");
            while($row = $qry->fetch_assoc()):
                $icon = 'ri-notification-3-line';
                $color = 'primary';
                if(strpos($row['title'], 'Approved') !== false) { $icon = 'ri-checkbox-circle-line'; $color = 'success'; }
                if(strpos($row['title'], 'Rejected') !== false) { $icon = 'ri-close-circle-line'; $color = 'danger'; }
                if(strpos($row['title'], 'Broadcast') !== false) { $icon = 'ri-broadcast-line'; $color = 'info'; }
            ?>
            <a href="<?php echo $row['link'] ? base_url.$row['link'] : '#' ?>" class="list-group-item list-group-item-action py-3 border-0 <?php echo $row['is_read'] == 0 ? 'bg-light' : '' ?> rounded-3 mb-2">
                <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1 fw-bold text-<?php echo $color ?>"><i class="<?php echo $icon ?> me-2"></i><?php echo $row['title'] ?></h6>
                    <small class="text-muted"><?php echo date("M d, H:i", strtotime($row['created_at'])) ?></small>
                </div>
                <p class="mb-1 text-muted small ms-4"><?php echo $row['message'] ?></p>
            </a>
            <?php endwhile; ?>
            
            <?php if($qry->num_rows <= 0): ?>
            <div class="text-center py-5 text-muted">
                <i class="ri-notification-off-line fs-1 d-block mb-3"></i>
                You have no notifications at the moment.
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
