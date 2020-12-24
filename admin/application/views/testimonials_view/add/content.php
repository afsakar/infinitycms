<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yeni Yorum Ekle
            <a href="<?=base_url('testimonials')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <!-- Tab panes -->
                <form method="post" action="<?=base_url('testimonials/addItem')?>" enctype="multipart/form-data">
                    <div class="form-group imageContainer">
                        <label>Görsel</label>
                        <input type="file" class="form-control" name="img_url">
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Yorum Sahibi Adı Soyadı<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Başlık Giriniz" value="<?php if (isset($formError)){ echo set_value('title'); } ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Firma<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="company_name" placeholder="Başlık Giriniz" value="<?php if (isset($formError)){ echo set_value('company_name'); } ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('company_name')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Yorum<span class="text-danger">*</span></label>
                        <textarea id="maxlength-demo-4" name="description" maxlength="500" class="form-control" data-plugin="maxlength" data-options="{ alwaysShow: true, threshold: 10, warningClass: 'label label-warning', limitReachedClass: 'label label-danger', placement: 'bottom', message: 'used %charsTyped% of %charsTotal% chars.' }" placeholder="Yorum"><?php if (isset($formError)){ echo set_value('description'); } ?></textarea>
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