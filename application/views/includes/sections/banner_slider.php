<!-- Top Banner -->
<div class="banner-area banner-slider-active-with-navigation animated-slider-content cr-slider-navigation-1">

    <?php foreach($sliders as $slider): ?>
    <!-- Single Banner -->
    <div class="single-banner bg-image-18 fullscreen" data-black-overlay="5" style="background-image: url(<?=base_url("admin/uploads/sliders_view/$slider->img_url")?>);">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="single-banner-content text-center">
                        <h1><?=$slider->title?></h1>
                        <p>
                            <?=htmlspecialchars_decode($slider->description)?>
                        </p>
                        <?php if($slider->allowButton == 1): ?>
                        <a href="<?=$slider->buttonUrl?>" class="cr-btn cr-btn-lg cr-btn-round cr-btn-white">
                            <span><?=$slider->buttonText?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Single Banner -->
    <?php endforeach; ?>
</div>
<!-- //Top Banner -->