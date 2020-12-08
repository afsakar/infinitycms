<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Haber Düzenle <small>(<?=$item->title?>)</small>
            <a href="<?=base_url('news')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <div class="m-b-lg nav-tabs-horizontal">
                    <!-- tabs list -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#general" aria-controls="tab-3" role="tab" data-toggle="tab">Genel</a></li>
                        <li role="presentation"><a href="#seo" aria-controls="tab-1" role="tab" data-toggle="tab">Seo</a></li>
                    </ul><!-- .nav-tabs -->
                <form action="<?php echo base_url("news/updateItem/$item->id"); ?>" method="post" enctype="multipart/form-data">
                    <div class="tab-content p-md">
                        <div role="tabpanel" class="tab-pane in active fade" id="general">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Başlık" name="title" value="<?php echo $item->title; ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="control-demo-6" class="">Haberin Türü</label>
                        <div id="control-demo-6" class="">
                            <?php if(isset($form_error)) { ?>
                                <select class="form-control newsType" name="news_type" data-plugin="select2">
                                    <option <?php echo ($news_type == "image") ? "selected" : ""; ?> value="image">Resim</option>
                                    <option <?php echo ($news_type == "video") ? "selected" : ""; ?> value="video">Video</option>
                                </select>
                            <?php } else { ?>
                                <select class="form-control newsType" name="news_type" data-plugin="select2">
                                    <option <?php echo ($item->news_type == "image") ? "selected" : ""; ?> value="image">Resim</option>
                                    <option <?php echo ($item->news_type == "video") ? "selected" : ""; ?> value="video">Video</option>
                                </select>
                            <?php } ?>
                        </div>
                    </div><!-- .form-group -->

                    <?php if(isset($form_error)){ ?>

                        <div class="row">

                            <div class="col-md-1 imageContainer">
                                <img src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?>" alt="" class="img-responsive">
                            </div>

                            <div class="form-group imageContainer" style="display: <?php echo ($news_type == "image") ? "block" : "none"; ?>">
                                <label>Görsel Seçiniz</label>
                                <input type="file" name="img_url" class="form-control">
                            </div>


                        </div>

                        <div class="form-group videoContainer" style="display: <?php echo ($news_type == "video") ? "block" : "none"; ?>">
                            <label>Video URL</label>
                            <input class="form-control" placeholder="Video bağlantısını buraya yapıştırınız" name="video_url">
                            <?php if(isset($formError)): ?>
                                <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                            <?php endif; ?>
                        </div>


                    <?php } else { ?>

                        <div class="row">

                            <div class="col-md-1 imageContainer">
                                <img src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?>" alt="" class="img-responsive">
                            </div>

                            <div class="col-md-9 form-group imageContainer" style="display: <?php echo ($item->news_type == "image") ? "block" : "none"; ?>">
                                <label>Görsel Seçiniz</label>
                                <input type="file" name="img_url" class="form-control">
                            </div>

                        </div>

                        <div class="form-group videoContainer" style="display: <?php echo ($item->news_type == "video") ? "block" : "none"; ?>">
                            <label>Video URL</label>
                            <input class="form-control" placeholder="Video bağlantısını buraya yapıştırınız" name="video_url" value="<?php echo $item->video_url; ?>">
                        </div>


                    <?php } ?>

                            <div class="form-group">
                                <label>Açıklama</label>
                                <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo $item->description; ?></textarea>
                                <?php if(isset($formError)): ?>
                                    <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="seo">
                            <div class="form-group">
                                <label>SEO URL</label>
                                <input type="text" class="form-control" name="url" placeholder="Url giriniz" value="<?php echo $item->url; ?>">
                            </div>
                            <div class="form-group">
                                <label>SEO Title</label>
                                <input type="text" class="form-control" name="seo[title]" placeholder="Başlık giriniz" value="<?php echo $seo['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label>SEO Description</label>
                                <input type="text" class="form-control" name="seo[description]" placeholder="Açıklama giriniz" value="<?php echo $seo['description']; ?>">
                            </div>
                            <div class="form-group">
                                <label>SEO Keywords</label>
                                <input type="text" data-role="tagsinput" data-plugin="tagsinput" class="form-control" name="seo[keywords]" placeholder="Keyword giriniz" value="<?php echo $seo['keywords']; ?>">
                            </div>
                        </div><!-- .tab-pane  -->
                        <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Güncelle</button>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>