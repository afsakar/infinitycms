<?php if($references): ?>
<!-- Services Area -->
<section class="services-area section-padding-lg bg-white">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-12 offset-0">
                <div class="section-title text-center">
                    <h2>Referanslarımız</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

            <?php foreach ($references as $reference): ?>
            <!-- Signle Service -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="service service-style-4 text-center">
                    <div class="service-image">
                        <img src="<?php echo base_url("admin/uploads/references_view/").$reference->img_url; ?>" alt="<?=$reference->title?>" class="fitCover" height="250">
                    </div>
                    <div class="service-content">
                        <h5>
                            <a href="<?=base_url("references/$reference->url")?>"><?=$reference->title?></a>
                        </h5>
                        <p><?=character_limiter(stripHTMLtags($reference->description), 100)?><a href="<?=base_url("references/$reference->url")?>"><small>(devamını oku)</small></a></p>
                    </div>
                </div>
            </div>
            <!--// Signle Service -->
            <?php endforeach; ?>

        </div>
    </div>
</section>
<!--// Services Area -->
<?php endif; ?>