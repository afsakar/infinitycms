<?php if($brands): ?>
<!-- Brand Logo Area -->
<div id="brand-logo-area" class="brand-logo-area bg-dark-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="brand-logos brand-logo-carousel-activation cr-slider-navigation-2">

                    <?php foreach ($brands as $brand): ?>
                    <div class="brand-logo">
                        <a href="#">
                            <img src="<?=base_url("admin/uploads/brands_view/$brand->img_url")?>" alt="<?=$brand->title?>">
                        </a>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--// Brand Logo Area -->
<?php endif; ?>