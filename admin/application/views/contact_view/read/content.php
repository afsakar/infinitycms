<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            <?=$item->name?> <small>(<?=$item->email?>)</small>
            <a href="<?=base_url('contact')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="mail-view">
            <h4 class="m-0">Konu: <?=$item->subject?></h4>
            <div class="divid"></div>
            <div class="media">
                <div class="media-left">
                    <div class="avatar avatar-lg avatar-circle">
                        <img class="img-responsive" src="<?=get_gravatar($item->email)?>" alt="avatar"/>
                    </div><!-- .avatar -->
                </div>

                <div class="media-body">
                    <div class="m-b-sm">
                        <h4 class="m-0 inline-block m-r-lg">
                            <a href="#" class="title-color"><?=$item->name?></a> (<?=timeConvert($item->createdAt)?>)
                        </h4>
                    </div>
                    <p><b>Email: </b><?=$item->email?></p>
                </div>
            </div>
            <div class="divid"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="m-h-lg lh-xl">
                        <p><?=$item->message?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <form action="<?=base_url("contact/reply/$item->id")?>" method="post">
                <div class="col-md-12">
                    <h4>Yanıtla</h4>
                    <div class="divid"></div>
                    <div class="panel panel-default new-message">
                        <div class="panel-heading">
                            <input type="text" value="<?=$item->email?>" name="to">
                            <input type="hidden" value="<?=$item->subject?>" name="subject">
                        </div>
                        <div class="panel-body p-0">
                            <div style="padding: 20px;">
                                <textarea class="m-0" data-plugin="summernote" name="replyMessage" data-options="{height: 200}"><?php if (isset($form_error)){ echo set_value('replyMessage'); } ?></textarea>
                                <?php if(isset($form_error)): ?>
                                    <span id="helpBlock" class="help-block text-danger"><?=form_error('replyMessage')?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary btn-md"><i class="zmdi zmdi-mail-reply"></i> Yanıtla</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>