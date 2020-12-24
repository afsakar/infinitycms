<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Popup Düzenle <small>(<?=$item->title?>)</small>
            <a href="<?=base_url('popups')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div><!-- END column -->
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("popups/updateItem/$item->id"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Başlık Giriniz" value="<?=isset($form_error) && set_value('title') ? set_value('title') : $item->title ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Hangi sayfada gösterilecek?<span class="text-danger">*</span></label>
                        <select id="select2-demo-1" class="form-control" name="page" data-plugin="select2">
                            <?php if(isset($form_error)): ?>
                                <?php foreach ($menus as $menu): ?>
                                    <option <?php echo (set_value('page') == $menu->url) ? "selected" : ""; ?> value="<?=$menu->url?>"><?=$menu->title?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php foreach ($menus as $menu): ?>
                                    <option <?php echo ($item->page == $menu->url) ? "selected" : ""; ?> value="<?=$menu->url?>"><?=$menu->title?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('page')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>İçerik<span class="text-danger">*</span></label>
                        <textarea class="m-0" data-plugin="summernote" name="description" data-options="{height: 250}"><?=isset($form_error) && set_value('title') ? set_value('title') : $item->description ?></textarea>
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('description')?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Güncelle</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>