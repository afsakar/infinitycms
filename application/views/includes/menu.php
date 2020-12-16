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
                            <?php $subMenus = $this->data_model->getAll("menu",array("isSubmenu" => $menu->id, "isActive" => 1),"rank ASC"); ?>
                            <li <?php if($subMenus){ echo 'class="cr-dropdown"'; }?> ><!-- TODO active renk düzenlenecek. -->
                                <a href="<?php if($menu->content == ""){ echo base_url("$menu->url"); }else{ echo "pages/$menu->url"; } ?>" <?=$this->uri->segment(1)==$menu->url ? "class='active-menu'" : "" ?>><?=$menu->title?></a>
                                <?php if($subMenus): ?>
                                    <ul>
                                    <?php foreach($subMenus as $subMenu): ?>
                                            <li>
                                                <a href="<?php if($subMenu->content == ""){ echo base_url("$subMenu->url"); }else{ echo base_url("pages/$subMenu->url"); } ?>"><?=$subMenu->title?></a>
                                            </li>
                                    <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
<!--                <a href="#" class="cr-btn cr-btn-sm cr-btn-round">-->
<!--                    <span>Buy now</span>-->
<!--                </a>-->
            </div>
        </div>
    </div>
</div>