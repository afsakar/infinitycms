<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Menü Listesi
            <?php if(permission("menu", "add")): ?>
            <a href="<?=base_url('menu/addForm')?>" class="btn  btn-primary btn-xs pull-right btn-outline"><i class="fa fa-plus"></i> Yeni Ekle</a>
            <?php endif; ?>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">

            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır. <?php if(permission("menu", "add")): ?>Kayıt eklemek için <a href="<?=base_url('menu/addForm')?>" class="alert-link">buraya</a> tıklayın.<?php endif; ?></p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <?php if(permission("menu", "edit")): ?>
                        <th class="text-center" scope="col"></th>
                        <?php endif; ?>
                        <th class="text-center" scope="col">Başlık</th>
                        <th class="text-center" scope="col">URL</th>
                        <th class="text-center" scope="col">Altmenü mü?</th>
                        <th class="text-center" scope="col">Footer'da gösteriliyor mu?</th>
                        <?php if(permission("menu", "edit")): ?>
                        <th class="text-center" scope="col">Durumu</th>
                        <?php endif; ?>
                        <th class="text-center" scope="col">İşlemler</th>
                        </thead>
                        <tbody class="sortable" data-url="<?php echo base_url("menu/rankSetter")?>">
                        <?php foreach ($items as $item): ?>
                        <?php $subMenus = $this->menu_model->getAll(array("isSubmenu" => $item->id),"rank ASC"); ?>
                            <tr id="ord-<?=$item->id?>">
                                <?php if(permission("menu", "edit")): ?>
                                <td class="text-center sortableItem"><i class="fa fa-bars"></i></td>
                                <?php endif; ?>
                                <td class="text-center"><?=$item->title?></td>
                                <td class="text-center"><?=$item->url?></td>
                                <td class="text-center"><?=$item->isSubmenu ? $item->isSubmenu : "<span style='font-size: 12px;' class='badge badge-primary'>Hayır</span>"?></td>
                                <td class="text-center"><?=$item->isFooter == 1 ? "<span style='font-size: 12px;' class='badge badge-success'>Evet</span>" : "<span style='font-size: 12px;' class='badge badge-primary'>Hayır</span>"?></td>
                                <?php if(permission("menu", "edit")): ?>
                                <td class="text-center">
                                    <input class="isActive" data-url="<?php echo base_url("menu/isActiveSetter/$item->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <?php if(permission("menu", "edit")): ?>
                                    <a href="<?php echo base_url("menu/updateForm/$item->id")?>" class="btn btn-primary btn-sm "><i class="fa fa-edit"></i> Düzenle</a>
                                    <?php endif; ?>
                                    <?php if(permission("menu", "delete")): ?>
                                    <button data-url="<?php echo base_url("menu/deleteItem/$item->id")?>" class="btn btn-danger btn-sm  remove-btn"><i class="fa fa-trash"></i> Sil</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php foreach($subMenus as $subMenu): ?>
                            <tr id="ord-<?=$subMenu->id?>" style="background-color: #f2f3f4;">
                                <?php if(permission("menu", "edit")): ?>
                                <td class="text-center sortableItem"><i class="fa fa-bars"></i></td>
                                <?php endif; ?>
                                <td class="text-center"><?=$subMenu->title?></td>
                                <td class="text-center"><?=$subMenu->url?></td>
                                <td class="text-center"><span class="badge badge-danger" style="font-size: 12px"><?=$item->title?></span></td>
                                <td class="text-center"><?=$subMenu->isFooter == 1 ? "<span style='font-size: 12px;' class='badge badge-success'>Evet</span>" : "<span style='font-size: 12px;' class='badge badge-primary'>Hayır</span>"?></td>
                                <?php if(permission("menu", "edit")): ?>
                                <td class="text-center">
                                    <input class="isActive" data-url="<?php echo base_url("menu/isActiveSetter/$subMenu->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$subMenu->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <?php if(permission("menu", "edit")): ?>
                                    <a href="<?php echo base_url("menu/updateForm/$subMenu->id")?>" class="btn btn-primary btn-sm "><i class="fa fa-edit"></i> Düzenle</a>
                                    <?php endif; ?>
                                    <?php if(permission("menu", "delete")): ?>
                                    <button data-url="<?php echo base_url("menu/deleteItem/$subMenu->id")?>" class="btn btn-danger btn-sm  remove-btn"><i class="fa fa-trash"></i> Sil</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?=$links?>
                </div>

            <?php endif; ?>
        </div><!-- .widget -->
    </div>
</div>
