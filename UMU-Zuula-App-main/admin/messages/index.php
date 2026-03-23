<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="card-title fw-bold mb-4">User Inbox & Inquiries</h5>
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Sender</th>
                        <th>Preview</th>
                        <th>Date Sent</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $qry = $conn->query("SELECT m.*, u.fullname, u.username, u.id as student_id 
                                        FROM `messages` m 
                                        INNER JOIN users u ON (m.sender_id = u.id OR m.receiver_id = u.id) 
                                        WHERE u.id != 1 
                                        AND m.id IN (SELECT MAX(id) FROM messages GROUP BY IF(sender_id=1, receiver_id, sender_id))
                                        ORDER BY m.created_at DESC");
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 30px; height: 30px; font-size: 0.8rem;"><?php echo substr($row['fullname'],0,1) ?></div>
                                <div>
                                    <div class="fw-bold" style="font-size: 0.9rem;"><?php echo $row['fullname'] ?></div>
                                    <small class="text-muted" style="font-size: 0.75rem;"><?php echo $row['username'] ?></small>
                                </div>
                            </div>
                        </td>
                        <td><p class="truncate-1 mb-0 text-muted" style="max-width:250px; font-size: 0.9rem;"><?php echo $row['message'] ?></p></td>
                        <td><small><?php echo date("M d, Y H:i", strtotime($row['created_at'])) ?></small></td>
                        <td class="text-center">
                            <?php if($row['receiver_id'] == 1 && $row['is_read'] == 0): ?>
                                <span class="badge bg-danger rounded-pill px-2" style="font-size: 0.7rem;">New</span>
                            <?php else: ?>
                                <span class="badge bg-light text-dark border rounded-pill px-2" style="font-size: 0.7rem;">Read</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-nowrap">
                            <a href="./?page=messages/view_message&id=<?php echo $row['student_id'] ?>" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm"><i class="bi bi-chat-dots"></i> Reply</a>
                            <button type="button" class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm delete_conversation" data-id="<?php echo $row['student_id'] ?>"><i class="bi bi-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Inbox is empty.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.delete_conversation').click(function(){
            var id = $(this).attr('data-id')
            _conf("Are you sure to delete this conversation permanently?","delete_conversation",[id])
        })
    })
    function delete_conversation($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_conversation",
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
