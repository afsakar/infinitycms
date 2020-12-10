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
                    <form method="post" action="<?=base_url("galleries/updateVideo/$item->id/$id")?>">
                        <div class="form-group">
                            <label>Başlık<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="url" placeholder="Başlık Giriniz" value="<?=isset($form_error) ? set_value('url') : $item->url ?>">
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