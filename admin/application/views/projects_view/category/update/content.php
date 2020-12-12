<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Kategori Düzenle <small>(<?=$item->category_name?>)</small>
            <a href="<?=base_url('projects_category')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div><!-- END column -->
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("projects/updateCategory/$item->id"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Kategori Adı" name="category_name" value="<?php if(isset($form_error)){ echo set_value('category_name'); }else{ echo $item->category_name; } ?>">
                        <?php if(isset($form_error)){ ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('category_name')?></span>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Güncelle</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>