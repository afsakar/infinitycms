<!-- Header -->
<header class="header header-style-1 megamenu-container bg-white fixed-header sticky-header">

    <?php $this->load->view('includes/menu'); ?>

    <!-- Mobile Menu -->
    <div class="mobile-menu-wrapper">
        <div class="container d-block d-lg-none">
            <div class="mobile-menu clearfix">
                <a class="mobile-logo" href="<?=base_url()?>">
                <!--TODO Mobile Logo ekle-->
                    <img src="<?=logo("logo")?>" class="img-responsive" alt="<?=settings("title")?>" width="180">
                </a>
<!--                <a href="#" class="cr-btn cr-btn-sm cr-btn-round">-->
<!--                    <span>Buy now</span>-->
<!--                </a>-->
            </div>
        </div>
    </div>
    <!-- //Mobile Menu -->

</header>
<!-- //Header -->