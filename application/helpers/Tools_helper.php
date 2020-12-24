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

function rand_password($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars),0,$length);
}

function send_mail($toEmail = "", $subjectMail = "", $messageMail = ""){
    $t = &get_instance();
    $t->load->model('data_model');
    $emailSettings = $t->data_model->get("email_settings", array("isActive" => 1));

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

function settings($name){
    $settings = array();
    require __DIR__ . '/settings.php';
    return isset($settings[$name]) ? $settings[$name] : false;
}

function logo($item){
    $t = &get_instance();
    $t->load->model('data_model');
    $logos = $t->data_model->get("settings");
    return base_url("admin/uploads/settings_view/").$logos->$item;
}

function getCover($id){
    $t=&get_instance();
    $t->load->model("data_model");
    $cover = $t->data_model->get("project_images", array("isActive" => 1, "project_id" => $id, "isCover" => 1));
    if(empty($cover)){
        $cover = $t->data_model->get("project_images", array("isActive" => 1, "project_id" => $id));
    }
    return !empty($cover) ? $cover->image_url : "";
}

function contact_mail($name = "", $fromMail = "", $phoneMail = "", $subjectMail = "", $messageMail = ""){
    $t = &get_instance();
    $t->load->model('data_model');
    $emailSettings = $t->data_model->get("email_settings", array("isActive" => 1));

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

    $mesaj1 = str_replace("myName", "$name", htmlspecialchars_decode(settings("contact_template")));
    $mesaj2 = str_replace("myPhone", "$phoneMail", htmlspecialchars_decode($mesaj1));
    $mesaj3 = str_replace("myMail", "$fromMail", htmlspecialchars_decode($mesaj2));
    $mesaj4 = str_replace("myMessage", "$messageMail", htmlspecialchars_decode($mesaj3));
    $mesaj = str_replace("myLogo", logo("logo"), htmlspecialchars_decode($mesaj4));

    $t->email->from($fromMail, $name);
    $t->email->to($emailSettings->user);
    $t->email->subject($subjectMail);
    $t->email->message($mesaj);

    return $t->email->send();
}

function popup($page = ""){
    $t = &get_instance();
    $t->load->model('data_model');
    $popup = $t->data_model->get("popups", array(
        "isActive" => 1,
        "page" => $page
    ));
    return (!empty($popup)) ? $popup : false;
}

function copyright(){
    return '<div class="col-12 text-center">
                    '.settings("footer_text").'</div>
                <div class="col-12 text-center" style="font-size: 14px;">
                    Web Programlama: <a class="text-white" href="http://www.afsakar.com">Azad Furkan ŞAKAR</a>
                </div>';
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