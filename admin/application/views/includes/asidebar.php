<?php $user = get_active_user()?>
<?php require "menu.php"; ?>
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
                                <li class="logout">
                                    <button data-url="<?=base_url('logout')?>" style="text-decoration: none;" class="btn btn-link logout-btn btn-default">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span>Çıkış Yap</span>
                                    </button>
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
                <?php foreach ($menus as $mainUrl => $menu): if(!permission($menu['url'], 'show', false)) continue;?>
                <li class="<?=(isset($menu["submenu"]) ? "has-submenu" : base_url($menu["url"]))?> <?=($this->uri->segment(1)===$menu["url"])?'active':''?>">
                    <a href="<?=(isset($menu["submenu"]) ? "javascript:void(0)" : base_url($menu["url"]))?>" <?=(isset($menu["submenu"]) ? "class='submenu-toggle'" : null)?>>
                        <i class="menu-icon <?=$menu["icon"]?> zmdi-hc-lg"></i>
                        <span class="menu-text"><?=$menu["title"]?></span>
                        <?php if(isset($menu["submenu"])): ?>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        <?php endif; ?>
                    </a>
                    <?php if(isset($menu["submenu"])): ?>
                    <ul class="submenu" <?=($this->uri->segment(1)===$menu["url"])?'style="display: block"':''?>>
                        <?php foreach ($menu['submenu'] as $k => $submenu): if(!permission($submenu['url'], 'show', false)) continue;?>
                            <li class="<?=($this->uri->segment(1)===$submenu['url'])?'active':''?>">
                                <a href="<?=base_url($submenu['url'])?>">
                                    <span class="menu-text"><?=$submenu['title']?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
                <li class="menu-seperator"><hr></li>
                <li>
                    <a href="/">
                        <i class="menu-icon zmdi zmdi-view-web zmdi-hc-lg"></i>
                        <span class="menu-text">Anasayfa</span>
                    </a>
                </li>

            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>