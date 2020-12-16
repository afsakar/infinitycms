<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <?php $this->load->view('includes/head'); ?>
        <title><?=$title ? $title." | " : ""?><?=settings("title")?></title>
    </head>
<body>

<!-- Add your site or application content here -->

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">

    <?php $this->load->view('includes/header'); ?>

    <!-- Breacrumb Area -->
    <div class="breadcrumb-area cover-image" data-black-overlay="7" style="background: url(<?php if(getCover($project->id)){ echo base_url("admin/uploads/$viewFolder/").getCover($project->id); }else{ echo logo("cover"); } ?>) no-repeat scroll center center;">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="cr-breadcrumb text-center">
                        <h1><?=$project->title?></h1>
                        <p><?=$breadcrumbs?></p>
                        <a href="<?=base_url("projects/")?>" class="cr-btn cr-btn-sm">
                            <span>Geri dön</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Breacrumb Area -->

    <!-- Page Content -->
    <main class="page-content">

        <div class="bg-white section-padding-lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if($images): ?>
                        <div class="col-lg-8 offset-lg-2">
                            <div class="pg-portfolio-images cr-slider-navigation-3">
                                <?php foreach ($images as $image): ?>
                                    <a href="<?=base_url("admin/uploads/$viewFolder/$image->image_url")?>">
                                        <img src="<?=base_url("admin/uploads/$viewFolder/$image->image_url")?>" alt="<?=$project->title?>">
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="pg-portfolio-details" style='margin-top: 0!important;'>
                            <div class="pg-portfolio-infos" style="margin-bottom: 3rem;">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="pg-portfolio-single-info">
                                            <h5>Proje Adı</h5>
                                            <p><?=$project->title?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="pg-portfolio-single-info">
                                            <h5>Kategori</h5>
                                            <p><?=$categories->category_name?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="pg-portfolio-single-info">
                                            <h5>Tarih</h5>
                                            <p><?=$project->projectDate?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?=htmlspecialchars_decode($project->description)?>
                        </div>

                        <!-- Related project -->
                        <div class="pg-related-portfolio-wrap">
                            <h4>Diğer Projeler</h4>
                            <div class="pg-related-portfolios cr-slider-navigation-4">
                                <?php if($prevProje): ?>
                                <!-- Prev Project -->
                                <div class="portfolio">
                                    <div class="portfoilo-thumb">
                                        <img src="<?=base_url("admin/uploads/$viewFolder/").getCover($prevProje->id)?>" alt="<?=$prevProje->title?>" class="fitCover" height="200">
                                    </div>
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-inner text-center">
                                            <h3>
                                                <a href="<?=base_url("projects/$prevProje->url")?>"><?=$prevProje->title?></a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <!--// Prev Portfolio -->
                                <?php endif; ?>
                                <?php if($nextProje): ?>
                                <!-- Next Project -->
                                <div class="portfolio">
                                    <div class="portfoilo-thumb">
                                        <img src="<?=base_url("admin/uploads/$viewFolder/").getCover($nextProje->id)?>" alt="<?=$nextProje->title?>" class="fitCover" height="200">
                                    </div>
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-inner text-center">
                                            <h3>
                                                <a href="<?=base_url("projects/$nextProje->url")?>"><?=$nextProje->title?></a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <!--// Next Portfolio -->
                                <?php endif; ?>
                            </div>
                        </div>
                        <!--// Related project -->

                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- //Page Content -->

    <?php $this->load->view('includes/footer'); ?>

</div>
<!-- //Main wrapper -->

<?php $this->load->view('includes/include_script'); ?>

</body>

</html>