    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=settings("meta_description")?>">
    <meta name="title" content="<?=settings("meta_title")?>">
    <meta name="keywords" content="<?=settings("meta_keywords")?>">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="<?=settings("meta_title")?>">
    <meta property="og:site_name" content="<?=settings("title")?>">
    <meta property="og:description" content="<?=settings("meta_description")?>">
    <meta property="og:keywords" content="<?=settings("meta_keywords")?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <?php if(settings("analytics_code") != ""){ ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?=settings("analytics_code")?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '<?=settings("analytics_code")?>');
        </script>
    <?php } ?>
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?=logo("favicon")?>">
    <link rel="apple-touch-icon" href="<?=logo("favicon")?>">

    <?php $this->load->view('includes/include_style'); ?>
