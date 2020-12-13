<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yeni Menü Ekle
            <a href="<?=base_url('menu')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <!-- Tab panes -->
                <form method="post" action="<?=base_url('menu/addItem')?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Başlık Giriniz" value="<?php if (isset($formError)){ echo set_value('title'); } ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Altmenü mü?<span class="text-danger">*</span></label>
                        <select id="select2-demo-1" name="isSubmenu" class="form-control" data-plugin="select2">
                                <option <?php if(isset($formError) && set_value('isSubmenu') == 0){echo "selected"; }else{ echo ""; } ?> value="0">Hayır</option>
                            <?php foreach($items as $item): ?>
                                <option <?php if(isset($formError) && set_value('isSubmenu') == $item->id){echo "selected"; }else{ echo ""; } ?> value="<?=$item->id?>"><?=$item->title?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>URL<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="url" placeholder="URL Giriniz" value="<?php if (isset($formError)){ echo set_value('url'); } ?>">
                        <small>Boş bırakırsanız Başlık'tan alacaktır.</small>
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('url')?></span>
                        <?php endif; ?>
                    </div>
                <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Kaydet</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>