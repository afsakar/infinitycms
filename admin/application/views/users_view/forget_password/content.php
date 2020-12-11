<?php
$remember_me = get_cookie("remember_me");
if($remember_me){
    $member = json_decode($remember_me);
}
?>
<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="#">
            <span><i class="fa fa-code"></i></span>
            <span>Infinity</span>
        </a>
    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="reset-password-form">
        <h4 class="form-title m-b-xl text-center">Şifrenizi mi unuttunuz?</h4>

        <form action="<?=base_url("usersop/reset_password")?>" method="post">
            <div class="form-group">
                <input id="reset-password-email" name="email" type="email" class="form-control" placeholder="Sisteme kayıtlı Email adresiniz" value="<?php if (isset($form_error)){ echo set_value('email'); }?>">
                <small class="text-danger"><?=form_error('email')?></small>
            </div>
            <div class="row">
                <div class="col-md-6 m-t-md">
                    <button class="btn btn-primary" type="submit">Şifremi Sıfırla</button>
                </div>
                <div class="col-md-6 m-t-md">
                    <a href="<?=base_url('login')?>" class="btn btn-danger btn-outline" >Geri dön</a>
                </div>
            </div>
        </form>
    </div><!-- #reset-password-form -->

</div><!-- .simple-page-wrap -->