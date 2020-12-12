<!DOCTYPE html>
<html lang="tr">
    <head>
        <title>Yönetip Paneline Giriş | <?=settings('title')?></title>
        <?php $this->load->view('includes/head'); ?>
        <link rel="stylesheet" href="<?=base_url('sources/assets/css/toastr.min.css')?>">
        <link rel="stylesheet" href="<?=base_url("sources/assets/css/misc-pages.css")?>">
    </head>
    <body class="simple-page">
    <!--============= start main area -->
        <!-- APP MAIN ==========-->
            <?php $this->load->view("{$viewFolder}/{$subViewFolder}/content"); ?>
        <!--========== END app main -->
    <?php $this->load->view('includes/include_script'); ?>
    </body>
</html>