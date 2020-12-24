<?php $user = get_active_user(); ?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Kullanıcı Listesi
            <?php if($userRole->user_type == "superadmin"): ?>
            <a href="<?=base_url('users/addForm')?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
            <?php endif; ?>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">

            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır. Kayıt eklemek için <a href="<?=base_url('users/addForm')?>" class="alert-link">buraya</a> tıklayın.</p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-striped table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <th class="text-center" scope="col">#ID</th>
                        <th class="text-center" scope="col">Kullanıcı Adı</th>
                        <th class="text-center" scope="col">E-mail</th>
                        <th class="text-center" scope="col">Oluşturma Tarihi</th>
                        <?php if($userRole->user_type == "superadmin"): ?>
                        <th class="text-center" scope="col">Durumu</th>
                        <?php endif; ?>
                        <th class="text-center" scope="col">İşlemler</th>
                        </thead>
                        <tbody data-url="<?php echo base_url("users/rankSetter")?>">
                        <?php foreach ($items as $item): ?>
                            <tr id="ord-<?=$item->id?>">
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <td width="300">
                                    <div class="media">
                                        <div class="media-left">
                                            <div class="avatar avatar-md avatar-circle">
                                                <img src="<?=base_url("uploads/users_view/$item->img_url")?>" alt="">
                                                <?php if($item->isOnline == 1): ?>
                                                <i class="status status-online"></i>
                                                <?php else: ?>
                                                <i class="status status-offline"></i>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading"><b><?=$item->user_name?></b></h5>
                                            <small class="media-meta"><?=$item->full_name?></small>
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center" scope="row"><?=$item->email?></th>
                                <td class="text-center"><?=timeConvert($item->createdAt)?></td>
                                <?php if($userRole->user_type == "superadmin"): ?>
                                <td class="text-center">
                                    <?php if($item->id != $user->id || $item->user_type != "superadmin"): ?>
                                    <input class="isActive" data-url="<?php echo base_url("users/isActiveSetter/$item->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <a href="<?php echo base_url("users/password/$item->id")?>" class="btn btn-warning btn-sm"><i class="fa fa-key"></i> Şifre Değiştir</a>
                                    <a href="<?php echo base_url("users/updateForm/$item->id")?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Düzenle</a>
                                    <?php if($userRole->user_type == "superadmin"): ?>
                                    <button data-url="<?php echo base_url("users/deleteItem/$item->id")?>" class="btn btn-danger btn-sm remove-btn"><i class="fa fa-trash"></i> Sil</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?=$links?>
                </div>

            <?php endif; ?>
        </div><!-- .widget -->
    </div>
</div>
