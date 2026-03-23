<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT c.*, i.title as item_title, i.image_path as item_image, u.username as claimant, u.firstname, u.lastname, u.email 
                        FROM `claims` c 
                        INNER JOIN `item_list` i ON c.item_id = i.id 
                        INNER JOIN `users` u ON c.user_id = u.id 
                        WHERE c.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    } else {
        echo '<script>alert("Claim ID is unknown"); location.replace("./?page=claims")</script>';
    }
} else {
    echo '<script>alert("Claim ID is required"); location.replace("./?page=claims")</script>';
}
?>
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white pt-4">
        <h5 class="card-title fw-bold">Claim Details</h5>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <fieldset class="border-bottom pb-2 mb-3">
                        <legend class="text-muted fs-6 mb-1">Claimant Information</legend>
                        <p class="mb-1"><b>Name:</b> <?php echo $firstname . ' ' . $lastname ?></p>
                        <p class="mb-1"><b>ID/Username:</b> <?php echo $claimant ?></p>
                        <p class="mb-1"><b>Email:</b> <?php echo $email ?></p>
                    </fieldset>
                    <fieldset class="border-bottom pb-2 mb-3">
                        <legend class="text-muted fs-6 mb-1">Item Information</legend>
                        <p class="mb-1"><b>Item:</b> <?php echo $item_title ?></p>
                        <div class="text-center mt-2">
                             <img src="<?= validate_image($item_image) ?>" alt="" class="img-fluid img-thumbnail" style="max-height:200px">
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6 border-start">
                    <fieldset class="pb-2 mb-3">
                        <legend class="text-muted fs-6 mb-1">Proof of Ownership</legend>
                        <div class="bg-light p-3 border rounded mb-3">
                            <?php echo nl2br($proof_description) ?>
                        </div>
                        <?php if(!empty($proof_file_path)): ?>
                            <div class="text-center">
                                <a href="<?= base_url . $proof_file_path ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill"><i class="bi bi-file-earmark-image"></i> View Attached Proof</a>
                            </div>
                        <?php endif; ?>
                    </fieldset>
                    
                    <form action="" id="update-claim-form">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div class="form-group mb-3">
                            <label for="status" class="control-label">Update Status</label>
                            <select name="status" id="status" class="form-select rounded-0" required>
                                <option value="0" <?php echo $status == 0 ? 'selected' : '' ?>>Pending</option>
                                <option value="1" <?php echo $status == 1 ? 'selected' : '' ?>>Approved (Found / Released)</option>
                                <option value="2" <?php echo $status == 2 ? 'selected' : '' ?>>Rejected</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="admin_note" class="control-label">Admin Note / Instructions</label>
                            <textarea name="admin_note" id="admin_note" rows="3" class="form-control rounded-0" placeholder="E.g. Please pick up at the security office."><?php echo $admin_note ?></textarea>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary bg-gradient-navy rounded-pill px-4" type="submit">Update Claim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#update-claim-form').submit(function(e){
            e.preventDefault();
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_claim",
                method:'POST',
                data:$(this).serialize(),
                dataType:'json',
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        location.reload()
                    }else{
                        alert_toast("An error occured",'error')
                        end_loader()
                    }
                }
            })
        })
    })
</script>
