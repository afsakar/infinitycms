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
             echo logo("about_img");
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

        <?php $this->load->view('includes/sections/about'); ?>

        <div class="section-padding-xs bg-grey">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="typography-block">
                            <h4>Misyonumuz</h4>
                            <p><?=htmlspecialchars_decode(settings("mission"))?></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="typography-block">
                            <h4>Vizyonumuz</h4>
                            <p><?=htmlspecialchars_decode(settings("vision"))?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('includes/sections/testimonial'); ?>
        <?php $this->load->view('includes/sections/brands'); ?>


    </main>
    <!-- //Page Content -->

    <?php $this->load->view('includes/footer'); ?>

</div>
<!-- //Main wrapper -->

<?php $this->load->view('includes/include_script'); ?>

</body>

</html>