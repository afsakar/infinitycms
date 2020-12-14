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
                        <h1>Projelerimiz</h1>
                        <p><?=$breadcrumbs?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Breacrumb Area -->

    <!-- Page Content -->
    <main class="page-content">

        <!-- Portfolio Area -->
        <section class="portfolio-area bg-white section-padding-lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portfolio-wrap">

                            <?php if(empty($projects)): ?>
                                <div class="col-md-8 offset-md-2">
                                    <div class="alert alert-info text-center"><i class="icofont icofont-info-circle"></i> Henüz bir proje eklenmedi.</div>
                                </div>
                            <?php else: ?>
                                <!-- Poftfolio Filters -->
                                <div class="portfolio-filters portfolio-filters-minimal text-center mt-0">
                                    <button class="is-checked" data-filter="*">all</button>
                                    <?php foreach ($categories as $category): ?>
                                        <button data-filter=".<?=$category->id?>"><?=$category->category_name?></button>
                                    <?php endforeach; ?>
                                </div>
                                <!--// Poftfolio Filters -->

                                <!-- Portfolios -->
                                <div class="row portfolios portfolios-minimal-4" data-show="6" data-load="3">
                                    <?php foreach ($projects as $project): ?>
                                        <!-- Single Portfolio -->
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-12 portfolio-single <?=$project->category_id?>">
                                            <div class="portfolio">
                                                <div class="portfoilo-thumb">
                                                    <img src="<?=base_url("admin/uploads/$viewFolder/").getCover($project->id)?>" alt="<?=$project->title?>" height="300" class="fitCover">
                                                </div>
                                                <div class="portfolio-content">
                                                    <div class="portfolio-content-inner text-center">
                                                        <h3>
                                                            <a href="<?=base_url("projects/$project->url")?>"><?=$project->title?></a>
                                                        </h3>
                                                        <h5>
                                                            <?=timeConvert($project->createdAt)?>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--// Single Portfolio -->
                                    <?php endforeach; ?>
                                </div>
                                <!--// Portfolios -->

                                <div class="portfolio-load-more-button text-center">
                                    <button class="load-more-toggle cr-btn cr-btn">
                                        <span>Daha Fazla</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--// Portfolio Area -->

    </main>
    <!-- //Page Content -->

    <?php $this->load->view('includes/footer'); ?>

</div>
<!-- //Main wrapper -->

<?php $this->load->view('includes/include_script'); ?>

</body>

</html>