<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Video Listesi
            <a href="<?=base_url("galleries/addVideoForm/$id")?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">

            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır. Kayıt eklemek için <a href="<?=base_url("galleries/addVideoForm/$id")?>" class="alert-link">buraya</a> tıklayın.</p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" data-plugin="DataTable" class="table table-striped table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <th class="text-center" scope="col"></th>
                        <th class="text-center" scope="col">#ID</th>
                        <th scope="col">Url</th>
                        <th scope="col">Oluşturma Tarihi</th>
                        <th scope="col">Durumu</th>
                        <th scope="col">İşlemler</th>
                        </thead>
                        <tbody class="sortable" data-url="<?php echo base_url("galleries/videoRankSetter/$id")?>">
                        <?php foreach ($items as $item): ?>
                            <tr id="ord-<?=$item->id?>">
                                <td class="text-center sortableItem"><i class="fa fa-bars"></i></td>
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <td><a href="<?=$item->url?>" target="_blank"><?=$item->url?></a></td>
                                <td><?=timeConvert($item->createdAt)?></td>
                                <td>
                                    <input class="isActive" data-url="<?php echo base_url("galleries/videoActiveSetter/$item->id/$id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <td>
                                    <a href="<?php echo base_url("galleries/updateVideoForm/$item->id/$id")?>" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <button data-url="<?php echo base_url("galleries/deleteVideo/$item->id/$id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
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
