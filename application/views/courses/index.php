<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <?php $this->load->view('includes/head'); ?>
        <title><?=$title ? $title." | " : ""?><?=settings("title")?></title>
        <meta name="description" content="<?=$seo["description"] ? $seo["description"] : settings("meta_description")?>">
        <meta name="title" content="<?=$seo["title"] ? $seo["title"] : settings("meta_title")?>">
        <meta name="keywords" content="<?=$seo["keywords"] ? $seo["keywords"] : settings("meta_keywords")?>">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="<?=$seo["title"] ? $seo["title"] : settings("meta_title")?>">
        <meta property="og:site_name" content="<?=settings("title")?>">
        <meta property="og:description" content="<?=$seo["description"] ? $seo["description"] : settings("meta_description")?>">
        <meta property="og:keywords" content="<?=$seo["keywords"] ? $seo["keywords"] : settings("meta_keywords")?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?=base_url($pages->url)?>">
        <meta property="og:image" content="">
    </head>
<body>

<!-- Add your site or application content here -->

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">

    <?php $this->load->view('includes/header'); ?>

    <!-- Breacrumb Area -->
    <div class="breadcrumb-area cover-image" data-black-overlay="7" style="background: url(<?php if($pages->img_url != ""){echo base_url("admin/uploads/menu_view/").$pages->img_url;}else{ echo logo("cover"); } ?>) no-repeat scroll center center;">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="cr-breadcrumb text-center">
                        <h1><?=$title?></h1>
                        <p><?=$breadcrumbs?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Breacrumb Area -->

    <!-- Page Content -->
    <main class="page-content">

        <!-- Portfolio Area -->
        <section class="portfolio-area bg-white section-padding-lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portfolio-wrap">

                            <?php if(empty($courses)): ?>
                                <div class="col-md-8 offset-md-2">
                                    <div class="alert alert-info text-center"><i class="icofont icofont-info-circle"></i> Henüz bir şey eklenmedi.</div>
                                </div>
                            <?php else: ?>

                                <!-- Portfolios -->
                                <div class="row portfolios portfolios-minimal-4" data-show="6" data-load="2">
                                    <?php foreach ($courses as $course): ?>
                                        <!-- Single Portfolio -->
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-12 portfolio-single">
                                            <div class="portfolio">
                                                <div class="portfoilo-thumb">
                                                    <img src="<?=base_url("admin/uploads/$viewFolder/").$course->img_url?>" alt="<?=$course->title?>" height="300" class="fitCover">
                                                </div>
                                                <div class="portfolio-content">
                                                    <div class="portfolio-content-inner text-center">
                                                        <h3>
                                                            <a href="<?=base_url("$controllerView/$course->url")?>"><?=$course->title?></a>
                                                        </h3>
                                                        <h5>
                                                            <?=$course->eventDate?> - <?=$course->eventTime?>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--// Single Portfolio -->
                                    <?php endforeach; ?>
                                </div>
                                <!--// Portfolios -->

                                <div class="portfolio-load-more-button text-center">
                                    <button class="load-more-toggle cr-btn cr-btn">
                                        <span>Daha Fazla</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--// Portfolio Area -->

    </main>
    <!-- //Page Content -->

    <?php $this->load->view('includes/footer'); ?>

</div>
<!-- //Main wrapper -->

<?php $this->load->view('includes/include_script'); ?>

</body>

</html>