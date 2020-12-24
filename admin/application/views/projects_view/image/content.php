<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            <?=$item->title?> proje fotoğrafları
            <a href="<?=base_url('projects')?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i> Geri Dön</a>
        </h4>
        <?=$breadcrumbs?>
    </div>
    <?php if(permission("projects_category", "add")): ?>
    <div class="col-md-10 col-md-offset-1">
        <div class="widget">
            <div class="widget-body">
                <form data-url="<?=base_url("projects/refreshImageList/$item->id")?>" action="<?=base_url("projects/imageUpload/$item->id")?>" id="dropzone" class="dropzone" data-plugin="dropzone" data-options="{ url: '<?=base_url('projects/imageUpload/'.$item->id)?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Fotoğrafları yüklemek için sürükleyip bırakınız veya tıklayınız.</h3>
                        <p class="m-b-lg text-muted"></p>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
    <?php endif; ?>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4 class="m-b-lg">
            Görseller
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