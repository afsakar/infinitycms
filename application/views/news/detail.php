<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <?php $this->load->view('includes/head'); ?>
        <title><?=$title ? $title." | " : ""?><?=settings("title")?></title>
        <meta name="description" content="<?=$seo["description"] ? $seo["description"] : settings("meta_description")?>">
        <meta name="title" content="<?=$seo["title"] ? $seo["title"] : settings("meta_title")?>">
        <meta name="keywords" content="<?=$seo["keywords"] ? $seo["keywords"] : settings("meta_keywords")?>">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="<?=$seo["title"] ? $seo["title"] : $news->title ."|". settings("meta_title")?>">
        <meta property="og:site_name" content="<?=settings("title")?>">
        <meta property="og:description" content="<?=$seo["description"] ? $seo["description"] : settings("meta_description")?>">
        <meta property="og:keywords" content="<?=$seo["keywords"] ? $seo["keywords"] : settings("meta_keywords")?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?=base_url("news/$news->url")?>">
        <meta property="og:image" content="">
    </head>
<body>

<!-- Add your site or application content here -->

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">

    <?php $this->load->view('includes/header'); ?>

    <!-- Breacrumb Area -->
    <div class="breadcrumb-area cover-image" data-black-overlay="7" style="background: url(<?php if($news->img_url){ echo base_url("admin/uploads/$viewFolder/").$news->img_url; }else{ echo logo("cover"); } ?>) no-repeat scroll center center;">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="cr-breadcrumb text-center">
                        <h1><?=$news->title?></h1>
                        <p><?=$breadcrumbs?></p>
                        <a href="<?=base_url("news/")?>" class="cr-btn cr-btn-sm">
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

        <!-- Blog List -->
        <section class="blog-details-list-area section-padding-lg bg-white">
            <div class="container">
                <div class="row">

                    <!-- Blog Details -->
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-10 offset-lg-1">
                                <div class="blog-details">
                                    <div class="blog-details-thumb cr-slider-navigation-3">
                                        <?php if($news->news_type == "video"): ?>
                                            <iframe src="<?=$news->video_url?>" frameborder="0" style="height: 500px;"></iframe>
                                        <?php else: ?>
                                            <?php if($images): ?>
                                                <?php foreach ($images as $image): ?>
                                                    <img data-src="<?=base_url("admin/uploads/$viewFolder/$image->image_url")?>" src="<?=base_url("admin/uploads/$viewFolder/$image->image_url")?>" alt="<?=$news->title?>">
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <img data-src="<?=base_url("admin/uploads/$viewFolder/$news->img_url")?>" src="<?=base_url("admin/uploads/$viewFolder/$news->img_url")?>" alt="<?=$news->title?>">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="blog-details-main">
                                        <h2 class="blog-details-title"><?=$news->title?></h2>
                                        <ul class="blog-details-meta">
                                            <li><?=timeConvert($news->createdAt)?></li>
                                            <li>
                                                <?=$author->full_name?>
                                            </li>
                                            <li>
                                                <?=$comment_count?> Yorum
                                            </li>
                                            <li>
                                                <?=$news->viewCount?> Görüntülenme
                                            </li>
                                        </ul>
                                        <div class="blog-details-content clearfix">
                                            <?=htmlspecialchars_decode($news->description)?>
                                        <?php if($news->news_type == "video"): ?>
                                            <?php if($images): ?>
                                        <!-- Portfolio Area -->
                                        <section class="portfolio-area bg-white section-padding-xs">
                                            <div class="portfolio-wrap">
                                                <h3 class="text-black">Görseller</h3>
                                                <!-- Portfolios -->
                                                <div class="row no-gutters portfolios portfolios-style-1 portfolios-zoom-button-holder" data-show="6" data-load="3">
                                                    <div class="container">
                                                        <?php foreach ($images as $file): ?>
                                                        <!-- Single Portfolio -->
                                                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 portfolio-single pfolio-filter-creative">
                                                            <div class="portfolio">
                                                                <div class="portfoilo-thumb">
                                                                    <img src="<?=base_url("admin/uploads/$viewFolder/$file->image_url")?>" alt="portfolio thumb">
                                                                </div>
                                                                <div class="portfolio-content">
                                                                    <div class="portfolio-content-inner text-center">
                                                                        <a href="<?=base_url("admin/uploads/$viewFolder/$file->image_url")?>" class="portfolio-zoom-trigger">
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
                                            </div>
                                        </section>
                                        <!--// Portfolio Area -->
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="blog-details-block blog-details-social">
                                    <div class="blog-details-social-icons">
                                        <h6>Paylaş: </h6>
                                        <div class="social-icons social-icons-rounded social-icons-colorized">
                                            <ul>
                                                <li class="facebook">
                                                    <a href="https://www.facebook.com/sharer.php?s=100&p[url]=<?=base_url("news/$news->url")?>&p[title]=<?=$news->title?>" target="_blank">
                                                        <i class="icofont icofont-social-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="twitter">
                                                    <a href="https://twitter.com/share?url=<?=base_url("news/$news->url")?>&text=<?=$news->title?>" target="_blank">
                                                        <i class="icofont icofont-social-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="pinterest">
                                                    <a href="https://pinterest.com/pin/create/bookmarklet/?media=<?=base_url("admin/uploads/$viewFolder/$news->img_url")?>&url=<?=base_url("news/$news->url")?>&description=<?=$news->title?>" target="_blank">
                                                        <i class="icofont icofont-social-pinterest"></i>
                                                    </a>
                                                </li>
                                                <li class="whatsapp">
                                                    <a href="https://wa.me/?text=<?=base_url("news/$news->url")?>" target="_blank">
                                                        <i class="icofont icofont-social-whatsapp"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="blog-details-block commentlist">
                                    <h4 class="small-title">Yorumlar</h4>
                                    <?php if($comments): ?>
                                        <?php foreach ($comments as $comment): ?>
                                        <div class="comment">
                                            <div class="blog-details-authoriamge">
                                                <?php $authorInfo = $this->data_model->get("users", array("email" => $comment->email)); ?>
                                                <?php if($authorInfo): ?>
                                                    <img src="<?=base_url("admin/uploads/users_view/$authorInfo->img_url")?>" alt="<?=$comment->name?>">
                                                <?php else: ?>
                                                    <img src="<?=get_gravatar($comment->email)?>" alt="<?=$comment->name?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="comment__content">
                                                <div class="comment__content__top">
                                                    <h6><?=$comment->name?></h6>
                                                    <span><?=timeConvert($comment->createdAt)?></span>
                                                </div>
                                                <div class="comment__content__bottom"><?=$comment->content?></div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php if($news->isComment == 1): ?>
                                            <div class="alert alert-info">Henüz yorum yapılmadı. İlk yorumu siz yapın!</div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <?php if($news->isComment == 1): ?>
                                <div class="blog-details-block commentbox" id="comment">
                                    <h4 class="small-title">Yorum Yapın</h4>
                                    <form action="<?=base_url("news/addComment/$news->id#comment")?>" method="post">
                                        <div class="row">
                                            <?php if($user): ?>
                                            <div class="col-lg-12 text-center">
                                                <div class="alert alert-info"><span class="alert-link">
                                                    <?=$user->user_name?></span> olarak yorum yapıyorsunuz. <a class="alert-link" href="#">Çıkış yap</a>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="single-input">
                                                        <label for="commenter-name">Adınız Soyadınız</label>
                                                        <input type="text" name="name" id="commenter-name" placeholder="Adınız soyadınız.." value="<?php if (isset($form_error)){ echo set_value('name'); } ?>">
                                                        <?php if(isset($form_error)): ?>
                                                            <span id="helpBlock" class="help-block text-danger"><?=form_error('name')?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="single-input">
                                                        <label for="commenter-email">Email Adresiniz</label>
                                                        <input type="email" name="email" id="commenter-email" placeholder="Email adresiniz.." value="<?php if (isset($form_error)){ echo set_value('email'); } ?>">
                                                        <?php if(isset($form_error)): ?>
                                                            <span id="helpBlock" class="help-block text-danger"><?=form_error('email')?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="col-lg-12">
                                                <div class="single-input">
                                                    <label for="commenter-message">Yorumunuz</label>
                                                    <textarea name="content" id="content" cols="30" rows="5" placeholder="Yorumunuz.."><?php if (isset($form_error)){ echo set_value('content'); } ?></textarea>
                                                    <?php if(isset($form_error)): ?>
                                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('content')?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 m-t-10">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <?=$captcha["image"]?>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="single-input">
                                                            <input type="text" name="captcha" placeholder="Güvenlik kodunu giriniz">
                                                            <?php if(isset($form_error)): ?>
                                                                <small id="helpBlock" class="text-danger"><?=form_error('captcha')?></small>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>">
                                            <div class="col-lg-12">
                                                <div class="single-input">
                                                    <button type="submit" class="cr-btn">
                                                        <span>Gönder</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <!--// Blog Details -->

                </div>
            </div>
        </section>
        <!--// Blog List -->

    </main>
    <!-- //Page Content -->

    <?php $this->load->view('includes/footer'); ?>

</div>
<!-- //Main wrapper -->

<?php $this->load->view('includes/include_script'); ?>

</body>

</html>