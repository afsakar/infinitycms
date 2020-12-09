<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Yeni Galeri Ekle
            <a href="<?=base_url('galleries')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
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
                        <li role="presentation"><a href="#seo" aria-controls="tab-1" role="tab" data-toggle="tab">Seo</a></li>
                    </ul><!-- .nav-tabs -->

                    <!-- Tab panes -->
                    <form method="post" action="<?=base_url('galleries/addItem')?>">
                        <div class="tab-content p-md">

                            <div role="tabpanel" class="tab-pane in active fade" id="general">
                                <div class="form-group">
                                    <label>Galeri Adı<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" placeholder="Galeri Adını Giriniz" value="<?php if (isset($form_error)){ echo set_value('title'); } ?>">
                                    <?php if(isset($form_error)): ?>
                                        <span id="helpBlock" class="help-block text-danger"><?=form_error('title')?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Galeri Türü<span class="text-danger">*</span></label>
                                    <select id="select2-demo-1" name="gallery_type" class="form-control" data-plugin="select2">
                                        <option <?=isset($form_error) && $this->input->post('gallery_type') == "image" ? "selected" : ""?> value="image">Resim</option>
                                        <option <?=isset($form_error) && $this->input->post('gallery_type') == "video" ? "selected" : ""?> value="video">Video</option>
                                        <option <?=isset($form_error) && $this->input->post('gallery_type') == "file" ? "selected" : ""?> value="file">Dosya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Klasör Adı</label>
                                    <input type="text" class="form-control" name="folder_name" placeholder="Galeri Adını Giriniz" value="<?php if (isset($form_error)){ echo set_value('folder_name'); } ?>">
                                    <small>Klasör adı girmezseniz otomatik olarak galeri adını alacaktır.</small>
                                </div>
                            </div><!-- .tab-pane  -->

                            <div role="tabpanel" class="tab-pane fade" id="seo">
                                <div class="form-group">
                                    <label>SEO URL</label>
                                    <input type="text" class="form-control" name="url" placeholder="Url giriniz" value="<?php if (isset($form_error)){ echo set_value('url'); } ?>">
                                </div>
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" class="form-control" name="seo[title]" placeholder="Başlık giriniz" value="<?php if (isset($form_error)){ echo set_value('seo[title]'); } ?>">
                                </div>
                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <input type="text" class="form-control" name="seo[description]" placeholder="Açıklama giriniz" value="<?php if (isset($form_error)){ echo set_value('seo[description]'); } ?>">
                                </div>
                                <div class="form-group">
                                    <label>SEO Keywords</label>
                                    <input type="text" data-role="tagsinput" data-plugin="tagsinput" class="form-control" name="seo[keywords]" placeholder="Keyword giriniz" value="<?php if (isset($form_error)){ echo set_value('seo[keywords]'); } ?>">
                                </div>
                            </div><!-- .tab-pane  -->
                            <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Kaydet</button>
                        </div><!-- .tab-content  -->
                    </form>
                </div><!-- .nav-tabs-horizontal -->
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>