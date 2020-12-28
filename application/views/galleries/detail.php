<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <?php $this->load->view('includes/head'); ?>
        <title><?=$title ? $title." | " : ""?><?=settings("title")?></title>
        <meta name="description" content="<?=$seo["description"] ? $seo["description"] : settings("meta_description")?>">
        <meta name="title" content="<?=$seo["title"] ? $seo["title"] : settings("meta_title")?>">
        <meta name="keywords" content="<?=$seo["keywords"] ? $seo["keywords"] : settings("meta_keywords")?>">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="<?=$seo["title"] ? $seo["title"] : $gallery->title ."|". settings("meta_title")?>">
        <meta property="og:site_name" content="<?=settings("title")?>">
        <meta property="og:description" content="<?=$seo["description"] ? $seo["description"] : settings("meta_description")?>">
        <meta property="og:keywords" content="<?=$seo["keywords"] ? $seo["keywords"] : settings("meta_keywords")?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?=base_url("galleries/$gallery->url")?>">
        <meta property="og:image" content="">
    </head>
<body>

<!-- Add your site or application content here -->

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">

    <?php $this->load->view('includes/header'); ?>

    <!-- Breacrumb Area -->
    <div class="breadcrumb-area cover-image" data-black-overlay="7"
         style="background: url(<?php if ($pages->img_url != "") {
             echo base_url("admin/uploads/menu_view/") . $pages->img_url;
         } else {
             echo logo("cover");
         } ?>) no-repeat scroll center center;">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="cr-breadcrumb text-center">
                        <h1><?=$gallery->title?></h1>
                        <p><?=$breadcrumbs?></p>
                        <a href="<?=base_url("$controllerView/")?>" class="cr-btn cr-btn-sm">
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
        <?php if($gallery->gallery_type == "video"): ?>
            <!-- Videobox area -->
            <div class="videoboxes-area section-padding-lg bg-white">
                <div class="container">
                    <?php if(empty($files)): ?>
                        <div class="col-md-8 offset-md-2">
                            <div class="alert alert-info text-center"><i class="icofont icofont-info-circle"></i> Henüz bir şey eklenmedi.</div>
                        </div>
                    <?php else: ?>
                    <div class="video-box-showcase">
                        <div class="row" >
                            <?php foreach ($files as $file): ?>
                                <div class="col-lg-6">
                                    <div class="videobox-wrap text-center">
                                        <h4><?=$file->file_name?></h4>
                                        <div class="video-box" data-tilt>
                                            <div class="video-box-thumb">
                                                <img src="<?=base_url("admin/uploads/galleries_view/video/$file->video_cover")?>" height="350" class="fitCover" alt="video-thumb">
                                            </div>
                                            <a href="<?=$file->url?>" class="play-button">
                                                <i class="flaticon-play-button"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!--// Videobox area -->
        <?php elseif($gallery->gallery_type == "image"): ?>
            <!-- Portfolio Area -->
            <section class="portfolio-area section-padding-lg bg-white">
                <div class="container">
                <?php if(empty($files)): ?>
                    <div class="col-md-8 offset-md-2">
                        <div class="alert alert-info text-center"><i class="icofont icofont-info-circle"></i> Henüz bir şey eklenmedi.</div>
                    </div>
                <?php else: ?>
                <div class="portfolio-wrap">
                    <!-- Portfolios -->
                    <div class="row no-gutters portfolios portfolios-style-1 portfolios-zoom-button-holder" data-show="6" data-load="3">
                        <div class="container">
                        <?php foreach ($files as $file): ?>
                            <!-- Single Portfolio -->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 portfolio-single pfolio-filter-creative">
                                <div class="portfolio">
                                    <div class="portfoilo-thumb">
                                        <img src="<?=base_url("admin/$file->url")?>" alt="portfolio thumb">
                                    </div>
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-inner text-center">
                                            <a href="<?=base_url("admin/$file->url")?>" class="portfolio-zoom-trigger">
                                                <i class="flaticon-interface"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--// Single Portfolio -->
                        <?php endforeach; ?>
                        </div>
                    </div>
                    <!--// Portfolios -->
                    <div class="portfolio-load-more-button text-center">
                        <button class="load-more-toggle cr-btn cr-btn">
                            <span>Daha fazla</span>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>
                </div>
            </section>
            <!--// Portfolio Area -->
        <?php else: ?>
            <section class="portfolio-area section-padding-lg bg-white">
                <div class="container">
                    <?php if(empty($files)): ?>
                        <div class="col-md-8 offset-md-2">
                            <div class="alert alert-info text-center"><i class="icofont icofont-info-circle"></i> Henüz bir şey eklenmedi.</div>
                        </div>
                    <?php else: ?>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <th>Dosya adı</th>
                            <th width="200" class="text-center">İndir</th>
                        </thead>
                        <tbody>
                        <?php foreach ($files as $file): ?>
                        <tr>
                            <td><?=$file->file_name?></td>
                            <td class="text-center"><a href="<?=base_url("admin/$file->url")?>" download>İndir</a></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>
    </main>
    <!-- //Page Content -->

    <?php $this->load->view('includes/footer'); ?>

</div>
<!-- //Main wrapper -->

<?php $this->load->view('includes/include_script'); ?>

</body>

</html>