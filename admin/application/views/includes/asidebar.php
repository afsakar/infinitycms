<?php $user = get_active_user()?>
<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="javascript:void(0)"><img class="img-responsive" src="<?=base_url("uploads/users_view/$user->img_url")?>" alt="avatar"/></a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="javascript:void(0)" class="username"><?=$user->user_name?></a></h5>
                    <ul>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small><?=$user->user_type?></small>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="<?=base_url()?>">
                                        <span class="m-r-xs"><i class="fa fa-home"></i></span>
                                        <span>Anasayfa</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="<?=base_url("users/updateForm/$user->id")?>">
                                        <span class="m-r-xs"><i class="fa fa-user"></i></span>
                                        <span>Profil</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="<?=base_url("settings")?>">
                                        <span class="m-r-xs"><i class="fa fa-cog"></i></span>
                                        <span>Ayarlar</span>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="text-color" href="<?=base_url("logout")?>">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span>Çıkış Yap</span>
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
                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
                        <span class="menu-text">Ayarlar</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="<?=base_url()?>">
                                <span class="menu-text">Genel Ayarlar</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?=base_url('email_settings')?>">
                                <span class="menu-text">Email Listesi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?=base_url('users')?>">
                        <i class="menu-icon zmdi zmdi-accounts zmdi-hc-lg"></i>
                        <span class="menu-text">Kullanıcılar</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url('galleries')?>">
                        <i class="menu-icon zmdi zmdi-collection-folder-image zmdi-hc-lg"></i>
                        <span class="menu-text">Galeriler</span>
                    </a>
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
                    <a href="<?=base_url('courses')?>">
                        <i class="menu-icon fa fa-calendar zmdi-hc-lg"></i>
                        <span class="menu-text">Etkinlikler</span>
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
                    <a href="<?=base_url('brands')?>">
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