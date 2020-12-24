<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yeni Proje Ekle
            <a href="<?=base_url("galleries/videos/$id")?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <form method="post" action="<?=base_url("galleries/addVideo/$id")?>" enctype="multipart/form-data">
                    <div class="form-group imageContainer">
                        <label>Görsel</label>
                        <input type="file" class="form-control" name="video_cover">
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Başlık<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Video başlığını giriniz" value="<?php if (isset($form_error)){ echo set_value('title'); } ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>URL<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="url" placeholder="Video URL'sini Giriniz" value="<?php if (isset($form_error)){ echo set_value('url'); } ?>">
                        <small>URL başına http:// koymayı unutmayınız!</small>
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('url')?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Kaydet</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>