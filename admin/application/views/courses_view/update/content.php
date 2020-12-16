<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Etkinlik Düzenle <small>(<?=$item->title?>)</small>
            <a href="<?=base_url('courses')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div><!-- END column -->
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <div class="m-b-lg nav-tabs-horizontal">
                    <!-- tabs list -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#general" aria-controls="tab-3" role="tab" data-toggle="tab">Genel</a></li>
                        <li role="presentation"><a href="#seo" aria-controls="tab-1" role="tab" data-toggle="tab">Seo</a></li>
                    </ul><!-- .nav-tabs -->
                <form action="<?php echo base_url("courses/updateItem/$item->id"); ?>" method="post" enctype="multipart/form-data">
                    <div class="tab-content p-md">
                        <div role="tabpanel" class="tab-pane in active fade" id="general">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Başlık" name="title" value="<?php echo $item->title; ?>">
                        <?php if(isset($form_error)){ ?>
                            <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                        <?php } ?>
                    </div>
                        <div class="form-group imageContainer">
                            <img width="200" src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?>" alt="" class="img-responsive" style="margin-bottom: 24px;">
                            <label>Görsel Seçiniz</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" id="datepicker">
                                        <label>Tarih</label>
                                        <input class="form-control datepicker" data-provide="datepicker" name="eventDate" data-date-format="dd/mm/yyyy" value="<?php echo $item->eventDate; ?>">
                                        <?php if(isset($formError)): ?>
                                            <span id="helpBlock" class="help-block text-danger"><?=form_error('eventDate')?></span>
                                        <?php endif; ?>
                                    </div><!-- .form-group -->
                                </div>
                                <div class="col-md-6">
                                    <label>Saat</label>
                                    <input id="timepicker2" type="text" class="form-control input-small" data-plugin="timepicker" name="eventTime" data-options="{ showInputs: false, showMeridian: false }" value="<?php echo $item->eventTime; ?>">
                                    <?php if(isset($formError)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('eventTime')?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" placeholder="Link" name="link" value="<?php echo $item->link; ?>">
                                <?php if(isset($form_error)){ ?>
                                    <span id="helpBlock" class="help-block text-danger"><?=form_error('link')?></span>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label>Yer / Mekan</label>
                                <input class="form-control" placeholder="Yer / Mekan adı giriniz" name="location" value="<?php echo $item->location; ?>">
                                <?php if(isset($form_error)){ ?>
                                    <span id="helpBlock" class="help-block text-danger"><?=form_error('location')?></span>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label>Açıklama</label>
                                <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo $item->description; ?></textarea>
                                <?php if(isset($form_error)){ ?>
                                    <span id="helpBlock" class="help-block text-danger"><?=form_error('description')?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="seo">
                            <div class="form-group">
                                <label>SEO URL</label>
                                <input type="text" class="form-control" name="url" placeholder="Url giriniz" value="<?php echo $item->url; ?>">
                            </div>
                            <div class="form-group">
                                <label>SEO Title</label>
                                <input type="text" class="form-control" name="seo[title]" placeholder="Başlık giriniz" value="<?php echo $seo['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label>SEO Description</label>
                                <input type="text" class="form-control" name="seo[description]" placeholder="Açıklama giriniz" value="<?php echo $seo['description']; ?>">
                            </div>
                            <div class="form-group">
                                <label>SEO Keywords</label>
                                <input type="text" data-role="tagsinput" data-plugin="tagsinput" class="form-control" name="seo[keywords]" placeholder="Keyword giriniz" value="<?php echo $seo['keywords']; ?>">
                            </div>
                        </div><!-- .tab-pane  -->
                        <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Güncelle</button>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>