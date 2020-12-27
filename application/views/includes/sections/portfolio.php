<?php if($projects): ?>
<!-- Portfolio Area -->
<section class="portfolio-area section-padding-top-lg bg-white">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-12 offset-0">
                <div class="section-title text-center">
                    <h2>Projelerimiz</h2>
<!--                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered-->
<!--                        alteration in some form, by injected humour</p>-->
                </div>
            </div>
        </div>
    </div>

    <div class="portfolio-wrap">

        <!-- Poftfolio Filters -->
        <div class="portfolio-filters">
            <button class="is-checked" data-filter="*">Tümü</button>
            <?php foreach ($projects_categories as $category): ?>
                <button data-filter=".<?=$category->id?>"><?=$category->category_name?></button>
            <?php endforeach; ?>
        </div>
        <!--// Poftfolio Filters -->

        <!-- Portfolios -->
        <div class="row no-gutters portfolios portfolios-style-2" data-show="3" data-load="3">
            <?php foreach ($projects as $project): ?>
                <!-- Single Portfolio -->
                <div class="cr-col-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 portfolio-single <?=$project->category_id?>">
                    <div class="portfolio">
                        <div class="portfoilo-thumb">
                            <img src="<?php if(getCover($project->id)){ echo base_url("admin/uploads/projects_view/").getCover($project->id); }else{ echo logo("cover"); } ?>" alt="<?=$project->title?>" height="300" class="fitCover">
                        </div>
                        <div class="portfolio-content">
                            <div class="portfolio-content-inner text-center">
                                <h6><?=$project->projectDate?></h6>
                                <h3>
                                    <a href="<?=base_url("projects/$project->url")?>"><?=$project->title?></a>
                                </h3>
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

    </div>

</section>
<!--// Portfolio Area -->
<?php endif; ?>