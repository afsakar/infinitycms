<?php
$remember_me = get_cookie("remember_me");
if($remember_me){
    $member = json_decode($remember_me);
}
?>
<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="index.html">
            <span><i class="fa fa-code"></i></span>
            <span>Infinity</span>
        </a>
    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="login-form">
        <h4 class="form-title m-b-xl text-center">Panele Erişmek için Giriş Yapın</h4>
        <form action="<?=base_url('usersop/doLogin')?>" method="post">
            <div class="form-group">
                <input id="sign-in-email" type="email" name="user_email" class="form-control" placeholder="Eposta adresiniz" value="<?php if (isset($form_error)){ echo set_value('user_email'); }elseif($remember_me){echo $member->email;} ?>">
                <small class="text-danger"><?=form_error('user_email')?></small>
            </div>

            <div class="form-group">
                <input id="sign-in-password" type="password" name="user_password" class="form-control" placeholder="Şifre" value="<?php if($remember_me) { echo $member->password; }else{ null; }?>">
                <small class="text-danger"><?=form_error('user_password')?></small>
            </div>

            <div class="form-group m-b-xl">
                <div class="checkbox checkbox-primary">

                    <input type="checkbox" id="keep_me_logged_in" name="remember_me" <?php if($remember_me) { echo "checked"; }else{ echo ""; }?>/>
                    <label for="keep_me_logged_in">Beni hatırla</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in-alt"></i> Giriş Yap</button>
        </form>
    </div><!-- #login-form -->

    <div class="simple-page-footer">
        <p><a href="<?=base_url("forget_password")?>">Şifremi unuttum</a></p>
<!--        <p>-->
<!--            <small>Don't have an account ?</small>-->
<!--            <a href="signup.html">CREATE AN ACCOUNT</a>-->
<!--        </p>-->
    </div><!-- .simple-page-footer -->
</div><!-- .simple-page-wrap -->