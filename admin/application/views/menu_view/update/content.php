<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Menü Düzenle <small>(<?=$item->title?>)</small>
            <a href="<?=base_url('menu')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div><!-- END column -->
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("menu/updateItem/$item->id"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Başlık Giriniz" value="<?php if (isset($formError)){ echo set_value('title'); }else{echo $item->title; } ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Altmenü mü?<span class="text-danger">*</span></label>
                        <select id="select2-demo-1" name="isSubmenu" class="form-control" data-plugin="select2">
                            <?php if($formError): ?>
                                <option <?php if(isset($formError) && set_value('isSubmenu') == 0){echo "selected"; }else{ echo ""; } ?> value="0">Hayır</option>
                                <?php foreach($submenus as $submenu): ?>
                                    <option <?php if(set_value('isSubmenu') == $submenu->id){echo "selected"; }else{ echo ""; } ?> value="<?=$submenu->id?>"><?=$submenu->title?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option <?php if($item->isSubmenu == 0){echo "selected"; }else{ echo ""; } ?> value="0">Hayır</option>
                                <?php foreach($submenus as $submenu): ?>
                                    <option <?php if($item->isSubmenu == $submenu->id){echo "selected"; }else{ echo ""; } ?> value="<?=$submenu->id?>"><?=$submenu->title?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>URL<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="url" placeholder="URL Giriniz" value="<?php if (isset($formError)){ echo set_value('url'); }else{echo $item->url; } ?>">
                        <small>Boş bırakırsanız Başlık'tan alacaktır.</small>
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('url')?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Güncelle</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>