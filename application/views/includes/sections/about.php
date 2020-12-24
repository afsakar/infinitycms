<!-- About Area -->
<section class="about-area bg-white">
    <div class="pg-about-area section-padding-lg bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 order-2 order-lg-1">
                    <div class="pg-about-content">
                        <h2><?=settings("about_us_title")?></h2>
                        <p><?=settings("about_us")?></p>
                        <?php if($this->uri->segment(1) != "about"): ?>
                        <a href="<?=base_url("about")?>" class="cr-btn bt">Daha fazla...</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2">
                    <div class="pg-about-thumb" data-tilt="" style="will-change: transform; transform: perspective(800px) rotateX(0deg) rotateY(0deg);">
                        <img src="<?=logo("about_img")?>" alt="about thumb">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--// About Area -->