<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Şifre Düzenle <small>(<?=$item->user_name?>)</small>
            <a href="<?=base_url('users')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div><!-- END column -->
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <form method="post" action="<?=base_url("users/updatePassword/$item->id")?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Şifre<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Şifre giriniz" value="<?=isset($form_error) && set_value('password') ? set_value('password') : "" ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('password')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Şifre Tekrar<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="re_password" placeholder="Şifreyi tekrar giriniz" value="<?=isset($form_error) && set_value('re_password') ? set_value('re_password') : "" ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('re_password')?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Güncelle</button>
                </form>
            </div>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>