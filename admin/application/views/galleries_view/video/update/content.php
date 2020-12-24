<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Video Düzenle
            <a href="<?=base_url("galleries/videos/$id")?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                    <form method="post" action="<?=base_url("galleries/updateVideo/$item->id/$id")?>" enctype="multipart/form-data">
                        <div class="form-group imageContainer">
                            <img width="200" src="<?php echo base_url("uploads/$viewFolder/video/$item->video_cover"); ?>" alt="" class="img-responsive" style="margin-bottom: 24px;">
                            <label>Görsel Seçiniz</label>
                            <input type="file" name="video_cover" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Başlık<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Başlık Giriniz" value="<?=isset($form_error) ? set_value('title') : $item->file_name ?>">
                            <?php if(isset($form_error)): ?>
                                <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>URL<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="url" placeholder="URL Giriniz" value="<?=isset($form_error) ? set_value('url') : $item->url ?>">
                            <small>URL başına http:// koymayı unutmayınız!</small>
                            <?php if(isset($form_error)): ?>
                                <span id="helpBlock" class="help-block text-danger"><?=form_error('url')?></span>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-edit"></i> Güncelle</button>
                    </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>