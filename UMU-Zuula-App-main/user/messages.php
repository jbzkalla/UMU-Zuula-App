<?php 
$user_id = $_settings->userdata('id');
// For UMU-Zuula, students chat with the System Admin (ID 1)
$admin_id = 1;

// Fetch messages
$messages_qry = $conn->query("SELECT * FROM `messages` 
                            WHERE (sender_id = '{$user_id}' AND receiver_id = '{$admin_id}') 
                            OR (sender_id = '{$admin_id}' AND receiver_id = '{$user_id}') 
                            ORDER BY created_at ASC");
$messages = [];
while($row = $messages_qry->fetch_assoc()){
    $messages[] = $row;
}
?>
<div class="row">
    <!-- Inbox Sidebar -->
    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                <h5 class="fw-bold mb-0">Messages</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <button type="button" class="list-group-item list-group-item-action p-3 active border-0" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1 fw-bold">System Admin</h6>
                            <small class="text-muted">Chat Support</small>
                        </div>
                        <p class="mb-1 text-truncate small">Direct support with the administrative team.</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chat Area -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white pt-4 pb-3 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold" style="width: 40px; height: 40px;">A</div>
                    <div>
                        <h6 class="mb-0 fw-bold">System Admin</h6>
                        <small class="text-muted"><i class="ri-checkbox-circle-fill text-success"></i> Administrator</small>
                    </div>
                </div>
            </div>
            <div class="card-body p-4 chat-container" id="chat-box" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
                <?php if(empty($messages)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="ri-chat-smile-2-line fs-1 d-block mb-3"></i>
                        Start a conversation with the Administrator.
                    </div>
                <?php else: ?>
                    <?php foreach($messages as $msg): ?>
                        <?php if($msg['sender_id'] == $user_id): ?>
                            <!-- Sender (Student) Message -->
                            <div class="d-flex mb-4 justify-content-end">
                                <div class="bg-primary text-white p-3 shadow-sm rounded-3 rounded-top-right-0" style="max-width: 75%;">
                                    <p class="mb-1"><?php echo $msg['message'] ?></p>
                                    <small class="text-light opacity-75" style="font-size: 0.70rem;"><?php echo date("M d, H:i", strtotime($msg['created_at'])) ?></small>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Receiver (Admin) Message -->
                            <div class="d-flex mb-4">
                                <div class="bg-white p-3 shadow-sm rounded-3 rounded-top-left-0" style="max-width: 75%;">
                                    <p class="mb-1"><?php echo $msg['message'] ?></p>
                                    <small class="text-muted" style="font-size: 0.70rem;"><?php echo date("M d, H:i", strtotime($msg['created_at'])) ?></small>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="card-footer bg-white p-3 border-top-0">
                <form id="chat-form" class="input-group">
                    <input type="hidden" name="sender_id" value="<?php echo $user_id ?>">
                    <input type="hidden" name="receiver_id" value="<?php echo $admin_id ?>">
                    <input type="text" name="message" class="form-control form-control-lg bg-light border-0" placeholder="Type a message..." required autocomplete="off">
                    <button class="btn btn-primary px-4 fw-bold" type="submit"><i class="ri-send-plane-fill"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        // Scroll to bottom
        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);

        $('#chat-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            var msg = _this.find('[name="message"]').val().trim();
            if(msg == '') return false;
            
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_message",
                method:'POST',
                data:$(this).serialize(),
                dataType:'json',
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured", "error")
                    end_loader()
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        var now = new Date();
                        var time = now.toLocaleString('en-US', { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit', hour12: false }).replace(',', '');
                        var html = '<div class="d-flex mb-4 justify-content-end">' +
                                   '<div class="bg-primary text-white p-3 shadow-sm rounded-3 rounded-top-right-0" style="max-width: 75%;">' +
                                   '<p class="mb-1">' + msg + '</p>' +
                                   '<small class="text-light opacity-75" style="font-size: 0.70rem;">' + time + '</small>' +
                                   '</div></div>';
                        $('#chat-box .text-center').remove();
                        $('#chat-box').append(html);
                        _this.find('[name="message"]').val('');
                        $('#chat-box').animate({ scrollTop: $('#chat-box')[0].scrollHeight }, 500);
                    }else{
                        alert_toast("An error occured", "error")
                    }
                    end_loader()
                }
            })
        })
    })
</script>
