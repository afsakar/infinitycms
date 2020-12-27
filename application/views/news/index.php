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
    <div class="breadcrumb-area cover-image" data-black-overlay="7" style="background: url(<?php if($pages->img_url != ""){echo base_url("admin/uploads/menu_view/").$pages->img_url;}else{ echo logo("cover"); } ?>) no-repeat scroll center center;">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="cr-breadcrumb text-center">
                        <h1><?=$title?></h1>
                        <p><?=$breadcrumbs?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Breacrumb Area -->

    <!-- Page Content -->
    <main class="page-content">

        <!-- Blog List -->
        <div class="pg-blog-list-area section-padding-lg bg-white">
            <div class="container">
                <div class="pg-blog-list">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1 col-12 offset-0">

                            <?php foreach ($news as $item): ?>
                            <?php $author = $this->data_model->get("users", array("id" => $item->user_id)); ?>
                                <?php if($item->news_type == "video"): ?>
                                    <!-- Single BLog -->
                                    <article class="pg-blog pg-blog-video">
                                        <div class="pg-blog-thumb">
                                            <iframe src="<?=$item->video_url?>" frameborder="0" style="height: 500px;"></iframe>
                                        </div>
                                        <div class="pg-blog-content">
                                            <h2>
                                                <a href="<?=base_url("news/$item->url")?>"><?=$item->title?></a>
                                            </h2>
                                            <ul class="blog-meta">
                                                <li><?=timeConvert($item->createdAt)?></li>
                                                <li>
                                                    <?=$author->full_name?>
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-eye"></i> <?=$item->viewCount?> Görüntülenme
                                                </li>
                                            </ul>
                                            <p><?=character_limiter(stripHTMLtags($item->description), 500)?></p>
                                        </div>
                                    </article>
                                    <!--// Single BLog -->
                                <?php else: ?>
                                    <?php $images = $this->data_model->getAll("news_images", array("news_id" => $item->id, "isActive" => 1), "rank ASC"); ?>
                                    <!-- Single BLog -->
                                    <article class="pg-blog pg-blog-gallery">
                                        <div class="pg-blog-thumb cr-slider-navigation-3">
                                            <?php if($images): ?>
                                            <?php foreach ($images as $image): ?>
                                            <a href="<?=base_url("news/$item->url")?>">
                                                <img src="<?=base_url("admin/uploads/$viewFolder/$image->image_url")?>" alt="<?=$item->title?>">
                                            </a>
                                            <?php endforeach; ?>
                                            <?php else: ?>
                                                <img src="<?=base_url("admin/uploads/$viewFolder/$item->img_url")?>" alt="<?=$item->title?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="pg-blog-content">
                                            <h2>
                                                <a href="<?=base_url("news/$item->url")?>"><?=$item->title?></a>
                                            </h2>
                                            <ul class="blog-meta">
                                                <li><?=timeConvert($item->createdAt)?></li>
                                                <li>
                                                    <?=$author->full_name?>
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-eye"></i> <?=$item->viewCount?> Görüntülenme
                                                </li>
                                            </ul>
                                            <p><?=character_limiter(stripHTMLtags($item->description), 500)?></p>
                                        </div>
                                    </article>
                                    <!--// Single BLog -->
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-10 offset-xl-1 col-12 offset-0">
                            <?=$links?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Blog List -->

    </main>
    <!-- //Page Content -->

    <?php $this->load->view('includes/footer'); ?>

</div>
<!-- //Main wrapper -->

<?php $this->load->view('includes/include_script'); ?>

</body>

</html>