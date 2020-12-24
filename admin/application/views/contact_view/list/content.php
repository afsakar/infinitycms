<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            İletişim Mesajları
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
            <?php if(empty($items)): ?>

            <div class="alert alert-info text-center">
                <p>Burada herhangi bir kayıt bulunmamaktadır.</p>
            </div>

            <?php else: ?>


                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table mail-list table-container">
                            <tr>
                                <td>
                                    <?php foreach ($items as $item): ?>
                                    <?php $user = $this->users_model->get(array("id" => $item->readUser));?>
                                    <!-- a single mail -->
                                    <div class="mail-item">
                                        <table class="mail-container">
                                            <tr>
                                                <td class="mail-left">
                                                    <div class="avatar avatar-lg avatar-circle">
                                                        <a href="#"><img src="<?=get_gravatar("$item->email")?>" alt="<?=$item->name?>"></a>
                                                    </div>
                                                </td>
                                                <td class="mail-center">
                                                    <div class="mail-item-header">
                                                        <h4 class="mail-item-title"><a href="<?php echo base_url("contact/readForm/$item->id")?>" class="title-color"><?=$item->name?></a></h4>
                                                        (<?=$item->email?>)
                                                        (Konu: <?=$item->subject?>)
                                                    </div>
                                                    <p class="mail-item-excerpt"><?=character_limiter($item->message,200)?></p>
                                                </td>
                                                <td class="mail-right">
                                                    <p class="mail-item-date"><?=timeConvert($item->createdAt)?></p>
                                                    <p class="text-center text-muted">
                                                        <?php if($item->isRead == 1): ?>
                                                        <?=$user->user_name?><br>
                                                        <?=timeConvert($item->readDate)?> okudu
                                                        <?php endif; ?>
                                                    </p>
                                                </td>
                                                <td class="mail-right">
                                                    <p class="mail-item-date text-center">
                                                        <button data-url="<?php echo base_url("contact/deleteItem/$item->id")?>" class="btn btn-danger btn-sm btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</button>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!-- END mail-item -->
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        </table>
                        <?=$links?>
                    </div>
                </div><!-- END column -->
            <?php endif; ?>
    </div>
</div>