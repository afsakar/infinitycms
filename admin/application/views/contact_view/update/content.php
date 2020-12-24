<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Marka Düzenle <small>(<?=$item->title?>)</small>
            <a href="<?=base_url('brands')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div><!-- END column -->
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("brands/updateItem/$item->id"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Başlık" name="title" value="<?php echo $item->title; ?>">
                        <?php if(isset($form_error)){ ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                        <?php } ?>
                    </div>
                    <div class="form-group imageContainer">
                        <img width="200" src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?>" alt="" class="img-responsive" style="margin-bottom: 24px;">
                        <label>Görsel Seçiniz</label>
                        <input type="file" name="img_url" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Güncelle</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>