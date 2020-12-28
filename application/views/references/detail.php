<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <?php $this->load->view('includes/head'); ?>
        <title><?=$title ? $title." | " : ""?><?=settings("title")?></title>
        <meta name="description" content="<?=$seo["description"] ? $seo["description"] : settings("meta_description")?>">
        <meta name="title" content="<?=$seo["title"] ? $seo["title"] : settings("meta_title")?>">
        <meta name="keywords" content="<?=$seo["keywords"] ? $seo["keywords"] : settings("meta_keywords")?>">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="<?=$seo["title"] ? $seo["title"] : $reference->title ."|". settings("meta_title")?>">
        <meta property="og:site_name" content="<?=settings("title")?>">
        <meta property="og:description" content="<?=$seo["description"] ? $seo["description"] : settings("meta_description")?>">
        <meta property="og:keywords" content="<?=$seo["keywords"] ? $seo["keywords"] : settings("meta_keywords")?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?=base_url("references/$reference->url")?>">
        <meta property="og:image" content="">
    </head>
<body>

<!-- Add your site or application content here -->

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">

    <?php $this->load->view('includes/header'); ?>

    <!-- Breacrumb Area -->
    <div class="breadcrumb-area cover-image" data-black-overlay="7" style="background: url(<?php if($reference->img_url != ""){echo base_url("admin/uploads/$viewFolder/").$reference->img_url;}else{ echo logo("cover"); } ?>) no-repeat scroll center center;">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="cr-breadcrumb text-center">
                        <h1><?=$reference->title?></h1>
                        <p><?=$breadcrumbs?></p>
                        <a href="<?=base_url("references/")?>" class="cr-btn cr-btn-sm">
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

        <div class="pg-service-area section-padding-lg bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="pg-service-title"><?=$reference->title?></h2>
                    </div>
                    <div class="col-lg-7">
                        <div class="pg-portfolio-images cr-slider-navigation-3">
                            <?php if($images): ?>
                                <?php foreach ($images as $image): ?>
                                    <a href="<?=base_url("admin/uploads/$viewFolder/$image->image_url")?>">
                                        <img src="<?=base_url("admin/uploads/$viewFolder/$image->image_url")?>" alt="<?=$reference->title?>">
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <a href="<?=base_url("admin/uploads/$viewFolder/$reference->img_url")?>">
                                    <img src="<?=base_url("admin/uploads/$viewFolder/$reference->img_url")?>" alt="<?=$reference->title?>">
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="pg-service-details">
                            <div class="small-title">
                                <h4>Açıklama</h4>
                            </div>
                            <?=htmlspecialchars_decode($reference->description)?>
                        </div>
                    </div>
                </div>
                <div class="pg-related-portfolio-wrap">
                    <h4>Diğer Referanslar</h4>
                    <div class="pg-related-portfolios cr-slider-navigation-4">
                        <?php if($prevProje): ?>
                            <!-- Prev Project -->
                            <div class="portfolio">
                                <div class="portfoilo-thumb">
                                    <img src="<?=base_url("admin/uploads/$viewFolder/").$prevProje->img_url?>" alt="<?=$prevProje->title?>" class="fitCover" height="200">
                                </div>
                                <div class="portfolio-content">
                                    <div class="portfolio-content-inner text-center">
                                        <h3>
                                            <a href="<?=base_url("$controllerView/$prevProje->url")?>"><?=$prevProje->title?></a>
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
                                    <img src="<?=base_url("admin/uploads/$viewFolder/").$nextProje->img_url?>" alt="<?=$nextProje->title?>" class="fitCover" height="200">
                                </div>
                                <div class="portfolio-content">
                                    <div class="portfolio-content-inner text-center">
                                        <h3>
                                            <a href="<?=base_url("$controllerView/$nextProje->url")?>"><?=$nextProje->title?></a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <!--// Next Portfolio -->
                        <?php endif; ?>
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