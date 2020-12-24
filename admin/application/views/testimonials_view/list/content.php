<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Müşteri Yorumları
            <?php if(permission("testimonials", "add")): ?>
                <a href="<?=base_url('testimonials/addForm')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
            <?php endif; ?>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">


            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır. <?php if(permission("testimonials", "add")): ?>Kayıt eklemek için <a href="<?=base_url('testimonials/addForm')?>" class="alert-link">buraya</a> tıklayın.<?php endif; ?></p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-striped table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <?php if(permission("testimonials", "edit")): ?>
                        <th class="text-center" scope="col"></th>
                        <?php endif; ?>
                        <th class="text-center" scope="col">#ID</th>
                        <th class="text-center" scope="col">Yorum Sahibi</th>
                        <th class="text-center" scope="col">Oluşturma Tarihi</th>
                        <?php if(permission("testimonials", "edit")): ?>
                        <th class="text-center" scope="col">Durumu</th>
                        <?php endif; ?>
                        <th class="text-center" scope="col">İşlemler</th>
                        </thead>
                        <tbody class="sortable" data-url="<?php echo base_url("testimonials/rankSetter")?>">
                        <?php foreach ($items as $item): ?>
                            <tr id="ord-<?=$item->id?>">
                                <?php if(permission("testimonials", "edit")): ?>
                                <td class="text-center sortableItem"><i class="fa fa-bars"></i></td>
                                <?php endif; ?>
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <td width="300">
                                    <div class="media">
                                        <div class="media-left">
                                            <div class="avatar avatar-md avatar-circle">
                                                <img src="<?=base_url("uploads/{$viewFolder}/$item->img_url")?>" alt="">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading"><b><?=$item->title?></b></h5>
                                            <small class="media-meta"><?=$item->company_name?></small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"><?=timeConvert($item->createdAt)?></td>
                                <?php if(permission("testimonials", "edit")): ?>
                                <td class="text-center">
                                    <input class="isActive" data-url="<?php echo base_url("testimonials/isActiveSetter/$item->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <?php if(permission("testimonials", "edit")): ?>
                                    <a href="<?php echo base_url("testimonials/updateForm/$item->id")?>" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <?php endif; ?>
                                    <?php if(permission("testimonials", "delete")): ?>
                                    <button data-url="<?php echo base_url("testimonials/deleteItem/$item->id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
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