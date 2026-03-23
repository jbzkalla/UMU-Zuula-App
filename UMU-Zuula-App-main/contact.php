<?php
// contact.php — redesigned with UMU-Zuula branding
?>
<div class="container py-4">
    <div class="text-center mb-4">
        <h1 class="fw-bold" style="color:#134E8E;"><i class="ri-mail-send-line me-2"></i>Get In Touch</h1>
        <p class="lead text-muted">Have questions? Reach out to the UMU-Zuula Lost & Found Office.</p>
        <hr class="mx-auto opacity-100" style="width:80px; border-width:3px; border-color:#9B0F06;">
    </div>

    <div class="row g-4">
        <!-- Contact Info Cards -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="text-white p-4" style="background: linear-gradient(135deg, #134E8E, #1a6ab5);">
                    <h4 class="fw-bold mb-1"><i class="ri-building-2-line me-2"></i>UMU-Zuula Office</h4>
                    <p class="mb-0 opacity-75">Lost & Found Information System</p>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width:45px; height:45px; background:#ECE7D1;">
                            <i class="ri-map-pin-2-fill fs-5" style="color:#9B0F06;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Main Office Location</h6>
                            <p class="text-muted mb-0">Uganda Martyrs University<br>Nkozi, Mpigi District</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width:45px; height:45px; background:#ECE7D1;">
                            <i class="ri-group-line fs-5" style="color:#134E8E;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Target Community</h6>
                            <p class="text-muted mb-0">UMU Students, Staff & Visitors around Nkozi</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width:45px; height:45px; background:#ECE7D1;">
                            <i class="ri-mail-line fs-5" style="color:#9B0F06;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Email Us</h6>
                            <p class="text-muted mb-0"><a href="mailto:yiga.ian@stud.umu.ac.ug" style="color:#134E8E;">yiga.ian@stud.umu.ac.ug</a></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width:45px; height:45px; background:#ECE7D1;">
                            <i class="ri-phone-line fs-5" style="color:#134E8E;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Call / WhatsApp</h6>
                            <p class="text-muted mb-0"><a href="tel:+256775090148" style="color:#134E8E;">0775 090 148</a></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width:45px; height:45px; background:#ECE7D1;">
                            <i class="ri-time-line fs-5" style="color:#9B0F06;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Office Hours</h6>
                            <p class="text-muted mb-0">Mon – Fri: 8:00 AM – 5:00 PM<br>Sat: 9:00 AM – 1:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="p-4" style="background:#ECE7D1;">
                    <h4 class="fw-bold mb-1" style="color:#134E8E;"><i class="ri-chat-3-line me-2"></i>Send Us a Message</h4>
                    <p class="text-muted mb-0 small">Your message will be sent directly to the UMU-Zuula administration team.</p>
                </div>
                <div class="card-body p-4">
                    <form action="" id="inquiry-form">
                        <input type="hidden" name="id">
                        <input type="hidden" name="visitor">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fullname" class="form-label fw-bold"><i class="ri-user-line me-1" style="color:#134E8E;"></i> Full Name</label>
                                <input type="text" class="form-control rounded-3" id="fullname" name="fullname" placeholder="e.g. John Mukasa" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold"><i class="ri-mail-line me-1" style="color:#134E8E;"></i> Email Address</label>
                                <input type="email" class="form-control rounded-3" id="email" name="email" placeholder="e.g. john@stud.umu.ac.ug" required>
                            </div>
                            <div class="col-12">
                                <label for="contact" class="form-label fw-bold"><i class="ri-phone-line me-1" style="color:#134E8E;"></i> Phone Number</label>
                                <input type="text" class="form-control rounded-3" id="contact" name="contact" placeholder="e.g. 0775090148" required>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label fw-bold"><i class="ri-message-3-line me-1" style="color:#134E8E;"></i> Your Message</label>
                                <textarea rows="5" class="form-control rounded-3" id="message" name="message" placeholder="Describe your inquiry or concern..." required></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-white border-0 p-4 pt-0">
                    <button class="btn btn-lg w-100 rounded-pill fw-bold shadow-sm" style="background:#134E8E; color:#fff;" form="inquiry-form">
                        <i class="ri-send-plane-2-line me-2"></i> Send Message
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#inquiry-form').submit(function(e){
        e.preventDefault();
        var _this = $(this)
            $('.err-msg').remove();
        setTimeout(() => {
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_inquiry",
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
                        alert_toast("Message sent successfully! We'll get back to you soon.",'success');
                        _this[0].reset();
                        end_loader();
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