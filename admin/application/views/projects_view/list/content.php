<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Proje Listesi
            <a href="<?=base_url('projects/addForm')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">

            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır. Kayıt eklemek için <a href="<?=base_url('projects/addForm')?>" class="alert-link">buraya</a> tıklayın.</p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" data-plugin="DataTable" data-options="{ responsive: true }" class="table table-striped table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <th class="text-center" scope="col"></th>
                        <th class="text-center" scope="col">#ID</th>
                        <th scope="col">Url</th>
                        <th scope="col">Başlık</th>
                        <th scope="col">Oluşturma Tarihi</th>
                        <th scope="col">Durumu</th>
                        <th scope="col">İşlemler</th>
                        </thead>
                        <tbody class="sortable" data-url="<?php echo base_url("projects/rankSetter")?>">
                        <?php foreach ($items as $item): ?>
                            <tr id="ord-<?=$item->id?>">
                                <td class="text-center sortableItem"><i class="fa fa-bars"></i></td>
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <td><?=$item->url?></td>
                                <td><?=$item->title?></td>
                                <td><?=timeConvert($item->createdAt)?></td>
                                <td>
                                    <input class="isActive" data-url="<?php echo base_url("projects/isActiveSetter/$item->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <td>
                                    <a href="<?php echo base_url("projects/imageForm/$item->id")?>" class="btn btn-warning btn-sm btn-outline"><i class="fa fa-image"></i> Resimler</a>
                                    <a href="<?php echo base_url("projects/updateItem/$item->id")?>" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <button data-url="<?php echo base_url("projects/deleteItem/$item->id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
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
