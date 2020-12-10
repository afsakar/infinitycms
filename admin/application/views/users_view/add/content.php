<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yeni Referans Ekle
            <a href="<?=base_url('users')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <form method="post" action="<?=base_url('users/addItem')?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kullanıcı Adı<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="user_name" placeholder="Kullanıcı adı giriniz" value="<?php if (isset($formError)){ echo set_value('user_name'); } ?>">
                        <small>Lütfen kullanıcı adınızı boşluk kullanmadan giriniz.</small>
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('user_name')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group imageContainer">
                        <label>Avatar</label>
                        <input type="file" class="form-control" name="img_url">
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Adı Soyadı<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="full_name" placeholder="Ad soyad giriniz" value="<?php if (isset($formError)){ echo set_value('full_name'); } ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('full_name')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Email Adresi<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" placeholder="Email adresi giriniz" value="<?php if (isset($formError)){ echo set_value('email'); } ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('email')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Şifre<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Şifre Giriniz" value="<?php if (isset($formError)){ echo set_value('password'); } ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('password')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Şifre tekrar<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="re_password" placeholder="Şifreyi tekrar giriniz" value="<?php if (isset($formError)){ echo set_value('re_password'); } ?>">
                        <?php if(isset($formError)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('re_password')?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Kaydet</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>