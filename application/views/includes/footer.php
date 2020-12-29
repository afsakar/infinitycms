<!-- Footer Area -->
<footer id="footer" class="footer-area">

    <!-- Footer Top Area -->
    <div class="footer-top-area bg-dark-light section-padding-sm">
        <div class="container">
            <div class="footer-widgets widgets">
                <div class="row">

                    <div class="col-lg-5 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-widget footer-widget-about">
                            <a href="<?=base_url()?>">
                                <img src="<?=logo("logo")?>" alt="<?=settings("title")?>" width="200">
                            </a>
                            <p>
                                Yeniliklerden haberdar olmak için bültenimize kaydolun!
                            </p>
                        </div>
                        <!--// Single Widget -->

                        <!-- Single Widget -->
                        <div class="single-widget widget-newsletter">
                            <form action="<?=base_url("member")?>" method="post" class="newsletter-widget-form">
                                <input type="email" name="email" placeholder="Email adresiniz" required>
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>">
                                <button type="submit" class="cr-btn cr-btn-sm">
                                    <span>Abone Ol</span>
                                </button>
                            </form>
                        </div>
                        <!--// Single Widget -->
                    </div>

                    <?php if($footerMenu): ?>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-widget widget-quick-links">
                            <h5 class="footer-widget-title">Yararlı Linkler</h5>
                            <ul>
                                <?php foreach ($footerMenu as $menu): ?>
                                <li>
                                    <a href="<?php if($menu->content != ""){ echo base_url("pages/$menu->url"); }else{ echo base_url("$menu->url"); } ?>"><?=$menu->title?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!--// Single Widget -->
                    </div>
                    <?php endif; ?>

                    <?php if($records): ?>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-widget widget-latest-blog">
                            <h5 class="footer-widget-title">Son Haberler</h5>
                            <ul>
                                <?php foreach ($records as $record): ?>
                                    <li>
                                        <div class="widget-latest-blog-content">
                                            <h6>
                                                <a href="<?=base_url("news/$record->url")?>"><?=$record->title?></a>
                                            </h6>
                                            <div class="widget-latest-blog-meta">
                                                <span><?=timeConvert($record->createdAt)?></span>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!--// Single Widget -->
                    </div>
                    <?php endif; ?>

                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-widget widget-quick-contact">
                            <h5 class="footer-widget-title">İletişim Bilgileri</h5>
                            <ul>
                                <li>
                                    <span>Telefon</span>
                                    <p>
                                        <a href="tel:<?=settings("phone")?>"><?=settings("phone")?></a>
                                    </p>
                                </li>
                                <li>
                                    <span>Email</span>
                                    <p>
                                        <a href="#"><?=settings("email")?></a>
                                    </p>
                                </li>
                                <li>
                                    <span>Adres</span>
                                    <p><?=settings("address")?></p>
                                </li>
                            </ul>
                        </div>
                        <!--// Single Widget -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--// Footer Top Area -->

    <!-- Footer Bottom Area -->
    <div class="footer-bottom-area bg-dark">
        <div class="container">
            <div class="row">
                <?=copyright()?>
            </div>
        </div>
    </div>
    <!--// Footer Bottom Area -->

</footer>
<!-- //Footer Area -->