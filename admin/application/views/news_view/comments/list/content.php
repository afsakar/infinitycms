<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yorumlar
            <a href="<?=base_url('news')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget p-lg">

            <?php if(empty($items)): ?>
            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır.</p>
            </div>
            <?php else: ?>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-striped table-container table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <th class="text-center" scope="col">#ID</th>
                        <th class="text-center" scope="col">Yorum Sahibi</th>
                        <th class="text-center" scope="col">Haber</th>
                        <th class="text-center" scope="col">Oluşturma Tarihi</th>
                        <?php if(permission("comments", "edit")): ?>
                        <th class="text-center" scope="col">Durumu</th>
                        <?php endif; ?>
                        <th class="text-center" scope="col">İşlemler</th>
                        </thead>
                        <tbody data-url="<?php echo base_url("news/commentrankSetter")?>">
                        <?php foreach ($items as $item): ?>
                        <?php $news = $this->news_model->get(array("id" => $item->news_id));?>
                            <tr id="ord-<?=$item->id?>">
                                <th class="text-center" scope="row"><?=$item->id?></th>
                                <td width="250">
                                    <div class="media">
                                        <div class="media-left">
                                            <div class="avatar avatar-md avatar-circle">
                                                <?php $authorInfo = $this->users_model->get(array("email" => $item->email)); ?>
                                                <?php if(!$authorInfo): ?>
                                                    <img src="<?=get_gravatar($item->email)?>" alt="">
                                                <?php else: ?>
                                                    <img src="<?=base_url("uploads/users_view/$authorInfo->img_url")?>" alt="">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading"><b><?=$item->name?></b></h5>
                                            <small class="media-meta"><?=$item->email?></small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"><?=$news->title?></td>
                                <td class="text-center"><?=timeConvert($item->createdAt)?></td>
                                <?php if(permission("comments", "edit")): ?>
                                <td class="text-center">
                                    <input class="isActive" data-url="<?php echo base_url("news/commentActiveSetter/$item->id")?>" type="checkbox" data-switchery data-color="#10c469" <?=$item->isActive == 1 ? 'checked' : null?>/>
                                </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <?php if(permission("comments", "edit")): ?>
                                        <a href="<?php echo base_url("news/commentForm/$item->id")?>" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <?php endif; ?>
                                    <?php if(permission("comments", "delete")): ?>
                                        <button data-url="<?php echo base_url("news/deleteComment/$item->id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
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
