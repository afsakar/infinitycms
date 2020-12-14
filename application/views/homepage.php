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

    <?php $this->load->view('includes/sections/banner_slider'); ?>

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