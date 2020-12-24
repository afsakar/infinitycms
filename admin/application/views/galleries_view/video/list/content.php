<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Video Listesi
            <?php if(permission("galleries", "add")): ?>
            <a href="<?=base_url("galleries/addVideoForm/$id")?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
            <?php endif; ?>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">

            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır. <?php if(permission("galleries", "add")): ?>Kayıt eklemek için <a href="<?=base_url("galleries/addVideoForm/$id")?>" class="alert-link">buraya</a> tıklayın.<?php endif; ?></p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-striped table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <th class="text-center" scope="col"></th>
                        <th class="text-center" scope="col">#ID</th>
                        <th scope="col">Başlık</th>
                        <th scope="col">Url</th>
                        <th scope="col">Oluşturma Tarihi</th>
                        <?php if(permission("galleries", "edit")): ?>
                        <th scope="col">Durumu</th>
                        <?php endif; ?>
                        <th scope="col">İşlemler</th>
                        </thead>
                        <tbody class="sortable" data-url="<?php echo base_url("galleries/videoRankSetter/$id")?>">
                        <?php foreach ($items as $item): ?>
                            <tr id="ord-<?=$item->id?>">
                                <td class="text-center sortableItem"><i class="fa fa-bars"></i></td>
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <th class="text-center" scope="row"><?=$item->file_name?></th>
                                <td><a href="<?=$item->url?>" target="_blank"><?=$item->url?></a></td>
                                <td><?=timeConvert($item->createdAt)?></td>
                                <?php if(permission("galleries", "edit")): ?>
                                <td>
                                    <input class="isActive" data-url="<?php echo base_url("galleries/videoActiveSetter/$item->id/$id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <?php endif; ?>
                                <td>
                                    <?php if(permission("galleries", "edit")): ?>
                                    <a href="<?php echo base_url("galleries/updateVideoForm/$item->id/$id")?>" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <?php endif; ?>
                                    <?php if(permission("galleries", "delete")): ?>
                                    <button data-url="<?php echo base_url("galleries/deleteVideo/$item->id/$id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
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
