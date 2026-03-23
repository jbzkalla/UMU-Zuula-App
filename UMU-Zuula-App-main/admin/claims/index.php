<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="card-title fw-bold mb-4">Manage Claims</h5>
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <colgroup>
                    <col width="5%">
                    <col width="20%">
                    <col width="25%">
                    <col width="20%">
                    <col width="15%">
                    <col width="15%">
                </colgroup>
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Claimant</th>
                        <th>Item Title</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $qry = $conn->query("SELECT c.*, i.title as item_title, u.username as claimant 
                                        FROM `claims` c 
                                        INNER JOIN `item_list` i ON c.item_id = i.id 
                                        INNER JOIN `users` u ON c.user_id = u.id 
                                        ORDER BY c.status ASC, abs(unix_timestamp(c.created_at)) DESC");
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td><?php echo $row['claimant'] ?></td>
                        <td><?php echo $row['item_title'] ?></td>
                        <td><?php echo date("Y-m-d g:i A", strtotime($row['created_at'])) ?></td>
                        <td class="text-center">
                            <?php if($row['status'] == 0): ?>
                                <span class="badge bg-secondary px-3 rounded-pill text-white">Pending</span>
                            <?php elseif($row['status'] == 1): ?>
                                <span class="badge bg-success px-3 rounded-pill">Approved</span>
                            <?php else: ?>
                                <span class="badge bg-danger px-3 rounded-pill">Rejected</span>
                            <?php endif; ?>
                        </td>
                        <td align="center">
                            <div class="dropdown">
                                <button type="button" class="btn btn-flat p-1 btn-default btn-sm border dropdown-toggle dropdown-icon" data-bs-toggle="dropdown">
                                        Action
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="./?page=claims/view_claim&id=<?php echo $row['id'] ?>"><span class="bi bi-card-text text-dark"></span> View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="bi bi-trash text-danger"></span> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No claims available.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(document).on('click', '.delete_data', function(){
            _conf("Are you sure to delete this claim permanently?","delete_claim",[$(this).attr('data-id')])
        })
        $('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: [5] }
            ],
            order:[0,'asc']
        });
    })
    function delete_claim($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_claim",
            method:"POST",
            data:{id: $id},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("An error occured.",'error');
                end_loader();
            },
            success:function(resp){
                if(typeof resp== 'object' && resp.status == 'success'){
                    location.reload();
                }else{
                    alert_toast("An error occured.",'error');
                    end_loader();
                }
            }
        })
    }
</script>
