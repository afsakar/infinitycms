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
    <div class="breadcrumb-area" data-black-overlay="7">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="cr-breadcrumb text-center">
                        <h1>Başlık</h1>
                        <p>Alt Başlık</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Breacrumb Area -->

    <!-- Page Content -->
    <main class="page-content">

        <?php $this->load->view('includes/sections/about'); ?>

        <?php $this->load->view('includes/sections/services'); ?>

        <?php $this->load->view('includes/sections/skills'); ?>

        <?php $this->load->view('includes/sections/counter'); ?>

        <?php $this->load->view('includes/sections/portfolio'); ?>

        <?php $this->load->view('includes/sections/brands'); ?>

        <?php $this->load->view('includes/sections/testimonial'); ?>

    </main>
    <!-- //Page Content -->

    <?php $this->load->view('includes/footer'); ?>

</div>
<!-- //Main wrapper -->

<?php $this->load->view('includes/include_script'); ?>

</body>

</html>