<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yeni Haber Ekle
            <a href="<?=base_url('news')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <div class="m-b-lg nav-tabs-horizontal">
                    <!-- tabs list -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#general" aria-controls="tab-3" role="tab" data-toggle="tab">Genel</a></li>
                        <li role="presentation"><a href="#seo" aria-controls="tab-1" role="tab" data-toggle="tab">Seo</a></li>
                    </ul><!-- .nav-tabs -->

                    <!-- Tab panes -->
                    <form method="post" action="<?=base_url('news/addItem')?>" enctype="multipart/form-data">
                        <div class="tab-content p-md">

                            <div role="tabpanel" class="tab-pane in active fade" id="general">
                                <div class="form-group">
                                    <label>Başlık<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" placeholder="Başlık Giriniz" value="<?php if (isset($formError)){ echo set_value('title'); } ?>">
                                    <?php if(isset($formError)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Haber Türü</label>
                                    <select name="news_type" class="form-control newsType" data-plugin="select2">
                                        <option <?=isset($formError) && $news_type == "image" ? "selected" : ""?> value="image">Resim</option>
                                        <option <?=isset($formError) && $news_type == "video" ? "selected" : ""?> value="video">Video</option>
                                    </select>
                                </div><!-- .form-group -->

                                <?php if(isset($formError)){ ?>

                                    <div class="form-group imageContainer" style="display: <?=$news_type == "image" ? "block" : "none" ?>">
                                        <label>Görsel</label>
                                        <input type="file" class="form-control" name="img_url">
                                    </div><!-- .form-group -->
                                    <div class="form-group videoContainer" style="display: <?=$news_type == "video" ? "block" : "none" ?>">
                                        <label>Video URL</label>
                                        <input type="url" class="form-control" name="video_url" placeholder="Video bağlantısını giriniz" value="<?php if (isset($formError)){ echo set_value('video_url'); } ?>">
                                        <?php if(isset($formError)): ?>
                                            <span id="helpBlock" class="help-block text-danger"><?=form_error('video_url')?></span>
                                        <?php endif; ?>
                                    </div><!-- .form-group -->

                                    <?php }else{ ?>

                                    <div class="form-group imageContainer">
                                        <label>Görsel</label>
                                        <input type="file" class="form-control" name="img_url">
                                    </div><!-- .form-group -->
                                    <div class="form-group videoContainer" style="display: none;">
                                        <label>Video URL</label>
                                        <input type="url" class="form-control" name="video_url" placeholder="Video bağlantısını giriniz" value="<?php if (isset($formError)){ echo set_value('video_url'); } ?>">
                                    </div><!-- .form-group -->

                                <?php } ?>

                                <div class="form-group">
                                    <label>İçerik<span class="text-danger">*</span></label>
                                    <textarea class="m-0" data-plugin="summernote" name="description" data-options="{height: 250}"><?php if (isset($formError)){ echo set_value('description'); } ?></textarea>
                                    <?php if(isset($formError)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('description')?></span>
                                    <?php endif; ?>
                                </div>
                            </div><!-- .tab-pane  -->

                            <div role="tabpanel" class="tab-pane fade" id="seo">
                                <div class="form-group">
                                    <label>SEO URL</label>
                                    <input type="text" class="form-control" name="url" placeholder="Url giriniz" value="<?php if (isset($formError)){ echo set_value('url'); } ?>">
                                </div>
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" class="form-control" name="seo[title]" placeholder="Başlık giriniz" value="<?php if (isset($formError)){ echo set_value('seo[title]'); } ?>">
                                </div>
                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <input type="text" class="form-control" name="seo[description]" placeholder="Açıklama giriniz" value="<?php if (isset($formError)){ echo set_value('seo[description]'); } ?>">
                                </div>
                                <div class="form-group">
                                    <label>SEO Keywords</label>
                                    <input type="text" data-role="tagsinput" data-plugin="tagsinput" class="form-control" name="seo[keywords]" placeholder="Keyword giriniz" value="<?php if (isset($formError)){ echo set_value('seo[keywords]'); } ?>">
                                </div>
                            </div><!-- .tab-pane  -->
                            <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Kaydet</button>
                        </div><!-- .tab-content  -->
                    </form>
                </div><!-- .nav-tabs-horizontal -->
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>