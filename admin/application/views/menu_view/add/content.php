<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yeni Menü Ekle
            <a href="<?=base_url('menu')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <div class="m-b-lg nav-tabs-horizontal">
                    <!-- tabs list -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#general" aria-controls="tab-3" role="tab" data-toggle="tab">Genel</a></li>
                        <li role="presentation"><a href="#icerik" aria-controls="tab-2" role="tab" data-toggle="tab">İçerik</a></li>
                        <li role="presentation"><a href="#seo" aria-controls="tab-1" role="tab" data-toggle="tab">Seo</a></li>
                    </ul><!-- .nav-tabs -->
                    <form method="post" action="<?=base_url('menu/addItem')?>" enctype="multipart/form-data">
                        <div class="tab-content p-md">
                            <div role="tabpanel" class="tab-pane in active fade" id="general">
                                <div class="form-group">
                                    <label>Başlık<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" placeholder="Başlık Giriniz" value="<?php if (isset($formError)){ echo set_value('title'); } ?>">
                                    <?php if(isset($formError)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Altmenü mü?<span class="text-danger">*</span></label>
                                    <select id="select2-demo-1" name="isSubmenu" class="form-control" data-plugin="select2">
                                        <option <?php if(isset($formError) && set_value('isSubmenu') == 0){echo "selected"; }else{ echo ""; } ?> value="0">Hayır</option>
                                        <?php foreach($items as $item): ?>
                                            <option <?php if(isset($formError) && set_value('isSubmenu') == $item->id){echo "selected"; }else{ echo ""; } ?> value="<?=$item->id?>"><?=$item->title?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if(isset($formError)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>URL<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="url" placeholder="URL Giriniz" value="<?php if (isset($formError)){ echo set_value('url'); } ?>">
                                    <small>Boş bırakırsanız Başlık'tan alacaktır.</small>
                                    <?php if(isset($formError)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('url')?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane in fade" id="icerik">
                                <div class="form-group imageContainer">
                                    <label>Görsel</label>
                                    <input type="file" class="form-control" name="img_url">
                                </div><!-- .form-group -->
                                <div class="form-group">
                                    <label>İçerik<span class="text-danger">*</span></label>
                                    <small>(Eğer İçerik eklerseniz sayfada doğrudan eklediğiniz içerik görünecektir.)</small>
                                    <textarea class="m-0" data-plugin="summernote" name="content" data-options="{height: 250}"><?php if (isset($form_error)){ echo set_value('content'); } ?></textarea>
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('content')?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane in fade" id="seo">
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" class="form-control" name="seo[title]" placeholder="Başlık giriniz" value="<?php if (isset($form_error)){ echo set_value('seo[title]'); } ?>">
                                </div>
                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <textarea ame="seo[description]" class="form-control" cols="30" rows="5">
                                        <?php if (isset($form_error)){ echo set_value('seo[description]'); } ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>SEO Keywords</label>
                                    <input type="text" data-role="tagsinput" data-plugin="tagsinput" class="form-control" name="seo[keywords]" placeholder="Keyword giriniz" value="<?php if (isset($form_error)){ echo set_value('seo[keywords]'); } ?>">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Kaydet</button>
                    </form>
                </div>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>