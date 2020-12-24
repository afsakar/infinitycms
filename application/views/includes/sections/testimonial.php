<?php if($testimonials): ?>
<!-- Testimonial Area -->
<section class="testimonial-area section-padding-lg bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-12 offset-0">
                <div class="section-title text-center">
                    <h2>Müşteri Yorumları</h2>
                    <p>Siz değerli müşterilerimizden gelen yorumlardan bazıları...</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="testimonial-wrap testimonial-style-3 testimonial-slider-active cr-slider-dots-1">
                    <?php foreach ($testimonials as $testimonial): ?>
                    <!-- Single Testimonial -->
                    <div class="testimonial text-center">
                        <div class="testimonial-thumb">
                            <img src="<?=base_url("admin/uploads/testimonials_view/$testimonial->img_url")?>" alt="testimonial author">
                        </div>
                        <div class="testimonial-content">
                            <p><?=$testimonial->description?></p>
                        </div>
                        <div class="testimonial-author">
                            <h6><?=$testimonial->title?></h6>
                            <p><?=$testimonial->company_name?></p>
                        </div>
                    </div>
                    <!--// Single Testimonial -->
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</section>
<!--// Testimonial Area -->
<?php endif; ?>