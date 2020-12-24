<?php

function get_active_user(){
    $t = &get_instance();
    $user = $t->session->userdata("user");
    if($user){
        return $user;
    }else{
        return false;
    }
}

function rand_password( $length ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars),0,$length);

}

function send_mail($toEmail = "", $subjectMail = "", $messageMail = ""){
    $t = &get_instance();
    $t->load->model('email_settings_model');
    $emailSettings = $t->email_settings_model->get(array("isActive" => 1));

    $config = array(
        "protocol" => $emailSettings->protocol,
        "smtp_host" => $emailSettings->host,
        "smtp_port" => $emailSettings->port,
        "smtp_user" => $emailSettings->user,
        "smtp_pass" => $emailSettings->password,
        "starttls" => true,
        "charset" => "utf-8",
        "mailtype" => "html",
        "wordwrap" => true,
        "newline" => "\r\n"
    );
    $t->load->library("email", $config);

    $t->email->from($emailSettings->from, $emailSettings->user_name);
    $t->email->to($toEmail);
    $t->email->subject($subjectMail);
    $t->email->message($messageMail);

    return $t->email->send();
}

function reply_mail($toEmail = "", $subjectMail = "", $messageMail = "", $oldMessage){
    $t = &get_instance();
    $t->load->model('email_settings_model');
    $emailSettings = $t->email_settings_model->get(array("isActive" => 1));

    $config = array(
        "protocol" => $emailSettings->protocol,
        "smtp_host" => $emailSettings->host,
        "smtp_port" => $emailSettings->port,
        "smtp_user" => $emailSettings->user,
        "smtp_pass" => $emailSettings->password,
        "starttls" => true,
        "charset" => "utf-8",
        "mailtype" => "html",
        "wordwrap" => true,
        "newline" => "\r\n"
    );
    $t->load->library("email", $config);

    $mesaj1 = str_replace("myMessage", "$messageMail", htmlspecialchars_decode(settings("reply_template")));
    $mesaj2 = str_replace("myTitle", settings("title"), htmlspecialchars_decode($mesaj1));
    $mesaj3 = str_replace("oldMessage", "$oldMessage", htmlspecialchars_decode($mesaj2));
    $mesaj = str_replace("myLogo", logo("logo"), htmlspecialchars_decode($mesaj3));

    $t->email->from($emailSettings->from, $emailSettings->user_name);
    $t->email->to($toEmail);
    $t->email->subject($subjectMail);
    $t->email->message($mesaj);

    return $t->email->send();
}

function settings($name){
    $settings = array();
    require __DIR__. '/settings.php';
    return isset($settings[$name]) ? $settings[$name] : false;
}

function logo($item){
    $t = &get_instance();
    $t->load->model('settings_model');
    $logos = $t->settings_model->get();
    return base_url("uploads/settings_view/").$logos->$item;
}

function permission($url, $action){
    $user = get_active_user();
    $permission = json_decode($user->permissions, true);
    if (isset($permission[$url][$action])){
        return true;
    }else{
        return false;
    }
}

function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}