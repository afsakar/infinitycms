<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php $this->load->view('includes/head'); ?>
    <title><?= $title ? $title . " | " : "" ?><?= settings("title") ?></title>
</head>
<body>

<!-- Add your site or application content here -->

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">

    <?php $this->load->view('includes/header'); ?>

    <!-- Breacrumb Area -->
    <div class="breadcrumb-area cover-image" data-black-overlay="7"
         style="background: url(<?php if ($page->img_url != "") {
             echo base_url("admin/uploads/menu_view/") . $page->img_url;
         } else {
             echo logo("cover");
         } ?>) no-repeat scroll center center;">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="cr-breadcrumb text-center">
                        <h1><?= $title ?></h1>
                        <p><?= $breadcrumbs ?></p>
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
                    <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-12 offset-0">
                        <div class="section-title text-center">
                            <h2><?= $title ?></h2>
                        </div>
                    </div>
                </div>
                <?php if (empty($galleries)): ?>
                    <div class="col-md-8 offset-md-2">
                        <div class="alert alert-info text-center"><i class="icofont icofont-info-circle"></i> Henüz bir
                            şey eklenmedi.
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Poftfolio Filters -->
                    <div class="portfolio-filters portfolio-filters-minimal text-center mt-0">
                        <button class="is-checked" data-filter="*">Tümü</button>
                        <button data-filter=".image">Resim</button>
                        <button data-filter=".video">Video</button>
                        <button data-filter=".file">Dosya</button>
                    </div>
                    <div class="row portfolios portfolios-minimal-4" data-show="8" data-load="4">
                        <div class="row justify-content-center">
                            <?php foreach ($galleries as $gallery): ?>
                                <!-- Signle Service -->
                                <div class="col-md-3 col-12 portfolio-single <?= $gallery->gallery_type ?>">
                                    <div class="service service-style-4 text-center">
                                        <div class="service text-center">
                                            <div class="service-icon">
                                                <?php if ($gallery->gallery_type == "image"): ?>
                                                    <span><img src="<?= base_url("admin/sources/assets/images/file_types/jpg.png") ?>" alt="<?= $gallery->title ?>" class="fitCover"></span>
                                                    <span><img src="<?= base_url("admin/sources/assets/images/file_types/png.png") ?>" alt="<?= $gallery->title ?>" class="fitCover"></span>
                                                <?php elseif ($gallery->gallery_type == "video"): ?>
                                                    <span><img src="<?= base_url("admin/sources/assets/images/file_types/avi.png") ?>" alt="<?= $gallery->title ?>" class="fitCover"></span>
                                                    <span><img src="<?= base_url("admin/sources/assets/images/file_types/mp4.png") ?>" alt="<?= $gallery->title ?>" class="fitCover"></span>
                                                <?php else: ?>
                                                    <span><img src="<?= base_url("admin/sources/assets/images/file_types/pdf.png") ?>" alt="<?= $gallery->title ?>" class="fitCover"></span>
                                                    <span><img src="<?= base_url("admin/sources/assets/images/file_types/doc.png") ?>" alt="<?= $gallery->title ?>" class="fitCover"></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="service-content">
                                                <h4><a href="<?= base_url("$controllerView/$gallery->url") ?>"><?= $gallery->title ?></a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--// Signle Service -->
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="portfolio-load-more-button text-center">
                        <button class="load-more-toggle cr-btn cr-btn">
                            <span>Daha Fazla</span>
                        </button>
                    </div>
                    <!--// Poftfolio Filters -->
                <?php endif; ?>

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