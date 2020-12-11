<?php

class Usersop extends CI_Controller{

    public $viewFolder = "";
    public $tableName = "users";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'users_view';
        $this->load->model('users_model');
        $this->load->database();
        $this->load->helper('cookie');
    }

    public function login()
    {
        if(get_active_user())
        {
            redirect(base_url());
        }

        $viewData = new stdClass();
        $this->load->library("form_validation");

        //Tablodan verilerin çekilmesi.
        //$items = $this->users_model->getAll(array(),"");

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";
        //$viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function doLogin()
    {
        if(get_active_user())
        {
            redirect(base_url());
        }

        $email = $this->input->post('user_email');
        $password = md5($this->input->post('user_password'));
        $remember_me = $this->input->post('remember_me');

        $this->load->library("form_validation");
        $this->form_validation->set_rules("user_email", "Email", "required|valid_email|trim");
        $this->form_validation->set_rules("user_password", "Şifre", "required|min_length[8]|trim");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            "valid_email" => "Lütfen geçerli bir eposta adresi giriniz.",
            "min_length" =>    "Şifre en az 8 karakterde olmalı."
        ));

        //Form validation çalıştır
        if($this->form_validation->run() == FALSE){

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "login";
            $this->session->set_flashdata("form_error", $viewData->form_error = true);
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }else{

            $user = $this->users_model->get(array("email" => $email , "password" => $password));
            if($user){
                if($user->isActive != 1){
                    $alert = array(
                        "title" => "Giriş başarısız!",
                        "text" => "Üyeliğiniz aktif değil!",
                        "type" => "error",
                        "position" => "top-center"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url('login'));
                    die();
                }else{
                    $alert = array(
                        "title" => "Hoşgeldiniz!!",
                        "text" => "<b>$user->user_name</b> kullanıcı adıyla giriş yaptınız!",
                        "type" => "success",
                        "position" => "top-center"
                    );

                    $this->session->set_userdata("user", $user);
                    $this->session->set_flashdata("alert", $alert);

                    if($remember_me == "on"){
                        $remember = array(
                            "email" => $email,
                            "password" => $this->input->post('user_password')
                        );
                        set_cookie("remember_me", json_encode($remember), time() + 60*60*24*30);
                    }else{
                        delete_cookie("remember_me");
                    }
                    redirect(base_url());
                }
            }else{
                $alert = array(
                    "title" => "Giriş başarısız!",
                    "text" => "Lütfen giriş bilgilerinizi kontrol ediniz!",
                    "type" => "error",
                    "position" => "top-center"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url('login'));
                die();
            }

        }
    }

    public function logout()
    {
        $this->session->unset_userdata("user");
        redirect(base_url('login'));
    }

    public function forget_password()
    {
        if(get_active_user())
        {
            redirect(base_url());
        }

        $viewData = new stdClass();
        $this->load->library("form_validation");

        //Tablodan verilerin çekilmesi.
        //$items = $this->users_model->getAll(array(),"");

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "forget_password";
        //$viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function reset_password()
    {
        if(get_active_user())
        {
            redirect(base_url());
        }

        $this->load->library("form_validation");
        $this->form_validation->set_rules("email", "Email Adresi", "required|valid_email|trim");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            "valid_email" => "Lütfen geçerli bir <strong>eposta</strong> adresi giriniz."
        ));

        if($this->form_validation->run() === FALSE){
            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "forget_password";
            $this->session->set_flashdata("form_error", $viewData->form_error = true);

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }else{
            $email = $this->input->post("email");

            $user = $this->users_model->get(array("isActive" => 1, "email" => $email));

            if($user){

                $random_pass = rand_password(8);

                $htmlMessage = "
                
                <h3>Şifreniz Sıfırlandı!</h3><br>
                
                <p>Şifrenizi sıfırlama talebinde bulundunuz. Yeni şifreniz aşağıda belirtilmiştir. Dilerseniz şifrenizi giriş yaptıktan sonra değiştirebilirsiniz.</p>
                <p>Yeni Şifreniz: $random_pass</p>
                
                ";

                $this->users_model->update(array("email" => $email), array("password" => md5($random_pass)));

                $send = send_mail($email, "Şifremi Unuttum", $htmlMessage);

                if($send){
                    $alert = array(
                        "title" => "İşlem Başarılı!",
                        "text" => "Yeni şifreniz Eposta adresinize gönderildi!",
                        "type" => "success",
                        "position" => "top-center"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url('login'));
                    die();
                }else{
                    echo $this->email->print_debugger();
                }
            }else{
                $alert = array(
                    "title" => "Hata!",
                    "text" => "Böyle bir Eposta adresi sisteme kayıtlı değil!",
                    "type" => "error",
                    "position" => "top-center"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url('forget_password'));
                die();
            }
        }

    }

}