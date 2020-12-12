<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Proje Kategori Listesi
            <a href="<?=base_url('projects/categoryForm')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">

            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır. Kayıt eklemek için <a href="<?=base_url('projects/categoryForm')?>" class="alert-link">buraya</a> tıklayın.</p>
            </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" data-plugin="DataTable" class="table table-striped table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <th class="text-center" scope="col">#ID</th>
                        <th class="text-center" scope="col">Kategori Adı</th>
                        <th class="text-center" scope="col">Oluşturma Tarihi</th>
                        <th class="text-center" scope="col">Durumu</th>
                        <th class="text-center" scope="col">İşlemler</th>
                        </thead>
                        <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <td class="text-center"><?=$item->category_name?></td>
                                <td class="text-center"><?=timeConvert($item->createdAt)?></td>
                                <td class="text-center">
                                    <input class="isActive" data-url="<?php echo base_url("projects/isActiveCategory/$item->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo base_url("projects/categoryUpdate/$item->id")?>" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <button data-url="<?php echo base_url("projects/categoryDelete/$item->id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
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
