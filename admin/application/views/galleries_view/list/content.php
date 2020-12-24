<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Galeri Listesi
            <?php if(permission("galleries", "add")): ?>
            <a href="<?=base_url('galleries/addForm')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
            <?php endif; ?>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">

            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır. <?php if(permission("galleries", "add")): ?>Kayıt eklemek için <a href="<?=base_url('galleries/addForm')?>" class="alert-link">buraya</a> tıklayın.<?php endif; ?></p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-striped table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <?php if(permission("galleries", "edit")): ?>
                        <th class="text-center" scope="col"></th>
                        <?php endif; ?>
                        <th class="text-center" scope="col">#ID</th>
                        <th class="text-center" scope="col">Url</th>
                        <th class="text-center" scope="col">Galeri Adı</th>
                        <th class="text-center" scope="col">Galeri Türü</th>
                        <th class="text-center" scope="col">Klasör Adı</th>
                        <th class="text-center" scope="col">Oluşturma Tarihi</th>
                        <?php if(permission("galleries", "edit")): ?>
                        <th class="text-center" scope="col">Durumu</th>
                        <?php endif; ?>
                        <th class="text-center" scope="col">İşlemler</th>
                        </thead>
                        <tbody class="sortable" data-url="<?php echo base_url("galleries/rankSetter")?>">
                        <?php foreach ($items as $item): ?>
                            <tr id="ord-<?=$item->id?>">
                                <?php if(permission("galleries", "edit")): ?>
                                <td class="text-center sortableItem"><i class="fa fa-bars"></i></td>
                                <?php endif; ?>
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <td class="text-center"><?=$item->url?></td>
                                <td class="text-center"><?=$item->title?></td>
                                <td class="text-center"><?php if($item->gallery_type == "image"){ echo "Resim"; }elseif($item->gallery_type == "file"){echo "Dosya"; }else{ echo "Video"; }?></td>
                                <td class="text-center"><?=$item->folder_name?></td>
                                <td class="text-center"><?=timeConvert($item->createdAt)?></td>
                                <?php if(permission("galleries", "edit")): ?>
                                <td class="text-center">
                                    <input class="isActive" data-url="<?php echo base_url("galleries/isActiveSetter/$item->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <?php if($item->gallery_type == "video"): ?>
                                    <a href="<?php echo base_url("galleries/videos/$item->id")?>" class="btn btn-success btn-sm ">
                                    <?php else: ?>
                                    <a href="<?php echo base_url("galleries/imageForm/$item->id")?>" class="btn btn-success btn-sm ">
                                    <?php endif; ?>
                                        <?php if($item->gallery_type == "image"): ?>
                                            <i class="fa fa-image"></i>
                                        <?php elseif($item->gallery_type == "video"): ?>
                                            <i class="fa fa-video"></i>
                                        <?php else: ?>
                                            <i class="fa fa-file"></i>
                                        <?php endif; ?>
                                    Galeriye gözat</a>
                                        <?php if(permission("galleries", "edit")): ?>
                                    <a href="<?php echo base_url("galleries/updateForm/$item->id")?>" class="btn btn-primary btn-sm "><i class="fa fa-edit"></i> Düzenle</a>
                                        <?php endif; ?>
                                        <?php if(permission("galleries", "delete")): ?>
                                    <button data-url="<?php echo base_url("galleries/deleteItem/$item->id")?>" class="btn btn-danger btn-sm remove-btn"><i class="fa fa-trash"></i> Sil</button>
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
