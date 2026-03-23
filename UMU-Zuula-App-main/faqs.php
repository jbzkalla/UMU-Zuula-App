<?php
// faqs.php (Restored and Polished)
?>
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-2" style="color:#134E8E;">Frequently Asked Questions</h1>
        <p class="text-muted">Quick answers to common questions about UMU-Zuula</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="accordion accordion-flush bg-white rounded-4 shadow-sm border overflow-hidden" id="faqAccordion">
                
                <?php 
                $i = 0;
                $faqs = $conn->query("SELECT * FROM `faqs` WHERE `status` = 1 ORDER BY `question` ASC");
                while($row = $faqs->fetch_assoc()):
                    $i++;
                ?>
                <!-- FAQ <?php echo $i ?> -->
                <div class="accordion-item border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button <?php echo $i > 1 ? 'collapsed' : '' ?> fw-bold py-4 bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?php echo $row['id'] ?>" style="color:#134E8E; box-shadow:none;">
                            <i class="ri-information-line fs-5 me-3"></i> <?php echo $row['question'] ?>
                        </button>
                    </h2>
                    <div id="faq<?php echo $row['id'] ?>" class="accordion-collapse collapse <?php echo $i == 1 ? 'show' : '' ?>" data-bs-parent="#faqAccordion">
                        <div class="accordion-body lh-lg text-muted px-5 pb-4">
                            <?php echo $row['answer'] ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>

                <?php if($faqs->num_rows <= 0): ?>
                    <div class="text-center py-5">
                        <p class="text-muted">No FAQs available at the moment.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<style>
.accordion-button::after {
    background-size: 1rem;
    filter: invert(24%) sepia(85%) saturate(1454%) hue-rotate(193deg) brightness(91%) contrast(92%); /* Matches #134E8Eish */
}
.accordion-item:last-child {
    border-bottom: 0 !important;
}
</style>
