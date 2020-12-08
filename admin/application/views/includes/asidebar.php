<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="javascript:void(0)"><img class="img-responsive" src="<?=base_url('sources')?>/assets/images/221.jpg" alt="avatar"/></a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="javascript:void(0)" class="username">John Doe</a></h5>
                    <ul>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small>Web Developer</small>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="/index.html">
                                        <span class="m-r-xs"><i class="fa fa-home"></i></span>
                                        <span>Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="profile.html">
                                        <span class="m-r-xs"><i class="fa fa-user"></i></span>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="settings.html">
                                        <span class="m-r-xs"><i class="fa fa-gear"></i></span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="text-color" href="logout.html">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span>Home</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">

                <li>
                    <a href="<?=base_url()?>">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url()?>">
                        <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
                        <span class="menu-text">Ayarlar</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url()?>">
                        <i class="menu-icon zmdi zmdi-accounts zmdi-hc-lg"></i>
                        <span class="menu-text">Kullanıcılar</span>
                    </a>
                </li>
                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon zmdi zmdi-collection-folder-image zmdi-hc-lg"></i>
                        <span class="menu-text">Galeri</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="#">
                                <span class="menu-text">Resim Galerisi</span>
                                <span class="label label-primary menu-label">12</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-text">Video Galerisi</span>
                                <span class="label label-primary menu-label">12</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-text">Dosya Galerisi</span>
                                <span class="label label-primary menu-label">12</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?=base_url()?>">
                        <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
                        <span class="menu-text">Slider</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url('projects')?>">
                        <i class="menu-icon fa fa-rocket zmdi-hc-lg"></i>
                        <span class="menu-text">Projeler</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url('news')?>">
                        <i class="menu-icon fa fa-newspaper zmdi-hc-lg"></i>
                        <span class="menu-text">Haberler</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url()?>">
                        <i class="menu-icon fa fa-calendar zmdi-hc-lg"></i>
                        <span class="menu-text">Eğitimler</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url('references')?>">
                        <i class="menu-icon zmdi zmdi-check zmdi-hc-lg"></i>
                        <span class="menu-text">Referanslar</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url()?>">
                        <i class="menu-icon zmdi zmdi-widgets zmdi-hc-lg"></i>
                        <span class="menu-text">Popuplar</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url()?>">
                        <i class="menu-icon zmdi zmdi-present-to-all zmdi-hc-lg"></i>
                        <span class="menu-text">Markalar</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url()?>">
                        <i class="menu-icon zmdi zmdi-account-box-mail zmdi-hc-lg"></i>
                        <span class="menu-text">Aboneler</span>
                    </a>
                </li>
                <li class="menu-seperator"><hr></li>
                <li>
                    <a href="<?=base_url()?>">
                        <i class="menu-icon zmdi zmdi-view-web zmdi-hc-lg"></i>
                        <span class="menu-text">Anasayfa</span>
                    </a>
                </li>

            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>