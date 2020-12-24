<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yorum Düzenle <small>(<?=$item->title?>)</small>
            <a href="<?=base_url('testimonials')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div><!-- END column -->
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("testimonials/updateItem/$item->id"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group imageContainer">
                        <img width="200" src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?>" alt="" class="img-responsive" style="margin-bottom: 24px;">
                        <label>Görsel Seçiniz</label>
                        <input type="file" name="img_url" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Yorum Sahibi Adı Soyadı</label>
                        <input class="form-control" placeholder="Yorum sahibi adı soyadı" name="title" value="<?php if(isset($form_error) && set_value('title')){echo set_value('title'); }else{ echo $item->title; } ?>">
                        <?php if(isset($form_error)){ ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Firma<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="company_name" placeholder="Başlık Giriniz" value="<?php if (isset($formError) && set_value('company_name')){ echo set_value('company_name'); }else{ echo $item->company_name; } ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('company_name')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Yorum<span class="text-danger">*</span></label>
                        <textarea id="maxlength-demo-4" name="description" maxlength="500" class="form-control" data-plugin="maxlength" data-options="{ alwaysShow: true, threshold: 10, warningClass: 'label label-warning', limitReachedClass: 'label label-danger', placement: 'bottom', message: 'used %charsTyped% of %charsTotal% chars.' }" placeholder="Yorum"><?php if (isset($formError) && set_value('description')){ echo set_value('description'); }else{ echo $item->description; } ?></textarea>
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('description')?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Güncelle</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>