<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yeni Mesaj Oluştur
            <a href="<?=base_url('members')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <!-- Tab panes -->
                <form method="post" action="<?=base_url('members/sendMessage')?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Konu<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="subject" placeholder="Başlık Giriniz" value="<?php if (isset($formError)){ echo set_value('subject'); } ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('subject')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Mesaj<span class="text-danger">*</span></label>
                        <textarea class="m-0" data-plugin="summernote" name="message" data-options="{height: 250}"><?php if (isset($formError)){ echo set_value('message'); } ?></textarea>
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('message')?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-send-o"></i> Gönder</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>