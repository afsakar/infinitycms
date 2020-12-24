<?php require "menu.php"; ?>
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
                <div class="m-b-lg nav-tabs-horizontal">
                    <!-- tabs list -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#general" aria-controls="tab-3" role="tab" data-toggle="tab">Genel</a></li>
                        <?php if($userRole->user_type == "superadmin"): ?>
                        <li role="presentation"><a href="#permissions" aria-controls="tab-1" role="tab" data-toggle="tab">Yetkiler</a></li>
                        <?php endif; ?>
                    </ul><!-- .nav-tabs -->
                </div>
                <form method="post" action="<?=base_url("users/updateItem/$item->id")?>" enctype="multipart/form-data">
                    <div class="tab-content p-md">
                        <div role="tabpanel" class="tab-pane in active fade" id="general">
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
                            <?php if($userData->user_type == "superadmin"): ?>
                            <div class="form-group">
                                <label>Kullanıcı Tipi<span class="text-danger">*</span></label>
                                <select id="select2-demo-1" name="user_type" class="form-control" data-plugin="select2">
                                    <option <?php if(isset($formError) && set_value('user_type') == "admin" || $item->user_type == "admin"){echo "selected"; }else{ echo ""; } ?> value="admin">Admin</option>
                                    <option <?php if(isset($formError) && set_value('user_type') == "superadmin" || $item->user_type == "superadmin"){echo "selected"; }else{ echo ""; } ?> value="superadmin">Superadmin</option>
                                </select>
                                <?php if(isset($formError)): ?>
                                    <span id="helpBlock" class="help-block text-danger"><?=form_error('user_type')?></span>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php if($userRole->user_type == "superadmin"): ?>
                        <div role="tabpanel" class="tab-pane in fade" id="permissions">
                            <?=$this->session->userdata('permissions');?>
                            <div class="form-group">
                                <?php foreach ($menus as $url => $menu): ?>
                                    <h4 class="m-h-lg"><?=$menu["title"]?></h4>
                                    <?php foreach ($menu["permissions"] as $key => $val): ?>
                                        <div class="checkbox checkbox-primary checkbox-inline">
                                            <input type="checkbox" name="permissions[<?= $menu['url'] ?>][<?= $key ?>]" <?=(isset($permissions[$menu['url']][$key]) && $permissions[$menu['url']][$key] == "on" ? 'checked' : null)?>>
                                            <label for="cb-10"><?=$val?></label>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php if (isset($menu['submenu'])): ?>
                                        <div class="m-l-md p-b-md" style="border-left: 4px solid #ddd;">
                                            <?php foreach ($menu['submenu'] as $k => $submenu): if (!isset($submenu['permissions'])) continue; ?>
                                                <h5 class="m-l-md p-b-md"><?=$submenu["title"]?></h5>
                                                <?php foreach ($submenu['permissions'] as $key => $val): ?>
                                                    <div class="m-l-md p-b-md checkbox checkbox-primary checkbox-inline">
                                                        <input type="checkbox" name="permissions[<?= $submenu['url'] ?>][<?= $key ?>]" <?= (isset($permissions[$submenu['url']][$key]) && $permissions[$submenu['url']][$key] == "on" ? 'checked' : null) ?>>
                                                        <label for="cb-10"><?=$val?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Güncelle</button>
                </form>
            </div>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>