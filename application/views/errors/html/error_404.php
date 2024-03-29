<?php defined('BASEPATH') OR exit('No direct script access allowed');
$ci = new CI_Controller();
$ci =& get_instance();
$ci->load->helper('url');
$ci->load->helper('tools');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?=logo("favicon")?>">
    <link rel="apple-touch-icon" href="<?=logo("favicon")?>">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Sayfa Bulunamadı | <?=settings("title")?></title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="<?=base_url("sources")?>/css/404.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <div></div>
            <h1>404</h1>
        </div>
        <h2>Sayfa bulunamadı!</h2>
        <p>Aradığınız sayfanın adı değiştirilmiş veya geçici olarak kullanım dışı kalmış olabilir.</p>
        <a href="javascript:history.go(-1)">Geri dön</a>
    </div>
</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
