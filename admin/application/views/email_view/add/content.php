<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yeni Email Hesabı Ekle
            <a href="<?=base_url("email_settings")?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <form method="post" action="<?=base_url("email_settings/addItem")?>">
                    <div class="form-group">
                        <label>Protokol<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="protocol" placeholder="Protokol" value="<?php if (isset($form_error)){ echo set_value('protocol'); } ?>">
                        <small>SMTP / TLS</small>
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('protocol')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Email Sunucu Bilgisi<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="host" placeholder="Hostname" value="<?php if (isset($form_error)){ echo set_value('host'); } ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('host')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Port<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="port" placeholder="Port" value="<?php if (isset($form_error)){ echo set_value('port'); } ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('port')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Email Adresi<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="user" placeholder="Email adresi" value="<?php if (isset($form_error)){ echo set_value('user'); } ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('user')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Email Şifresi<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Email şifresi" value="<?php if (isset($form_error)){ echo set_value('password'); } ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('password')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Kimden Gidecek?<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="from" placeholder="Siteden giden bildirimlerin gönderileceği adres" value="<?php if (isset($form_error)){ echo set_value('from'); } ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('from')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Bildirimler Kime Gidecek?<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="to" placeholder="Siteden gelen bildirimlerin gideceği adres" value="<?php if (isset($form_error)){ echo set_value('to'); } ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('to')?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Email Başlığı<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="user_name" placeholder="Mail Listesinde Görünecek İsim" value="<?php if (isset($form_error)){ echo set_value('user_name'); } ?>">
                        <?php if(isset($form_error)): ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('user_name')?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Kaydet</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>