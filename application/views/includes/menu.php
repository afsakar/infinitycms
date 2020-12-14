<div class="container d-none d-lg-block">
    <div class="row">
        <div class="col-lg-12">
            <div class="header-inner">
                <div class="logo">
                    <a href="<?=base_url()?>">
                        <img src="<?=logo("logo")?>" class="img-responsive" alt="<?=settings("title")?>" width="180">
                    </a>
                </div>
                <nav class="menu">
                    <ul>
                        <?php foreach ($menus as $menu): ?>
                            <?php $subMenus = $this->data_model->getAll("menu",array("isSubmenu" => $menu->id),"rank ASC"); ?>
                            <li <?php if($subMenus){ echo 'class="cr-dropdown"'; }?> >
                                <a href="<?=base_url("$menu->url")?>"><?=$menu->title?></a>
                                <?php if($subMenus): ?>
                                    <ul>
                                    <?php foreach($subMenus as $subMenu): ?>
                                            <li>
                                                <a href="<?=$subMenu->url?>"><?=$subMenu->title?></a>
                                            </li>
                                    <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
                <a href="#" class="cr-btn cr-btn-sm cr-btn-round">
                    <span>Buy now</span>
                </a>
            </div>
        </div>
    </div>
</div>