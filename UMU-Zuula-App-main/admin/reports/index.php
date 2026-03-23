<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold mb-0">Analytics & Reports</h5>
            <div>
                <button class="btn btn-sm btn-outline-danger me-2"><i class="ri-file-pdf-line"></i> Export PDF</button>
                <button class="btn btn-sm btn-outline-success"><i class="ri-file-excel-line"></i> Export Excel</button>
            </div>
        </div>
        
        <form class="row g-3 mb-4 bg-light p-3 rounded-3 border">
            <div class="col-md-4">
                <label class="form-label fw-bold">From Date</label>
                <input type="date" class="form-control" name="start_date">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">To Date</label>
                <input type="date" class="form-control" name="end_date">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="button" class="btn btn-primary w-100 fw-bold">Filter Data</button>
            </div>
        </form>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Category</th>
                        <th>Items Lost</th>
                        <th>Items Found</th>
                        <th>Resolved Claims</th>
                        <th>Resolution Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $qry = $conn->query("SELECT c.name as category, 
                                        COUNT(CASE WHEN i.status = 1 THEN 1 END) as lost,
                                        COUNT(CASE WHEN i.status = 2 THEN 1 END) as found,
                                        COUNT(CASE WHEN i.status = 3 THEN 1 END) as resolved
                                        FROM category_list c 
                                        LEFT JOIN item_list i ON c.id = i.category_id 
                                        GROUP BY c.id ORDER BY c.name ASC");
                    while($row = $qry->fetch_assoc()):
                        $total_items = $row['lost'] + $row['found'] + $row['resolved'];
                        $rate = ($total_items > 0) ? ($row['resolved'] / $total_items) * 100 : 0;
                    ?>
                    <tr>
                        <td class="fw-bold"><?php echo $row['category'] ?></td>
                        <td class="text-center"><?php echo $row['lost'] ?></td>
                        <td class="text-center"><?php echo $row['found'] ?></td>
                        <td class="text-center"><?php echo $row['resolved'] ?></td>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="progress w-50 me-2" style="height: 6px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $rate ?>%"></div>
                                </div>
                                <span class="small fw-bold text-success"><?php echo number_format($rate) ?>%</span>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No data available for the current selection.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
