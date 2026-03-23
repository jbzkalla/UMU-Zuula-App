<?php 
if(isset($_GET['id']) && $_GET['id'] > 0){
    $student_id = $_GET['id'];
    $user_qry = $conn->query("SELECT * FROM users where id = '{$student_id}' ");
    if($user_qry->num_rows > 0){
        $student = $user_qry->fetch_assoc();
    }else{
        echo '<script>alert("Student ID is unknown"); location.replace("./?page=messages")</script>';
    }

    // Mark as read
    $conn->query("UPDATE `messages` set `is_read` = 1 WHERE sender_id = '{$student_id}' AND receiver_id = 1");

    // Fetch conversation
    $messages_qry = $conn->query("SELECT * FROM `messages` 
                                WHERE (sender_id = 1 AND receiver_id = '{$student_id}') 
                                OR (sender_id = '{$student_id}' AND receiver_id = 1) 
                                ORDER BY created_at ASC");
    $messages = [];
    while($row = $messages_qry->fetch_assoc()){
        $messages[] = $row;
    }
}else{
    echo '<script>alert("Student ID is required"); location.replace("./?page=messages")</script>';
}
?>
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white pt-4 pb-3 border-bottom d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold" style="width: 45px; height: 45px;"><?php echo substr($student['fullname'],0,1) ?></div>
                    <div>
                        <h6 class="mb-0 fw-bold"><?php echo $student['fullname'] ?></h6>
                        <small class="text-muted"><?php echo $student['username'] ?> | Student Account</small>
                    </div>
                </div>
                <a href="./?page=messages" class="btn btn-light btn-sm rounded-pill border shadow-sm"><i class="bi bi-arrow-left"></i> Back to Inbox</a>
            </div>
            <div class="card-body p-4" id="chat-box" style="height: 450px; overflow-y: auto; background-color: #f8f9fa;">
                <?php foreach($messages as $msg): ?>
                    <?php if($msg['sender_id'] == 1): ?>
                        <!-- Admin Message -->
                        <div class="d-flex mb-4 justify-content-end">
                            <div class="bg-primary text-white p-3 shadow-sm rounded-3 rounded-top-right-0" style="max-width: 75%;">
                                <p class="mb-1"><?php echo $msg['message'] ?></p>
                                <small class="text-light opacity-75" style="font-size: 0.70rem;"><?php echo date("M d, H:i", strtotime($msg['created_at'])) ?></small>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Student Message -->
                        <div class="d-flex mb-4">
                            <div class="bg-white p-3 shadow-sm rounded-3 rounded-top-left-0" style="max-width: 75%;">
                                <p class="mb-1"><?php echo $msg['message'] ?></p>
                                <small class="text-muted" style="font-size: 0.70rem;"><?php echo date("M d, H:i", strtotime($msg['created_at'])) ?></small>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="card-footer bg-white p-3 border-top">
                <form id="chat-form" class="input-group">
                    <input type="hidden" name="sender_id" value="1">
                    <input type="hidden" name="receiver_id" value="<?php echo $student_id ?>">
                    <input type="text" name="message" class="form-control form-control-lg bg-light border-0" placeholder="Type your reply here..." required autocomplete="off">
                    <button class="btn btn-primary px-4 fw-bold" type="submit"><i class="bi bi-send"></i> Send Reply</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
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
                data:_this.serialize(),
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
