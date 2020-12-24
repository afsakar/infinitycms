<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Proje Listesi
            <?php if(permission("projects", "add")): ?>
            <a href="<?=base_url('projects/addForm')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
            <?php endif; ?>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">

            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır. <?php if(permission("projects", "add")): ?>Kayıt eklemek için <a href="<?=base_url('projects/addForm')?>" class="alert-link">buraya</a> tıklayın.<?php endif; ?></p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-striped table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <?php if(permission("projects", "edit")): ?>
                        <th class="text-center" scope="col"></th>
                        <?php endif; ?>
                        <th class="text-center" scope="col">#ID</th>
                        <th scope="col">Url</th>
                        <th scope="col">Başlık</th>
                        <th scope="col">Kategori Adı</th>
                        <th scope="col">Proje Tarihi</th>
                        <?php if(permission("projects", "edit")): ?>
                        <th scope="col">Durumu</th>
                        <?php endif; ?>
                        <th scope="col">İşlemler</th>
                        </thead>
                        <tbody class="sortable" data-url="<?php echo base_url("projects/rankSetter")?>">
                        <?php foreach ($items as $item): ?>
                            <?php $category = $this->projects_category_model->get(array("id" => $item->category_id)); ?>
                            <tr id="ord-<?=$item->id?>">
                                <?php if(permission("projects", "edit")): ?>
                                <td class="text-center sortableItem"><i class="fa fa-bars"></i></td>
                                <?php endif; ?>
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <td><?=$item->url?></td>
                                <td><?=$item->title?></td>
                                <td><?=$category->category_name?></td>
                                <td><?=$item->projectDate?></td>
                                <?php if(permission("projects", "edit")): ?>
                                <td>
                                    <input class="isActive" data-url="<?php echo base_url("projects/isActiveSetter/$item->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <?php endif; ?>
                                <td>
                                    <a href="<?php echo base_url("projects/imageForm/$item->id")?>" class="btn btn-warning btn-sm btn-outline"><i class="fa fa-image"></i> Resimler</a>
                                    <?php if(permission("projects", "edit")): ?>
                                    <a href="<?php echo base_url("projects/updateForm/$item->id")?>" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <?php endif; ?>
                                    <?php if(permission("projects", "delete")): ?>
                                    <button data-url="<?php echo base_url("projects/deleteItem/$item->id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
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
