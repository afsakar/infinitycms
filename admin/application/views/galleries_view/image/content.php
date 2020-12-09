<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            <?=$item->title?> Galerisi
            <a href="<?=base_url('galleries')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <?php if($item->gallery_type != "video"): ?>
                    <form data-url="<?=base_url("galleries/refreshImageList/$item->id/$item->gallery_type")?>" action="<?=base_url("galleries/imageUpload/$item->id")?>" id="dropzone" class="dropzone" data-plugin="dropzone" data-options="{ url: '<?=base_url("galleries/imageUpload/$item->id")?>'}">
                        <div class="dz-message">
                            <h3 class="m-h-lg">Dosya yüklemek için sürükleyip bırakınız veya tıklayınız.</h3>
                            <p class="m-b-lg text-muted"></p>
                        </div>
                    </form>
                     <?php if($item->gallery_type == "file"): ?>
                        <div style="margin: 10px 0 10px 0;">
                            <small>Kabul edilen dosya türleri: jpg|jpeg|png|pdf|doc|docx|ai|avi|css|dwg|html|js|json|mp3|mp4|ppt|psd|svg|txt|xls|xlsx|xml|zip|rar|tzg|xlsm </small>
                        </div>
                     <?php elseif($item->gallery_type == "image"): ?>
                         <div style="margin: 10px 0 10px 0;">
                             <small>Kabul edilen dosya türleri: jpg|jpeg|png|svg|gif </small>
                         </div>
                     <?php endif; ?>
                <?php else: ?>
                    video
                <?php endif; ?>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            <?php if($item->gallery_type === "file"): ?>
                Dosyalar
            <?php elseif($item->gallery_type === "image"): ?>
                Görseller
            <?php else: ?>
                Videolar
            <?php endif; ?>
        </h4>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body imageListContainer">
                <?php $this->load->view("{$viewFolder}/{$subViewFolder}/render_elements/image_list_view"); ?>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div>