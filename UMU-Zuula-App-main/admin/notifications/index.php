<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold mb-0">System Broadcasts & Notifications</h5>
            <button class="btn btn-sm btn-primary rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#newBroadcastModal"><i class="ri-add-line"></i> New Broadcast</button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Date Sent</th>
                        <th>Type</th>
                        <th>Target Audience</th>
                        <th>Message Preview</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $qry = $conn->query("SELECT message, created_at, COUNT(user_id) as recipients 
                                        FROM `notifications` 
                                        WHERE title = 'System Broadcast'
                                        GROUP BY message, created_at 
                                        ORDER BY created_at DESC");
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo date("M d, Y H:i", strtotime($row['created_at'])) ?></td>
                        <td><span class="badge bg-info text-dark">Broadcast</span></td>
                        <td><small><?php echo $row['recipients'] ?> Users</small></td>
                        <td><p class="truncate-1 mb-0" style="max-width:300px;"><?php echo $row['message'] ?></p></td>
                        <td>
                            <button class="btn btn-sm btn-light border rounded-pill px-3"><i class="ri-eye-line"></i> View Recipients</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No broadcasts sent.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for New Broadcast -->
<div class="modal fade" id="newBroadcastModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header bg-light">
        <h5 class="modal-title fw-bold">Send New Broadcast</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="broadcast-form">
          <div class="modal-body p-4">
            <div class="mb-3">
                <label class="form-label fw-bold">Target Audience</label>
                <select name="audience" class="form-select bg-light">
                    <option value="all">All Registered Students/Staff</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Notification Message</label>
                <textarea name="message" class="form-control bg-light" rows="4" required placeholder="Type your broadcast message..."></textarea>
            </div>
          </div>
          <div class="modal-footer border-top-0 pt-0 pe-4 pb-4">
            <button type="button" class="btn btn-secondary rounded-pill pe-4 ps-4" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary rounded-pill pe-4 ps-4 fw-bold">Send Broadcast</button>
          </div>
      </form>
    </div>
  </div>
</div>
<script>
    $('#broadcast-form').submit(function(e){
        e.preventDefault();
        var _this = $(this)
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=save_broadcast",
            method:'POST',
            data:_this.serialize(),
            dataType:'json',
            error:err=>{
                console.log(err)
                alert_toast("An error occured", "error")
                end_loader()
            },
            success:function(resp){
                if(resp.status == 'success'){
                    alert_toast("Broadcast sent successfully", "success");
                    $('#newBroadcastModal').modal('hide');
                    location.reload();
                }else{
                    alert_toast("An error occured", "error")
                }
                end_loader();
            }
        })
    })
</script>
