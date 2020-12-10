<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Kullanıcı Düzenle <small>(<?=$item->user_name?>)</small>
            <a href="<?=base_url('users')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div><!-- END column -->
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <form method="post" action="<?=base_url("users/updateItem/$item->id")?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kullanıcı Adı<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="user_name" placeholder="Kullanıcı adı giriniz" value="<?=isset($form_error) && set_value('user_name') ? set_value('user_name') : $item->user_name ?>">
                        <small>Lütfen kullanıcı adınızı boşluk kullanmadan giriniz.</small>
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('user_name')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group imageContainer">
                        <label>Avatar</label>
                        <img width="100" src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?>" alt="" class="img-responsive" style="margin-bottom: 24px;">
                        <input type="file" class="form-control" name="img_url">
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Adı Soyadı<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="full_name" placeholder="Ad soyad giriniz" value="<?=isset($form_error) && set_value('full_name') ? set_value('full_name') : $item->full_name ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('full_name')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Email Adresi<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" placeholder="Email adresi giriniz" value="<?=isset($form_error) && set_value('email') ? set_value('email') : $item->email ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('email')?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Güncelle</button>
                </form>
            </div>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>