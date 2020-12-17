<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <?php $this->load->view('includes/head'); ?>
        <title><?=$title ? $title." | " : ""?><?=settings("title")?></title>
    </head>
<body>

<!-- Add your site or application content here -->

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">

    <?php $this->load->view('includes/header'); ?>

    <!-- Breacrumb Area -->
    <div class="breadcrumb-area cover-image" data-black-overlay="7" style="background: url(<?php if($page->img_url != ""){echo base_url("admin/uploads/menu_view/").$page->img_url;}else{ echo logo("cover"); } ?>) no-repeat scroll center center;">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="cr-breadcrumb text-center">
                        <h1><?=$title?></h1>
                        <p><?=$breadcrumbs?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Breacrumb Area -->

    <!-- Page Content -->
    <main class="page-content">

        <div class="pg-contact-us-area section-padding-lg bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="small-title text-center">
                            <h2>Bizimle ileteişime geçin</h2>
                        </div>
                    </div>
                    <?php if(settings('googlemap_isopen') == 1):?>
                    <div class="col-lg-12">
                        <div class="d-none d-sm-block mb-5 pb-4">
                            <iframe src="<?=settings('map_code')?>" width="1080" height="480" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="row section-padding-top-xs">
                    <div class="col-lg-8">
                        <div class="pg-contact-form mr-0 mr-lg-3">
                            <div class="small-title">
                                <h2>İletişim Formu</h2>
                                <?php if(settings("contact_text") != ""){ ?>
                                    <p><?=htmlspecialchars_decode(settings("contact_text"))?></p>
                                <?php } ?>
                            </div>
                            <form id="contactform" action="<?=base_url("contacts")?>" method="post">
                                <div class="row no-gutters">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-input">
                                            <input type="text" name="name" placeholder="Ad Soyad" value="<?php if (isset($form_error)){ echo set_value('name'); } ?>">
                                            <?php if(isset($form_error)): ?>
                                                <small id="helpBlock" class="text-danger"><?=form_error('name')?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-input">
                                            <input type="email" name="email" placeholder="E-mail" value="<?php if (isset($form_error)){ echo set_value('email'); } ?>">
                                            <?php if(isset($form_error)): ?>
                                                <small id="helpBlock" class="text-danger"><?=form_error('email')?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-input">
                                            <input type="text" name="phone" placeholder="Telefon" value="<?php if (isset($form_error)){ echo set_value('phone'); } ?>">
                                            <small>Lütfen başına 0 rakamı koymadan numaranızı yazınız.</small>
                                            <?php if(isset($form_error)): ?>
                                                <small id="helpBlock" class="text-danger"><?=form_error('phone')?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-input">
                                            <input type="text" name="subject" placeholder="Konu" value="<?php if (isset($form_error)){ echo set_value('subject'); } ?>">
                                            <?php if(isset($form_error)): ?>
                                                <small id="helpBlock" class="text-danger"><?=form_error('subject')?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single-input">
                                            <textarea name="message" cols="10" rows="4" placeholder="Mesaj"><?php if (isset($form_error)){ echo set_value('message'); } ?></textarea>
                                            <?php if(isset($form_error)): ?>
                                                <small id="helpBlock" class="text-danger"><?=form_error('message')?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 m-t-10">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <?=$captcha["image"]?>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="single-input">
                                                    <input type="text" name="captcha" placeholder="Güvenlik kodunu giriniz">
                                                    <?php if(isset($form_error)): ?>
                                                        <small id="helpBlock" class="text-danger"><?=form_error('captcha')?></small>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>">
                                    <div class="col-lg-12">
                                        <div class="single-input">
                                            <button class="cr-btn" type="submit">
                                                <span><i class="icofont icofont-paper-plane"></i> Gönder</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="pg-contact-details">
                            <div class="small-title">
                                <h2>İletişim Bilgileri</h2>
                                <p>İletişim formunu doldurarak veya aşağıdaki bilgilerden bize ulaşabilirsiniz.</p>
                            </div>
                            <ul>
                                <li class="single-quick-contact">
                                    <h5>Telefon / Fax</h5>
                                    <p>
                                        Telefon: <a href="tel:<?=settings("phone")?>"><?=settings("phone")?></a>
                                        <br>
                                        Fax: <?=settings("fax")?>
                                    </p>
                                </li>
                                <li class="single-quick-contact">
                                    <h5>E-Mail Adresimiz</h5>
                                    <p>
                                        <a href="mailto:<?=settings("email")?>"><?=settings("email")?></a>
                                    </p>
                                </li>
                                <li class="single-quick-contact">
                                    <h5>Adresimiz</h5>
                                    <p><?=settings("address")?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- //Page Content -->

    <?php $this->load->view('includes/footer'); ?>

</div>
<!-- //Main wrapper -->

<?php $this->load->view('includes/include_script'); ?>

</body>

</html>