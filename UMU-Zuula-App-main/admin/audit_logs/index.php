<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold mb-0">System Audit Logs</h5>
            <button class="btn btn-sm btn-outline-secondary rounded-pill"><i class="ri-download-2-line"></i> Export CSV</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Timestamp</th>
                        <th>User ID</th>
                        <th>Action Performed</th>
                        <th>IP Address</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $qry = $conn->query("SELECT a.*, u.fullname, u.username FROM `audit_logs` a LEFT JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC");
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-nowrap text-muted small"><?php echo date("Y-m-d H:i", strtotime($row['created_at'])) ?></td>
                        <td><?php echo $row['fullname'] ?? 'System' ?> <small class="text-muted">(<?php echo $row['username'] ?? 'Guest' ?>)</small></td>
                        <td><span class="badge bg-primary"><?php echo $row['action'] ?></span></td>
                        <td><?php echo $row['ip_address'] ?></td>
                        <td class="text-truncate" style="max-width: 200px;"><?php echo $row['details'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No audit logs recorded.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
