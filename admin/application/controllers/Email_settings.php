<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email_settings extends CI_Controller
{
    public $viewFolder = "";
    public $tableName = "email_settings";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'email_view';
        $this->load->model('email_settings_model');
        $this->load->database();
        if(!get_active_user())
        {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Email Listesi', '/users');

        $viewData = new stdClass();

        //Tablodan verilerin çekilmesi.
        $items = $this->email_settings_model->getAll(array(),"");

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function addForm(){

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Email Listesi', '/users');
        $this->breadcrumbs->push('Yeni Email Hesabı Ekle','/');

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function addItem()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Email Listesi', '/users');
        $this->breadcrumbs->push('Yeni Email Hesabı Ekle','/');

        $this->load->library("form_validation");

        $this->form_validation->set_rules("protocol", "Protokol Türü", "required|trim");
        $this->form_validation->set_rules("host", "Email Sunucu Bilgisi", "required|trim");
        $this->form_validation->set_rules("port", "Port Numarası", "required|trim");
        $this->form_validation->set_rules("user", "Email Adres,", "required|trim|valid_email");
        $this->form_validation->set_rules("password", "Şifre", "required|trim");
        $this->form_validation->set_rules("from", "From Adresi", "required|trim|valid_email");
        $this->form_validation->set_rules("to", "To Adresi", "required|trim|valid_email");
        $this->form_validation->set_rules("user_name", "Email Görünen İsim", "required|trim");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            "valid_email" => "Lütfen geçerli bir eposta adresi giriniz."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['user_name'] = $this->input->post('user_name');
            $data['protocol'] = $this->input->post('protocol');
            $data['port'] = $this->input->post('port');
            $data['user'] = $this->input->post('user');
            $data['password'] = $this->input->post('password');
            $data['from'] = $this->input->post('from');
            $data['to'] = $this->input->post('to');
            $data['host'] = $this->input->post('host');

            //Form verilerini kaydet
            $insert = $this->email_settings_model->add($data);
            if ($insert) {
                $alert = array(
                    "title" => "İşlem başarılı!",
                    "text" => "Kayıt başarıyla eklendi!",
                    "type" => "success",
                    "position" => "top-center"
                );
            } else {
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Kayıt eklenirken bir hata oluştu, lütfen tekrar deneyin!",
                    "type" => "error",
                    "position" => "top-center"
                );
            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url('email_settings'));
            die();
        } else {
            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $this->session->set_flashdata("form_error", $viewData->form_error = true);
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
    }

    public function updateForm($id){

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Email Listesi', '/users');
        $this->breadcrumbs->push('Email Hesabı Düzenle','/');

        $viewData = new stdClass();

        //Verilerin getirilmesi
        $item = $this->email_settings_model->get(
            array(
                "id" => $id
            )
        );

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function updateItem($id){

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Email Listesi', '/users');
        $this->breadcrumbs->push('Email Hesabı Düzenle','/');

        $item = $this->email_settings_model->get(
            array(
                "id" => $id
            )
        );

        $this->load->library("form_validation");

        $this->form_validation->set_rules("protocol", "Protokol Türü", "required|trim");
        $this->form_validation->set_rules("host", "Email Sunucu Bilgisi", "required|trim");
        $this->form_validation->set_rules("port", "Port Numarası", "required|trim");
        $this->form_validation->set_rules("user", "Email Adres,", "required|trim|valid_email");
        $this->form_validation->set_rules("password", "Şifre", "required|trim");
        $this->form_validation->set_rules("from", "From Adresi", "required|trim|valid_email");
        $this->form_validation->set_rules("to", "To Adresi", "required|trim|valid_email");
        $this->form_validation->set_rules("user_name", "Email Görünen İsim", "required|trim");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            "valid_email" => "Lütfen geçerli bir eposta adresi giriniz."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {

            $data['user_name'] = $this->input->post('user_name');
            $data['protocol'] = $this->input->post('protocol');
            $data['port'] = $this->input->post('port');
            $data['user'] = $this->input->post('user');
            $data['password'] = $this->input->post('password');
            $data['from'] = $this->input->post('from');
            $data['to'] = $this->input->post('to');
            $data['host'] = $this->input->post('host');

            $update = $this->email_settings_model->update(array("id" => $id), $data);

            // TODO Alert sistemi eklenecek...
            if ($update) {
                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Kayıt başarılı bir şekilde güncellendi",
                    "type" => "success",
                    "position" => "top-center"
                );
            } else {
                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Kayıt Güncelleme sırasında bir problem oluştu",
                    "type" => "error",
                    "position" => "top-center"
                );
            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("email_settings"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->email_settings_model->get(
                array(
                    "id" => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function deleteItem($id)
    {
        $delete = $this->email_settings_model->delete(
            array(
                "id" => $id
            )
        );

        if ($delete) {
            $alert = array(
                "title" => "İşlem başarılı!",
                "text" => "Kayıt başarıyla silindi!",
                "type" => "success",
                "position" => "top-center"
            );
        } else {
            $alert = array(
                "title" => "İşlem başarısız!",
                "text" => "Kayıt silinirken bir hata oluştu, lütfen tekrar deneyin!",
                "type" => "error",
                "position" => "top-center"
            );
        }

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url('email_settings'));
    }

    public function isActiveSetter($id){

        if ($id) {
            $isActive = $this->input->post("data");
            if ($isActive == "false") {
                $isActive = 0;
            } else {
                $isActive = 1;
            }

            if($isActive = 0){
                $update = $this->email_settings_model->update(array("id" => $id), array("isActive" => 0));
                $update = $this->email_settings_model->update(array("id !=" => $id), array("isActive" => 1));
            }else{
                $update = $this->email_settings_model->update(array("id" => $id), array("isActive" => 1));
                $update = $this->email_settings_model->update(array("id !=" => $id), array("isActive" => 0));
            }

        }

    }

    public function rankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id) {
            $this->email_settings_model->update(array("id" => $id, "rank !=" => $rank), array("rank" => $rank));
        }
    }

    public function password($id){

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Email Listesi', '/users');
        $this->breadcrumbs->push('Şifre Düzenle','/');

        $viewData = new stdClass();

        //Verilerin getirilmesi
        $item = $this->email_settings_model->get(
            array(
                "id" => $id
            )
        );

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "password";
        $viewData->item = $item;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function updatePassword($id){

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Email Listesi', '/users');
        $this->breadcrumbs->push('Email Hesabı Düzenle','/');

        $item = $this->email_settings_model->get(
            array(
                "id" => $id
            )
        );

        $this->load->library("form_validation");

        // Kurallar yazilir..

        $this->form_validation->set_rules("password", "Şifre", "required|min_length[8]|trim");
        $this->form_validation->set_rules("re_password", "Şifre Tekrarı", "required|matches[password]|min_length[8]|trim");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            "matches" =>    "Şifreler uyuşmuyor.",
            "min_length" =>    "Şifre en az 8 karakterde olmalı."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {

            $data['password'] = md5($this->input->post('password'));

            if($data['password'] = $item->password){
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Yeni şifreniz eski şifreniz ile aynı olamaz!",
                    "type" => "error",
                    "position" => "top-center"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("users/updatePassword/$id"));
                die();
            }

            $update = $this->email_settings_model->update(array("id" => $id), $data);

            // TODO Alert sistemi eklenecek...
            if ($update) {
                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Şifreniz başarıyla güncellendi!",
                    "type" => "success",
                    "position" => "top-center"
                );
            } else {
                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Kayıt Güncelleme sırasında bir problem oluştu",
                    "type" => "error",
                    "position" => "top-center"
                );
            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("users"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "password";
            $viewData->form_error = true;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->email_settings_model->get(
                array(
                    "id" => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

}
