<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="card-title fw-bold mb-4">My Profile</h5>
        
        <form id="profile-form" action="" class="row g-3">
            <div class="col-md-4 text-center border-end">
                <div class="mb-3">
                    <img id="cimg" src="<?= validate_image('') ?>" alt="Profile" class="rounded-circle border border-3 border-primary shadow-sm" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
                <div class="mb-3 px-3">
                    <label for="customFile" class="form-label fw-bold">Change Avatar</label>
                    <input type="file" class="form-control form-control-sm" id="customFile" name="img" accept="image/*" onchange="displayImg(this,$(this))">
                </div>
            </div>
            
            <div class="col-md-8 px-4">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold">First Name</label>
                        <input type="text" name="firstname" class="form-control bg-light" value="User" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold">Last Name</label>
                        <input type="text" name="lastname" class="form-control bg-light" value="Demo" required>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label fw-bold">UMU Reg Number / ID</label>
                        <input type="text" name="username" class="form-control bg-light" value="2023-B293-11234" readonly>
                        <small class="text-muted">ID cannot be changed. Contact Admin for corrections.</small>
                    </div>
                    <div class="col-sm-12 mt-4 text-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm fw-bold">Save Changes</button>
                    </div>
                </div>
            </div>
        </form>
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
        }
    }
    $('#profile-form').submit(function(e){
        e.preventDefault();
        start_loader();
        setTimeout(() => {
            alert_toast("Profile updated successfully", "success");
            end_loader();
        }, 1000);
    })
</script>
