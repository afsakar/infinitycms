<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Genel Ayarlar
        </h4>
        <?=$breadcrumbs?>
    </div><!-- END column -->
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <div class="m-b-lg nav-tabs-horizontal">
                    <!-- tabs list -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#general" aria-controls="tab-3" role="tab" data-toggle="tab">Genel</a></li>
                        <li role="presentation"><a href="#seo" aria-controls="tab-1" role="tab" data-toggle="tab">Seo</a></li>
                        <li role="presentation"><a href="#aboutUs" aria-controls="tab-1" role="tab" data-toggle="tab">Hakkımızda</a></li>
                        <li role="presentation"><a href="#mission" aria-controls="tab-1" role="tab" data-toggle="tab">Misyon</a></li>
                        <li role="presentation"><a href="#vision" aria-controls="tab-1" role="tab" data-toggle="tab">Vizyon</a></li>
                        <li role="presentation"><a href="#api" aria-controls="tab-1" role="tab" data-toggle="tab">Api</a></li>
                        <li role="presentation"><a href="#socialMedia" aria-controls="tab-1" role="tab" data-toggle="tab">Sosyal Medya</a></li>
                        <li role="presentation"><a href="#comment" aria-controls="tab-1" role="tab" data-toggle="tab">Yorum</a></li>
                        <li role="presentation"><a href="#logo" aria-controls="tab-1" role="tab" data-toggle="tab">Logo/Favicon</a></li>
                        <li role="presentation"><a href="#theme" aria-controls="tab-1" role="tab" data-toggle="tab">Tema Ayarları</a></li>
                        <li role="presentation"><a href="#template" aria-controls="tab-1" role="tab" data-toggle="tab">Mesaj Teması</a></li>
                    </ul><!-- .nav-tabs -->

                    <!-- Tab panes -->
                    <form method="post" action="<?=base_url("settings/updateSetting")?>" enctype="multipart/form-data">
                        <div class="tab-content p-md">

                            <div role="tabpanel" class="tab-pane in active fade" id="general">
                                <div class="form-group <?=isset($form_error) ? "has-error has-feedback" : ""?>">
                                    <label>Site/Şirket Adı</label>
                                        <input type="text" class="form-control" <?=isset($form_error) ? 'id="inputError2" aria-describedby="inputError2Status"' : ""?> name="settings[title]" placeholder="Site/Şirket adını giriniz" value="<?=isset($form_error) ? set_value('settings[title]') : settings('title')?>">
                                    <?php if(isset($form_error)): ?>
                                        <span class="fa fa-times form-control-feedback" aria-hidden="true"></span>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[title]')?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Telefon</label>
                                            <input type="text" class="form-control" name="settings[phone]" placeholder="Telefon numarası giriniz" value="<?=isset($form_error) ? set_value('settings[phone]') : settings('phone')?>">
                                            <?php if(isset($form_error)): ?>
                                                <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[phone]')?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fax</label>
                                            <input type="text" class="form-control" name="settings[fax]" placeholder="Fax numarası giriniz" value="<?=isset($form_error) ? set_value('settings[fax]') : settings('fax')?>">
                                            <?php if(isset($form_error)): ?>
                                                <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[fax]')?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mail Adresi</label>
                                    <input type="text" class="form-control" name="settings[email]" placeholder="Email Adresi giriniz" value="<?=isset($form_error) ? set_value('settings[email]') : settings('email')?>">
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[email]')?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Adres</label>
                                    <textarea class="form-control" name="settings[address]" rows="5"><?=isset($form_error) ? set_value('settings[address]') : settings('address')?></textarea>
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[address]')?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Footer Yazısı</label>
                                    <textarea class="m-0" data-plugin="summernote" name="settings[footer_text]" data-options="{height: 250}"><?=isset($form_error) ? set_value('settings[footer_text]') : settings('footer_text')?></textarea>
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[footer_text]')?></span>
                                    <?php endif; ?>
                                </div>
                            </div><!-- .tab-pane  -->
                            <div role="tabpanel" class="tab-pane in fade" id="seo">
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" class="form-control" name="settings[meta_title]" placeholder="Başlık giriniz" value="<?=isset($form_error) ? set_value('settings[meta_title]') : settings('meta_title')?>">
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[meta_title]')?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <textarea name="settings[meta_description]" class="form-control" id="" cols="30" rows="5" placeholder="Açıklama giriniz"><?=isset($form_error) ? set_value('settings[meta_description]') : settings('meta_description')?></textarea>
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[meta_description]')?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>SEO Keywords</label>
                                    <input type="text" data-role="tagsinput" data-plugin="tagsinput" class="form-control" name="settings[meta_keywords]" placeholder="Keyword giriniz" value="<?=isset($form_error) ? set_value('settings[meta_keywords]') : settings('meta_keywords')?>">
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[meta_keywords]')?></span>
                                    <?php endif; ?>
                                </div>
                            </div><!-- .tab-pane  -->
                            <div role="tabpanel" class="tab-pane in fade" id="aboutUs">
                                <div class="form-group imageContainer">
                                    <img width="200" src="<?php echo base_url("uploads/$viewFolder/$item->about_img"); ?>" alt="" class="img-responsive" style="margin-bottom: 24px;">
                                    <label>Görsel Seçiniz</label>
                                    <input type="file" name="about_img" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Başlık</label>
                                    <input type="text" class="form-control" name="settings[about_us_title]" placeholder="Başlık giriniz" value="<?=isset($form_error) ? set_value('settings[about_us_title]') : settings('about_us_title')?>">
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[about_us_title]')?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>İçerik</label>
                                    <textarea class="m-0" data-plugin="summernote" name="settings[about_us]" data-options="{height: 250}"><?=isset($form_error) ? set_value('settings[about_us]') : settings('about_us')?></textarea>
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[about_us]')?></span>
                                    <?php endif; ?>
                                </div>
                            </div><!-- .tab-pane  -->
                            <div role="tabpanel" class="tab-pane in fade" id="mission">
                                <div class="form-group">
                                    <label>Misyon</label>
                                    <textarea class="m-0" data-plugin="summernote" name="settings[mission]" data-options="{height: 250}"><?=isset($form_error) ? set_value('settings[mission]') : settings('mission')?></textarea>
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[mission]')?></span>
                                    <?php endif; ?>
                                </div>
                            </div><!-- .tab-pane  -->
                            <div role="tabpanel" class="tab-pane in fade" id="vision">
                                <div class="form-group">
                                    <label>Vizyon</label>
                                    <textarea class="m-0" data-plugin="summernote" name="settings[vision]" data-options="{height: 250}"><?=isset($form_error) ? set_value('settings[vision]') : settings('vision')?></textarea>
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[vision]')?></span>
                                    <?php endif; ?>
                                </div>
                            </div><!-- .tab-pane  -->
                            <div role="tabpanel" class="tab-pane in fade" id="api">
                                <div class="form-group">
                                    <label>Harita Linki</label>
                                    <textarea class="form-control" name="settings[map_code]" rows="5"><?=isset($form_error) ? set_value('settings[map_code]') : settings('map_code')?></textarea>
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[map_code]')?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Harita Açık/Kapalı</label>
                                    <div id="control-demo-6">
                                        <select name="settings[googlemap_isopen]" class="form-control" data-plugin="select2" style="width: 100%!important;">
                                            <option <?=settings("googlemap_isopen") == 1 ? "selected" : ""?> value="1">Evet</option>
                                            <option <?=settings("googlemap_isopen") == 0 ? "selected" : ""?> value="0">Hayır</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Google Analytics Kodu</label>
                                    <input type="text" class="form-control" name="settings[analytics_code]" placeholder="Lütfen kodu giriniz..." value="<?=isset($form_error) ? set_value('settings[analytics_code]') : settings('analytics_code')?>">
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[analytics_code]')?></span>
                                    <?php endif; ?>
                                </div>
                            </div><!-- .tab-pane  -->
                            <div role="tabpanel" class="tab-pane in fade" id="socialMedia">
                                <div class="col-md-12 m-b-md">
                                    <h5>Lütfen bütün linklerin başına <b>http://</b> yazarak giriniz.</h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Facebook</label>
                                                <input type="text" class="form-control" name="settings[facebook]" placeholder="Facebook adresi giriniz" value="<?=isset($form_error) ? set_value('settings[facebook]') : settings('facebook')?>">
                                                <?php if(isset($form_error)): ?>
                                                    <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[facebook]')?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Twitter</label>
                                                <input type="text" class="form-control" name="settings[twitter]" placeholder="Twitter adresi giriniz" value="<?=isset($form_error) ? set_value('settings[twitter]') : settings('twitter')?>">
                                                <?php if(isset($form_error)): ?>
                                                    <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[twitter]')?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Instagram</label>
                                                <input type="text" class="form-control" name="settings[instagram]" placeholder="Instagram adresi giriniz" value="<?=isset($form_error) ? set_value('settings[instagram]') : settings('instagram')?>">
                                                <?php if(isset($form_error)): ?>
                                                    <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[instagram]')?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Linked-In</label>
                                                <input type="text" class="form-control" name="settings[linkedin]" placeholder="Linkedin adresi giriniz" value="<?=isset($form_error) ? set_value('settings[linkedin]') : settings('linkedin')?>">
                                                <?php if(isset($form_error)): ?>
                                                    <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[linkedin]')?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .tab-pane  -->
                            <div role="tabpanel" class="tab-pane in fade" id="comment">
                                <div class="form-group">
                                    <label>Ziyaretçi yorum onayı</label>
                                    <div id="control-demo-6">
                                        <select name="settings[visitor_comment]" class="form-control" data-plugin="select2" style="width: 100%!important;">
                                            <option <?=settings("visitor_comment") == 1 ? "selected" : ""?> value="1">Açık</option>
                                            <option <?=settings("visitor_comment") == 0 ? "selected" : ""?> value="0">Kapalı</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Üye yorum onayı</label>
                                    <div id="control-demo-6">
                                        <select name="settings[user_comment]" class="form-control" data-plugin="select2" style="width: 100%!important;">
                                            <option <?=settings("user_comment") == 1 ? "selected" : ""?> value="1">Açık</option>
                                            <option <?=settings("user_comment") == 0 ? "selected" : ""?> value="0">Kapalı</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Yorumlar Email ile bilgilendirilsin mi?</label>
                                    <div id="control-demo-6">
                                        <select name="settings[comment_mail]" class="form-control" data-plugin="select2" style="width: 100%!important;">
                                            <option <?=settings("comment_mail") == 1 ? "selected" : ""?> value="1">Evet</option>
                                            <option <?=settings("comment_mail") == 0 ? "selected" : ""?> value="0">Hayır</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane in fade" id="logo">
                                <div class="form-group imageContainer">
                                    <img width="200" src="<?php echo base_url("uploads/$viewFolder/$item->logo"); ?>" alt="" class="img-responsive" style="margin-bottom: 24px;">
                                    <label>Logo Seçiniz</label>
                                    <input type="file" name="logo" class="form-control">
                                </div>
                                <div class="form-group imageContainer">
                                    <img width="50" src="<?php echo base_url("uploads/$viewFolder/$item->favicon"); ?>" alt="" class="img-responsive" style="margin-bottom: 24px;">
                                    <label>Favicon</label>
                                    <input type="file" name="favicon" class="form-control">
                                </div>

                            </div>
                            <div role="tabpanel" class="tab-pane in fade" id="theme">
                                <div class="form-group imageContainer">
                                    <img width="200" src="<?php echo base_url("uploads/$viewFolder/$item->cover"); ?>" alt="" class="img-responsive" style="margin-bottom: 24px;">
                                    <label>Varsayılan Başlık arkaplan görseli</label>
                                    <input type="file" name="cover" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Site rengi</label>
                                    <div id="control-demo-6">
                                        <select name="settings[color]" class="form-control" data-plugin="select2" style="width: 100%!important;">
                                            <option <?=settings("color") == "primary" ? "selected" : ""?> value="primary">Primary</option>
                                            <option <?=settings("color") == "danger" ? "selected" : ""?> value="danger">Danger</option>
                                            <option <?=settings("color") == "warning" ? "selected" : ""?> value="warning">Warning</option>
                                            <option <?=settings("color") == "success" ? "selected" : ""?> value="success">Success</option>
                                            <option <?=settings("color") == "info" ? "selected" : ""?> value="info">Info</option>
                                            <option <?=settings("color") == "purple" ? "selected" : ""?> value="purple">Purple</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>İletişim Bölümü Yazısı</label>
                                    <textarea class="m-0" data-plugin="summernote" name="settings[contact_text]" data-options="{height: 250}"><?=isset($form_error) ? set_value('settings[contact_text]') : settings('contact_text')?></textarea>
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[contact_text]')?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane in fade" id="template">
                                <div class="form-group">
                                    <label>İletişim Formu'ndan Gelen Mesaj</label>
                                    <textarea class="m-0" data-plugin="summernote" name="settings[contact_template]" data-options="{height: 250}"><?=isset($form_error) ? set_value('settings[contact_template]') : settings('contact_template')?></textarea>
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[contact_template]')?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Admin Panelinden Yanıtlanan Mesaj</label>
                                    <textarea class="m-0" data-plugin="summernote" name="settings[reply_template]" data-options="{height: 250}"><?=isset($form_error) ? set_value('settings[reply_template]') : settings('reply_template')?></textarea>
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('settings[reply_template]')?></span>
                                    <?php endif; ?>
                                </div>
                            </div><!-- .tab-pane  -->
                            <?php if(permission("settings", "edit")): ?>
                            <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-edit"></i> Güncelle</button>
                            <?php endif; ?>
                        </div><!-- .tab-content  -->
                    </form>
                </div><!-- .nav-tabs-horizontal -->
            </div>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>