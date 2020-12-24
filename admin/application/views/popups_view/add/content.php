<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yeni Marka Ekle
            <a href="<?=base_url('popups')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <!-- Tab panes -->
                <form method="post" action="<?=base_url('popups/addItem')?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Başlık Giriniz" value="<?php if (isset($formError)){ echo set_value('title'); } ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Hangi sayfada gösterilecek?<span class="text-danger">*</span></label>
                        <select id="select2-demo-1" class="form-control" name="page" data-plugin="select2">
                            <?php foreach ($menus as $menu): ?>
                                <option <?php if(isset($formError) && set_value('page') == $menu->url){echo "selected"; }else{ echo ""; } ?> value="<?=$menu->url?>"><?=$menu->title?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('page')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>İçerik<span class="text-danger">*</span></label>
                        <textarea class="m-0" data-plugin="summernote" name="description" data-options="{height: 250}"><?php if (isset($formError)){ echo set_value('description'); } ?></textarea>
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('description')?></span>
                        <?php endif; ?>
                    </div>
                <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Kaydet</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>