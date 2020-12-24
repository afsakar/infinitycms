<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Abone Listesi
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">


            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır.</p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-striped table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <th class="text-center" scope="col">#ID</th>
                        <th class="text-center" scope="col">Email</th>
                        <th class="text-center" scope="col">IP Adres</th>
                        <th class="text-center" scope="col">Abonelik Tarihi</th>
                        <th class="text-center" scope="col">Durumu</th>
                        <th class="text-center" scope="col">İşlemler</th>
                        </thead>
                        <tbody class="sortable" data-url="<?php echo base_url("members/rankSetter")?>">
                        <?php foreach ($items as $item): ?>
                            <tr id="ord-<?=$item->id?>">
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <td class="text-center"><?=$item->email?></td>
                                <td class="text-center"><?=$item->ip_address?></td>
                                <td class="text-center"><?=timeConvert($item->createdAt)?></td>
                                <td class="text-center">
                                    <input class="isActive" data-url="<?php echo base_url("members/isActiveSetter/$item->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <td class="text-center">
                                    <?php if(permission("members", "delete")): ?>
                                    <button data-url="<?php echo base_url("members/deleteItem/$item->id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
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