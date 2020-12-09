<?php if(empty($itemImages)): ?>
    <div class="alert alert-info text-center">
        <p>Burada herhangi bir kayıt bulunmamaktadır.</p>
    </div>
<?php else: ?>

    <div class="table-responsive">
        <table id="responsive-datatable" data-plugin="DataTable" class="table table-hover pictures_list" cellspacing="0" width="100%">
            <thead>
            <th class="text-center" scope="col"></th>
            <th class="text-center" scope="col">#ID</th>
            <th scope="col">Görsel</th>
            <th scope="col">URL</th>
            <th scope="col">Oluşturma Tarihi</th>
            <th scope="col">Durumu</th>
            <th scope="col">İşlemler</th>
            </thead>
            <tbody class="sortable" data-url="<?php echo base_url("galleries/imageRankSetter")?>">
            <?php foreach ($itemImages as $image): ?>
                <tr id="ord-<?=$image->id?>">
                    <td class="text-center sortableItem"><i class="fa fa-bars"></i></td>
                    <td class="text-center"><?=$image->id?></td>
                    <td style="margin: 0px auto;">
                        <div id="gallery" class="gallery m-b-lg">
                            <div class="gallery-item" style="background-color: transparent;">
                                <div class="thumb">
                                    <a href="<?=base_url($image->url)?>" data-lightbox="gallery-1" data-title="<?=$image->url?>">
                                        <img style="width: 50px" src="<?=base_url($image->url)?>" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><?=$image->url?></td>
                    <td><?=timeConvert($image->createdAt)?></td>
                    <td>
                        <input class="isActive" data-url="<?php echo base_url("galleries/imageIsActiveSetter/$image->id")?>" type="checkbox" data-switchery data-color="#25D366" <?=$image->isActive == 1 ? 'checked' : null?>/>
                    </td>
                    <td>
                        <button data-url="<?php echo base_url("galleries/deleteImage/$image->id/$image->gallery_id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>