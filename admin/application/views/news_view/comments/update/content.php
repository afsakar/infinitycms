<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yorum Düzenle
            <a href="<?=base_url('comments')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div><!-- END column -->
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("news/updateComment/$item->id"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Yorum</label>
                        <textarea name="content" class="form-control" rows="5"><?php echo $item->content; ?></textarea>
                        <?php if(isset($form_error)){ ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('content')?></span>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Güncelle</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>