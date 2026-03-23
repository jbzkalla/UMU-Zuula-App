<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="card-title fw-bold mb-4">My Submitted Claims</h5>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Claim ID</th>
                        <th>Item Claimed</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                        <th>Admin Note</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $user_id = $_settings->userdata('id');
                    $qry = $conn->query("SELECT c.*, i.title as item_title 
                                        FROM `claims` c 
                                        INNER JOIN `item_list` i ON c.item_id = i.id 
                                        WHERE c.user_id = '{$user_id}' 
                                        ORDER BY abs(unix_timestamp(c.created_at)) DESC");
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="fw-bold">CLM-<?php echo str_pad($row['id'], 5, '0', STR_PAD_LEFT) ?></td>
                        <td><?php echo $row['item_title'] ?></td>
                        <td><?php echo date("M d, Y", strtotime($row['created_at'])) ?></td>
                        <td>
                            <?php if($row['status'] == 0): ?>
                                <span class="badge bg-secondary rounded-pill px-3 shadow-sm">Pending Review</span>
                            <?php elseif($row['status'] == 1): ?>
                                <span class="badge bg-success rounded-pill px-3 shadow-sm">Approved</span>
                            <?php else: ?>
                                <span class="badge bg-danger rounded-pill px-3 shadow-sm">Rejected</span>
                            <?php endif; ?>
                        </td>
                        <td><small class="text-muted"><?php echo !empty($row['admin_note']) ? $row['admin_note'] : "N/A" ?></small></td>
                        <td>
                            <a href="../?page=view_claim&id=<?php echo $row['id'] ?>&token=<?php echo md5($row['id'].$user_id) ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3"><i class="ri-eye-line"></i> Detail</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="ri-shield-check-line fs-1 d-block mb-3"></i>
                            You have no active claims.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
