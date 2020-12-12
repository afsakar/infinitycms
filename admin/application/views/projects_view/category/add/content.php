<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yeni Kategori Ekle
            <a href="<?=base_url('projects_category')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <!-- Tab panes -->
                <form method="post" action="<?=base_url('projects/addCategory')?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kategori Adı<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="category_name" placeholder="Kategori Adı" value="<?php if (isset($form_error)){ echo set_value('category_name'); } ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('category_name')?></span>
                        <?php endif; ?>
                    </div>
                <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Kaydet</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>