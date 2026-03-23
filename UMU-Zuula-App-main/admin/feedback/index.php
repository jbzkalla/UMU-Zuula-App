<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="card-title fw-bold mb-4">User Feedback & Ratings</h5>
        <div class="row mb-4">
            <?php 
            $stats = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(id) as total FROM `feedback`")->fetch_assoc();
            $avg = number_format($stats['avg_rating'], 1);
            $total = $stats['total'];
            ?>
            <div class="col-md-4">
                <div class="bg-light p-3 rounded-3 text-center border h-100 d-flex flex-column justify-content-center">
                    <h1 class="display-3 fw-bold text-success mb-0"><?php echo $avg ?></h1>
                    <div class="text-warning fs-4 mb-2">
                        <?php for($i=1; $i<=5; $i++): ?>
                            <i class="ri-star-<?php echo ($i <= round($avg)) ? 'fill' : 'line' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <span class="text-muted">Average Rating (<?php echo $total ?> Feedbacks)</span>
                </div>
            </div>
            <div class="col-md-8">
                <?php 
                for($i=5; $i>=1; $i--): 
                    $count = $conn->query("SELECT COUNT(id) FROM `feedback` WHERE rating = $i")->fetch_array()[0];
                    $perc = ($total > 0) ? ($count/$total) * 100 : 0;
                ?>
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2 text-muted fw-bold"><?php echo $i ?> star</span>
                    <div class="progress flex-grow-1" style="height: 10px;">
                        <div class="progress-bar bg-<?php echo ($i >= 4) ? 'success' : (($i >= 3) ? 'warning' : 'danger') ?>" role="progressbar" style="width: <?php echo $perc ?>%"></div>
                    </div>
                    <span class="ms-2 text-muted small"><?php echo number_format($perc) ?>%</span>
                </div>
                <?php endfor; ?>
            </div>
        </div>
        <hr>
        <div class="table-responsive mt-3">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th>Category</th>
                        <th>Rating</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $qry = $conn->query("SELECT f.*, u.fullname FROM `feedback` f LEFT JOIN users u ON f.user_id = u.id ORDER BY f.created_at DESC");
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td><small><?php echo date("M d, Y", strtotime($row['created_at'])) ?></small></td>
                        <td class="fw-bold"><?php echo $row['fullname'] ?? 'Guest' ?></td>
                        <td><span class="badge bg-light text-dark border"><?php echo $row['category'] ?></span></td>
                        <td class="text-warning">
                            <?php for($i=1; $i<=5; $i++): ?>
                                <i class="ri-star-<?php echo ($i <= $row['rating']) ? 'fill' : 'line' ?>"></i>
                            <?php endfor; ?>
                        </td>
                        <td><p class="mb-0 small text-muted"><?php echo $row['comment'] ?></p></td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No feedback recorded yet.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
