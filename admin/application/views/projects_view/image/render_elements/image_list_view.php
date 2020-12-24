<?php if(empty($itemImages)): ?>

    <div class="alert alert-info text-center">
        <p>Burada herhangi bir kayıt bulunmamaktadır.</p>
    </div>
<?php else: ?>

    <div class="table-responsive">
        <table id="responsive-datatable" class="table table-hover pictures_list" cellspacing="0" width="100%">
            <thead>
    <?php if(permission("projects_category", "edit")): ?>
            <th class="text-center" scope="col"></th>
    <?php endif; ?>
            <th class="text-center" scope="col">#ID</th>
            <th scope="col">Görsel</th>
            <th scope="col">Resim Adı</th>
            <th scope="col">Oluşturma Tarihi</th>
    <?php if(permission("projects_category", "edit")): ?>
            <th scope="col">Durumu</th>
    <?php endif; ?>
        <?php if(permission("projects_category", "edit")): ?>
            <th scope="col">Kapak</th>
        <?php endif; ?>
    <?php if(permission("projects_category", "delete")): ?>
            <th scope="col">İşlemler</th>
    <?php endif; ?>
            </thead>
            <tbody class="sortable" data-url="<?php echo base_url("projects/imageRankSetter")?>">
            <?php foreach ($itemImages as $image): ?>
                <tr id="ord-<?=$image->id?>">
                    <?php if(permission("projects_category", "edit")): ?>
                    <td class="text-center sortableItem"><i class="fa fa-bars"></i></td>
                    <?php endif; ?>
                    <td class="text-center"><?=$image->id?></td>
                    <td style="margin: 0px auto;">
                        <div id="gallery" class="gallery m-b-lg">
                            <div class="gallery-item" style="background-color: transparent;">
                                <div class="thumb">
                                    <a href="<?=base_url("uploads/{$viewFolder}/$image->image_url")?>" data-lightbox="gallery-1" data-title="gallery image">
                                        <img style="width: 50px" src="<?=base_url("uploads/{$viewFolder}/$image->image_url")?>" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><?=$image->image_url?></td>
                    <td><?=timeConvert($image->createdAt)?></td>
        <?php if(permission("projects_category", "edit")): ?>
                    <td>
                        <input class="isActive" data-url="<?php echo base_url("projects/imageIsActiveSetter/$image->id")?>" type="checkbox" data-switchery data-color="#25D366" <?=$image->isActive == 1 ? 'checked' : null?>/>
                    </td>
        <?php endif; ?>
            <?php if(permission("projects_category", "edit")): ?>
                    <td>
                        <input class="isCover" data-url="<?php echo base_url("projects/isCoverSetter/$image->id/$image->project_id")?>" type="checkbox" data-switchery data-color="#34B7F1" <?=$image->isCover == 1 ? 'checked' : null?>/>
                    </td>
        <?php endif; ?>
                <?php if(permission("projects_category", "delete")): ?>
                    <td>
                        <button data-url="<?php echo base_url("projects/deleteImage/$image->id/$image->project_id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
                    </td>
                <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>