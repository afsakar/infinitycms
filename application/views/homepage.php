<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <?php $this->load->view('includes/head'); ?>
        <title><?=$title ? $title." | " : ""?><?=settings("title")?></title>
        <meta name="description" content="<?=settings("meta_description")?>">
        <meta name="title" content="<?=settings("meta_title")?>">
        <meta name="keywords" content="<?=settings("meta_keywords")?>">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="<?=settings("meta_title")?>">
        <meta property="og:site_name" content="<?=settings("title")?>">
        <meta property="og:description" content="<?=settings("meta_description")?>">
        <meta property="og:keywords" content="<?=settings("meta_keywords")?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?=base_url()?>">
        <meta property="og:image" content="">
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