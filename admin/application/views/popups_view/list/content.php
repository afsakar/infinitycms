<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Popup Listesi
            <?php if(permission("popups", "add")): ?>
                <a href="<?=base_url('popups/addForm')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
            <?php endif; ?>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">


            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır. <?php if(permission("popups", "add")): ?>Kayıt eklemek için <a href="<?=base_url('popups/addForm')?>" class="alert-link">buraya</a> tıklayın.<?php endif; ?></p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-striped table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <th class="text-center" scope="col">#ID</th>
                        <th class="text-center" scope="col">Başlık</th>
                        <th class="text-center" scope="col">Sayfa</th>
                        <th class="text-center" scope="col">Oluşturma Tarihi</th>
                        <?php if(permission("popups", "edit")): ?>
                        <th class="text-center" scope="col">Durumu</th>
                        <?php endif; ?>
                        <th class="text-center" scope="col">İşlemler</th>
                        </thead>
                        <tbody class="sortable" data-url="<?php echo base_url("popups/rankSetter")?>">
                        <?php foreach ($items as $item): ?>
                            <tr id="ord-<?=$item->id?>">
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <td class="text-center"><?=$item->title?></td>
                                <td class="text-center"><?=$item->page?></td>
                                <td class="text-center"><?=timeConvert($item->createdAt)?></td>
                                <?php if(permission("popups", "edit")): ?>
                                <td class="text-center">
                                    <input class="isActive" data-url="<?php echo base_url("popups/isActiveSetter/$item->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <?php if(permission("popups", "edit")): ?>
                                    <a href="<?php echo base_url("popups/updateForm/$item->id")?>" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <?php endif; ?>
                                    <?php if(permission("popups", "delete")): ?>
                                    <button data-url="<?php echo base_url("popups/deleteItem/$item->id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
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