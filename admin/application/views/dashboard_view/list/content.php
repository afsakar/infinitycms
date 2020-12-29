<div class="wrap">
    <section class="app-content">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="widget p-md clearfix">
                    <div class="pull-left">
                        <h3 class="widget-title">Hoşgeldiniz, <?=$user->full_name?> <small>(<?=$user->user_name?>)</small></h3>
                        <small class="text-color">Toplam kullanıcı sayısı</small>
                    </div>
                    <span class="pull-right fz-lg fw-500 counter" data-plugin="counterUp"><?=countData("users", array())?></span>
                </div><!-- .widget -->
            </div>
        </div><!-- .row -->

        <div class="row">
            <div class="col-md-5">
                <div class="widget todo-widget todoListContainer">
                    <header class="widget-header">
                        <h4 class="widget-title">Görev Listesi</h4><small>(Tamamlanan kayıtlar 5'gün sonra otomatik olarak silinir.)</small>
                    </header>
                    <hr class="widget-separator"/>
                    <?php $this->load->view("$viewFolder/$subViewFolder/todo_list"); ?>
                    <form action="<?=base_url("dashboard/addTodo")?>" method="post">
                        <div class="new-todo">
                            <input type="text" name="title" placeholder="Yeni görev ekle" required>
                        </div>
                        <footer class="widget-footer">
                            <button class="btn btn-sm btn-success m-r-md"><i class="fa fa-plus"></i> Ekle</button>
                        </footer>
                    </form>
                </div><!-- .widget -->
            </div>
            <div class="col-md-7">
                <a href="<?=base_url("contact")?>">
                    <div class="col-md-3 col-sm-6">
                    <div class="widget stats-widget">
                        <div class="widget-body clearfix">
                            <div class="pull-left">
                                <h3 class="widget-title text-primary"><span class="counter" data-plugin="counterUp"><?=countData("contact", array("isRead" => 0))?></span> Adet</h3>
                                <small class="text-color">Okunmamış Mesaj</small>
                            </div>
                            <span class="pull-right big-icon watermark"><i class="zmdi zmdi-email"></i></span>
                        </div>
                        <footer class="widget-footer bg-primary">
                        </footer>
                    </div><!-- .widget -->
                </div>
                </a>
                <a href="<?=base_url("galleries")?>">
                    <div class="col-md-3 col-sm-6">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-deepOrange"><span class="counter" data-plugin="counterUp"><?=countData("galleries", array("isActive" => 1))?></span> Adet</h3>
                                    <small class="text-color">Galeri Yayında</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="zmdi zmdi-collection-folder-image"></i></span>
                            </div>
                            <footer class="widget-footer bg-deepOrange">
                            </footer>
                        </div><!-- .widget -->
                    </div>
                </a>
                <a href="<?=base_url("sliders")?>">
                    <div class="col-md-3 col-sm-6">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-success"><span class="counter" data-plugin="counterUp"><?=countData("sliders", array("isActive" => 1))?></span> Adet</h3>
                                    <small class="text-color">Slider Görseli Yayında</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="zmdi zmdi-layers"></i></span>
                            </div>
                            <footer class="widget-footer bg-success">
                            </footer>
                        </div><!-- .widget -->
                    </div>
                </a>
                <a href="<?=base_url("projects")?>">
                    <div class="col-md-3 col-sm-6">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-purple"><span class="counter" data-plugin="counterUp"><?=countData("projects", array("isActive" => 1))?></span> Adet</h3>
                                    <small class="text-color">Proje Yayında</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="fa fa-rocket"></i></span>
                            </div>
                            <footer class="widget-footer bg-purple">
                            </footer>
                        </div><!-- .widget -->
                    </div>
                </a>
                <a href="<?=base_url("news")?>">
                    <div class="col-md-3 col-sm-6">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-dark"><span class="counter" data-plugin="counterUp"><?=countData("news", array("isActive" => 1))?></span> Adet</h3>
                                    <small class="text-color">Haber Yayında</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="fa fa-newspaper"></i></span>
                            </div>
                            <footer class="widget-footer bg-dark">
                            </footer>
                        </div><!-- .widget -->
                    </div>
                </a>
                <a href="<?=base_url("courses")?>">
                    <div class="col-md-3 col-sm-6">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-danger"><span class="counter" data-plugin="counterUp"><?=countData("courses", array("isActive" => 1))?></span> Adet</h3>
                                    <small class="text-color">Etkinlik Yayında</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="fa fa-calendar"></i></span>
                            </div>
                            <footer class="widget-footer bg-danger">
                            </footer>
                        </div><!-- .widget -->
                    </div>
                </a>
                <a href="<?=base_url("references")?>">
                    <div class="col-md-3 col-sm-6">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-warning"><span class="counter" data-plugin="counterUp"><?=countData("references", array("isActive" => 1))?></span> Adet</h3>
                                    <small class="text-color">Referans Yayında</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="zmdi zmdi-check"></i></span>
                            </div>
                            <footer class="widget-footer bg-warning">
                            </footer>
                        </div><!-- .widget -->
                    </div>
                </a>
                <a href="<?=base_url("members")?>">
                    <div class="col-md-3 col-sm-6">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-pink"><span class="counter" data-plugin="counterUp"><?=countData("members", array())?></span> Adet</h3>
                                    <small class="text-color">Abone Kayıtlı</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="zmdi zmdi-account-box-mail"></i></span>
                            </div>
                            <footer class="widget-footer bg-pink">
                            </footer>
                        </div><!-- .widget -->
                    </div>
                </a>
            </div>
        </div><!-- .row -->
    </section><!-- #dash-content -->
</div><!-- .wrap -->