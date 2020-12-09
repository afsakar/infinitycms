<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Etkinlik Listesi
            <a href="<?=base_url('courses/addForm')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">

            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır. Kayıt eklemek için <a href="<?=base_url('courses/addForm')?>" class="alert-link">buraya</a> tıklayın.</p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" data-plugin="DataTable" data-options="{ responsive: true }" class="table table-striped table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <th class="text-center" scope="col"></th>
                        <th class="text-center" scope="col">#ID</th>
                        <th class="text-center" scope="col">Url</th>
                        <th class="text-center" scope="col">Başlık</th>
                        <th class="text-center" scope="col">Etkinlik Tarihi</th>
                        <th class="text-center" scope="col">Etkinlik Saati</th>
                        <th class="text-center" scope="col">Durumu</th>
                        <th class="text-center" scope="col">İşlemler</th>
                        </thead>
                        <tbody class="sortable" data-url="<?php echo base_url("courses/rankSetter")?>">
                        <?php foreach ($items as $item): ?>
                            <tr id="ord-<?=$item->id?>">
                                <td class="text-center sortableItem"><i class="fa fa-bars"></i></td>
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <td class="text-center"><?=$item->url?></td>
                                <td class="text-center"><?=$item->title?></td>
                                <td class="text-center"><?=$item->eventDate?></td>
                                <td class="text-center"><?=$item->eventTime?></td>
                                <td class="text-center">
                                    <input class="isActive" data-url="<?php echo base_url("courses/isActiveSetter/$item->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo base_url("courses/imageForm/$item->id")?>" class="btn btn-warning btn-sm btn-outline"><i class="fa fa-image"></i> Resimler</a>
                                    <a href="<?php echo base_url("courses/updateForm/$item->id")?>" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <button data-url="<?php echo base_url("courses/deleteItem/$item->id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
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
