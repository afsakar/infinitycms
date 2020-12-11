<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Video Listesi
            <a href="<?=base_url("email_settings/addForm")?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg videoListContainer">
            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır. Kayıt eklemek için <a href="<?=base_url("email_settings/addForm")?>" class="alert-link">buraya</a> tıklayın.</p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" data-plugin="DataTable" class="table table-striped table-email table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <th class="text-center" scope="col">#ID</th>
                        <th scope="col">Eposta Başlık</th>
                        <th scope="col">Sunucu Adı</th>
                        <th scope="col">Protokol</th>
                        <th scope="col">Port</th>
                        <th scope="col">Eposta</th>
                        <th scope="col">Kimden</th>
                        <th scope="col">Kime</th>
                        <th scope="col">Durumu</th>
                        <th scope="col">İşlemler</th>
                        </thead>
                        <tbody data-url="<?php echo base_url("email_settings/rankSetter")?>">
                        <?php foreach ($items as $item): ?>
                            <tr id="ord-<?=$item->id?>">
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <td><?=$item->user_name?></td>
                                <td><?=$item->host?></td>
                                <td><?=$item->protocol?></td>
                                <td><?=$item->port?></td>
                                <td><?=$item->user?></td>
                                <td><?=$item->from?></td>
                                <td><?=$item->to?></td>
                                <td>
                                    <input class="isActive" data-url="<?php echo base_url("email_settings/isActiveSetter/$item->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <td>
                                    <a href="<?php echo base_url("email_settings/updateForm/$item->id")?>" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <button data-url="<?php echo base_url("email_settings/deleteItem/$item->id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php endif; ?>
        </div><!-- .widget -->
    </div>
</div>
