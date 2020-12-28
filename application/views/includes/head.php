    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
