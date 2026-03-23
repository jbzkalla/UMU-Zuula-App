<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="card-title fw-bold mb-4">My Submitted Reports</h5>

        <ul class="nav nav-tabs nav-tabs-bordered" id="reportsTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-bold" id="lost-tab" data-bs-toggle="tab" data-bs-target="#lost-reports" type="button" role="tab">Lost Reports</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold" id="found-tab" data-bs-toggle="tab" data-bs-target="#found-reports" type="button" role="tab">Found Reports</button>
            </li>
        </ul>
        
        <div class="tab-content pt-4" id="reportsTabContent">
            <!-- Lost Reports Tab -->
            <div class="tab-pane fade show active" id="lost-reports" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Item Title</th>
                                <th>Date Reported</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            $qry = $conn->query("SELECT * FROM `item_list` WHERE `status` != 0 AND `fullname` = '{$_settings->userdata('username')}' ORDER BY abs(unix_timestamp(created_at)) DESC");
                            while($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['title'] ?></td>
                                <td><?php echo date("M d, Y", strtotime($row['created_at'])) ?></td>
                                <td>
                                    <?php if($row['status'] == 1): ?>
                                        <span class="badge bg-danger rounded-pill px-3 shadow-sm">Active (Lost)</span>
                                    <?php elseif($row['status'] == 3): ?>
                                        <span class="badge bg-secondary rounded-pill px-3 shadow-sm">Resolved</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning rounded-pill px-3 shadow-sm">Reported</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="../?page=item_detail&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm"><i class="ri-eye-line"></i> View</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <?php if($qry->num_rows <= 0): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">You have no active lost item reports.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Found Reports Tab -->
            <div class="tab-pane fade" id="found-reports" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Item Title</th>
                                <th>Date Found</th>
                                <th>Holding At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            $qry = $conn->query("SELECT * FROM `item_list` WHERE `status` = 2 AND `fullname` = '{$_settings->userdata('username')}' ORDER BY abs(unix_timestamp(created_at)) DESC");
                            while($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['title'] ?></td>
                                <td><?php echo date("M d, Y", strtotime($row['created_at'])) ?></td>
                                <td><small class="text-muted"><?php echo $row['pickup_location'] ?? 'UMU Office' ?></small></td>
                                <td>
                                    <span class="badge bg-success rounded-pill px-3 shadow-sm">Active (Found)</span>
                                </td>
                                <td>
                                    <a href="../?page=item_detail&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm"><i class="ri-eye-line"></i> View</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <?php if($qry->num_rows <= 0): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">You haven't reported any found items yet.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
