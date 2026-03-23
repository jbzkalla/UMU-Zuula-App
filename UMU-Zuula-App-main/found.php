<h1 class="pageTitle text-center"><i class="ri-add-circle-line me-2"></i>Report an Item</h1>
<p class="text-center text-muted mb-3">Found or lost something on campus? Help the UMU community stay connected.</p>
<hr class="mx-auto opacity-100" style="width:80px; border-width:3px; border-color:#9B0F06;">

<!-- How it Works Mini Section -->
<div class="row justify-content-center mb-4 g-3">
    <div class="col-md-3 text-center">
        <div class="rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center mb-2" style="width:60px; height:60px; background:#ECE7D1;">
            <i class="ri-edit-2-line fs-3" style="color:#134E8E;"></i>
        </div>
        <p class="small fw-bold mb-0">1. Fill the Form</p>
    </div>
    <div class="col-md-3 text-center">
        <div class="rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center mb-2" style="width:60px; height:60px; background:#ECE7D1;">
            <i class="ri-image-add-line fs-3" style="color:#9B0F06;"></i>
        </div>
        <p class="small fw-bold mb-0">2. Upload Image</p>
    </div>
    <div class="col-md-3 text-center">
        <div class="rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center mb-2" style="width:60px; height:60px; background:#ECE7D1;">
            <i class="ri-send-plane-line fs-3" style="color:#134E8E;"></i>
        </div>
        <p class="small fw-bold mb-0">3. Submit Report</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="p-3" style="background:#ECE7D1;">
                <h5 class="fw-bold mb-0" style="color:#134E8E;"><i class="ri-file-list-3-line me-2"></i>Item Details</h5>
                <p class="text-muted small mb-0">Please fill all the required fields marked with *</p>
            </div>
            <div class="card-body py-4">
                <form action="" id="item-form">
                    <input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <input type="hidden" name="founder">
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold"><i class="ri-flag-line me-1" style="color:#9B0F06;"></i> Report Type *</label>
                        <select name="status" id="status" class="form-select rounded-3 shadow-sm border-2" style="border-color:#ECE7D1;" required>
                            <option value="1" <?= isset($status) && $status == 1 ? "selected" : "" ?>>I Lost something (Lost Item)</option>
                            <option value="2" <?= isset($status) && $status == 2 ? "selected" : "" ?>>I Found something (Found Item)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label fw-bold"><i class="ri-folder-line me-1" style="color:#134E8E;"></i> Category *</label>
                        <select name="category_id" id="category_id" class="form-select rounded-3" required="required">
                            <option value="" disabled <?= !isset($category_id) ? "selected" : "" ?>></option>
                            <?php 
                            $query = $conn->query("SELECT * FROM `category_list` where `status` = 1 order by `name` asc");
                            while($row=$query->fetch_assoc()):
                            ?>
                            <option value="<?= $row['id'] ?>" <?= isset($category_id) && $category_id == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="form-label fw-bold"><i class="ri-user-line me-1" style="color:#134E8E;"></i> Your Name *</label>
                        <input type="text" name="fullname" id="fullname" class="form-control rounded-3" placeholder="e.g. John Mukasa" value="<?php echo isset($fullname) ? $fullname : ''; ?>"  autofocus required/>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold"><i class="ri-text me-1" style="color:#134E8E;"></i> Item Title *</label>
                        <input type="text" name="title" id="title" class="form-control rounded-3" placeholder="e.g. Lost Blue Backpack" value="<?php echo isset($title) ? $title : ''; ?>"  required/>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label fw-bold"><i class="ri-phone-line me-1" style="color:#134E8E;"></i> Contact Number *</label>
                        <input type="text" name="contact" id="contact" class="form-control rounded-3" placeholder="e.g. 0775090148" value="<?php echo isset($contact) ? $contact : ''; ?>"  required/>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold"><i class="ri-file-text-line me-1" style="color:#134E8E;"></i> Description *</label>
                        <textarea rows="4" name="description" id="description" class="form-control rounded-3" placeholder="Describe the item in detail (color, brand, distinguishing features)..."  required><?php echo isset($description) ? $description : ''; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold"><i class="ri-image-add-line me-1" style="color:#9B0F06;"></i> Item Image (Optional)</label>
                        <input type="file" class="form-control rounded-3" id="customFile" name="image" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
                    </div>
                    <div class="mb-3 text-center">
                        <img src="<?php echo validate_image(isset($image_path) ? $image_path :'') ?>" alt="" id="cimg" class="img-fluid img-thumbnail rounded-3" style="max-height:200px;">
                    </div>
                </form>
            </div>
            <div class="card-footer bg-white border-0 p-4 pt-0">
                <button class="btn btn-lg w-100 rounded-pill fw-bold shadow-sm" style="background:#9B0F06; color:#fff;" form="item-form"><i class="ri-send-plane-2-line me-2"></i> Submit Report</button>
            </div>
        </div>
    </div>
</div>
<script>
    function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }else{
			$('#cimg').attr('src', "<?php echo validate_image(isset($meta['image_path']) ? $meta['image_path'] :'') ?>");
		}
	}
$(document).ready(function(){
    $('#category_id').select2({
        placeholder: 'Please Select Here',
        width: '100%'
    })
    $('#item-form').submit(function(e){
        e.preventDefault();
        var _this = $(this)
            $('.err-msg').remove();
        setTimeout(() => {
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_item",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured",'error');
                    end_loader();
                },
                success:function(resp){
                    if(typeof resp =='object' && resp.status == 'success'){
                        alert_toast("Item reported successfully!",'success');
                        setTimeout(()=> location.replace('./?page=items'), 1500);
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").scrollTop(0);
                            end_loader()
                    }else{
                        alert_toast("An error occured",'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        }, 200);
        
    })
})
</script>