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