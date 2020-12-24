<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yeni Slider Ekle
            <a href="<?=base_url('sliders')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <!-- Tab panes -->
                <form method="post" action="<?=base_url('sliders/addItem')?>" enctype="multipart/form-data">
                    <div class="form-group imageContainer">
                        <label>Görsel</label>
                        <input type="file" class="form-control" name="img_url">
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Başlık<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Başlık Giriniz" value="<?php if (isset($formError)){ echo set_value('title'); } ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <h5 class="m-b-lg">Buton var mı?</h5>
                        <div class="radio radio-inline radio-primary">
                            <input type="radio" class="allowBtn" id="yes" name="allowButton" value="1" <?php if (isset($formError) && set_value('allowButton') == 1){ echo "checked"; } ?>>
                            <label for="yes">Evet</label>
                        </div>
                        <div class="radio radio-inline radio-primary">
                            <input type="radio" class="allowBtn" id="no" name="allowButton" value="0" <?php if (isset($formError) && set_value('allowButton') == 0){ echo "checked"; } ?>>
                            <label for="no">Hayır</label>
                        </div>
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('allowButton')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="btnContainer" style="display: none">
                        <div class="form-group">
                            <label>Buton URL<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="buttonUrl" placeholder="Buton URL'si giriniz" value="<?php if (isset($formError)){ echo set_value('buttonUrl'); } ?>">
                            <?php if(isset($formError)): ?>
                                <span id="helpBlock" class="help-block text-danger"><?=form_error('buttonUrl')?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Buton Yazısı<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="buttonText" placeholder="Buton yazısı giriniz" value="<?php if (isset($formError)){ echo set_value('buttonText'); } ?>">
                            <?php if(isset($formError)): ?>
                                <span id="helpBlock" class="help-block text-danger"><?=form_error('buttonText')?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>İçerik<span class="text-danger">*</span></label>
                        <textarea id="maxlength-demo-4" name="description" maxlength="255" class="form-control" data-plugin="maxlength" data-options="{ alwaysShow: true, threshold: 10, warningClass: 'label label-warning', limitReachedClass: 'label label-danger', placement: 'bottom', message: 'used %charsTyped% of %charsTotal% chars.' }" placeholder="Açıklama"><?php if (isset($formError)){ echo set_value('description'); } ?></textarea>
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