<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public $viewFolder = "";
    public $tableName = "users";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'users_view';
        $this->load->model('users_model');
        $this->load->database();
        $this->userLoad = get_active_user();
        $this->userData = $this->session->userdata("user");
        if(!get_active_user())
        {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $userRole=$this->userData;
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Kullanıcılar', '/users');

        $viewData = new stdClass();

        /* Pagination Start */
        $config["base_url"] = base_url("$this->tableName/index");
        $config["total_rows"] = $this->users_model->get_count();
        $config["uri_segment"] = 3;
        $config["per_page"] = 10;
        $config["num_links"] = 2;

        $config['full_tag_open'] = "<nav class='search-results-navigation'> <ul class='pagination'>";
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Geri';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'İleri<i class="fa fa-long-arrow-right"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3): 0;
        $viewData->links = $this->pagination->create_links();
        /* Pagination End */

        //Tablodan verilerin çekilmesi.
        //Tablodan verilerin çekilmesi.
        if($userRole->user_type != "superadmin"){
            $items = $this->users_model->get_records(
                array("id" => $userRole->id),
                "",
                $config["per_page"],
                $page
            );
        }else{
            $items = $this->users_model->get_records(
                array(),
                "",
                $config["per_page"],
                $page
            );
        }

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $viewData->userRole = $this->userData;
        $viewData->breadcrumbs = $this->breadcrumbs->show();


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function addForm(){

        $userRole=$this->userData;
        if($userRole->user_type != "superadmin"){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Kullanıcılar', '/users');
        $this->breadcrumbs->push('Kullanıcı Ekle','/');

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function addItem()
    {
        $userRole=$this->userData;
        if($userRole->user_type != "superadmin"){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Kullanıcılar', '/users');
        $this->breadcrumbs->push('Kullanıcı Ekle','/');

        $this->load->library("form_validation");

            if ($_FILES["img_url"]["name"] == "") {
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Lütfen bir görsel seçiniz!",
                    "type" => "error",
                    "position" => "top-center"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url('users/addForm'));
                die();
            }


        $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|is_unique[users.user_name]|trim");
        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        $this->form_validation->set_rules("email", "Email", "required|is_unique[users.email]|valid_email|trim");
        $this->form_validation->set_rules("password", "Şifre", "required|min_length[8]|trim");
        $this->form_validation->set_rules("re_password", "Şifre Tekrarı", "required|matches[password]|min_length[8]|trim");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            "valid_email" => "Lütfen geçerli bir eposta adresi giriniz.",
            "is_unique" => "<strong>{field}</strong> alanında aynı isimde bir kayıt mecvut.",
            "matches" =>    "Şifreler uyuşmuyor.",
            "min_length" =>    "Şifre en az 8 karakterde olmalı."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['user_name'] = $this->input->post('user_name');
            $data['full_name'] = $this->input->post('full_name');
            $data['email'] = $this->input->post('email');
            $data['password'] = md5($this->input->post('password'));
            $data['user_type'] = $this->input->post('user_type');

                $randName = rand(0, 99999) . $this->viewFolder;

                $config["allowed_types"] = "jpg|jpeg|png";
                $config["upload_path"] = "uploads/$this->viewFolder/";
                $config['file_name'] = $randName;

                $this->load->library('upload', $config);

                $upload = $this->upload->do_upload("img_url");

                if ($upload) {
                    $data['img_url'] = $this->upload->data("file_name");
                } else {
                    $alert = array(
                        "title" => "İşlem başarısız!",
                        "text" => "Görsel yüklenirken bir hata oluştu, lütfen tekrar deneyin!",
                        "type" => "error",
                        "position" => "top-center"
                    );
                }

            //Form verilerini kaydet
            $insert = $this->users_model->add($data);
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
            redirect(base_url('users'));
            die();
        } else {
            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $this->session->set_flashdata("formError", $viewData->formError = true);
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
    }

    public function updateForm($id){
        $userRole=$this->userData;
        if($userRole->id != $id && $userRole->user_type != "superadmin"){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Kullanıcılar', '/users');
        $this->breadcrumbs->push('Kullanıcı Düzenle','/');

        $viewData = new stdClass();

        //Verilerin getirilmesi
        $item = $this->users_model->get(
            array(
                "id" => $id
            )
        );

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->userData = $this->session->userdata("user");
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $viewData->userRole = $this->userData;
        $viewData->permissions = json_decode($item->permissions, true);
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function updateItem($id){
        $userRole=$this->userData;
        if($userRole->id != $id && $userRole->user_type != "superadmin"){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Kullanıcılar', '/users');
        $this->breadcrumbs->push('Kullanıcı Düzenle','/');

        $item = $this->users_model->get(
            array(
                "id" => $id
            )
        );

        $this->load->library("form_validation");

        // Kurallar yazilir..
        if($this->input->post('user_name') != $item->user_name){
            $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|is_unique[users.user_name]|trim");
        }
        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        if($this->input->post('email') != $item->email){
            $this->form_validation->set_rules("email", "Email", "required|is_unique[users.email]|valid_email|trim");
        }

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            "valid_email" => "Lütfen geçerli bir eposta adresi giriniz.",
            "is_unique" => "<strong>{field}</strong> alanında aynı isimde bir kayıt mecvut."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {

            $data['user_name'] = $this->input->post('user_name');
            $data['full_name'] = $this->input->post('full_name');
            $data['email'] = $this->input->post('email');
            $data['permissions'] = json_encode($this->input->post('permissions'));

                // Upload Süreci...
                if ($_FILES["img_url"]["name"] !== "") {

                    $randName = rand(0, 99999) . $this->viewFolder;

                    $config["allowed_types"] = "jpg|jpeg|png";
                    $config["upload_path"] = "uploads/$this->viewFolder/";
                    $config['file_name'] = $randName;

                    $this->load->library('upload', $config);

                    $upload = $this->upload->do_upload("img_url");

                    if ($upload) {
                        $data['img_url'] = $this->upload->data("file_name");
                        unlink("uploads/{$this->viewFolder}/$item->img_url");
                    } else {
                        $alert = array(
                            "title" => "İşlem başarısız!",
                            "text" => "Görsel yüklenirken bir problem oluştu!",
                            "type" => "error",
                            "position" => "top-center"
                        );
                        $this->session->set_flashdata("alert", $alert);
                        redirect(base_url("users/updateForm/$id"));
                        die();
                    }

                }

            $update = $this->users_model->update(array("id" => $id), $data);

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
            redirect(base_url("users"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->userRole = $this->userData;
            $viewData->permissions = json_decode($item->permissions, true);
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->users_model->get(
                array(
                    "id" => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function deleteItem($id)
    {
        $userRole=$this->userData;
        if($userRole->user_type != "superadmin"){
            redirect(base_url());
            die();
        }
        $getItem = $this->users_model->get(array("id" => $id));

        $delete = $this->users_model->delete(
            array(
                "id" => $id
            )
        );

        if ($delete) {
            unlink("uploads/{$this->viewFolder}/$getItem->img_url");

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
        redirect(base_url('users'));
    }

    public function isActiveSetter($id){

        if ($id) {
            $isActive = $this->input->post("data");
            if ($isActive == "false") {
                $isActive = 0;
            } else {
                $isActive = 1;
            }

            $update = $this->users_model->update(array("id" => $id), array("isActive" => $isActive));

        }

    }

    public function rankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id) {
            $this->users_model->update(array("id" => $id, "rank !=" => $rank), array("rank" => $rank));
        }
    }

    public function password($id){

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Kullanıcılar', '/users');
        $this->breadcrumbs->push('Şifre Düzenle','/');

        $viewData = new stdClass();

        //Verilerin getirilmesi
        $item = $this->users_model->get(
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
        $this->breadcrumbs->push('Kullanıcılar', '/users');
        $this->breadcrumbs->push('Kullanıcı Düzenle','/');

        $item = $this->users_model->get(
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

            if($data['password'] == $item->password){
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Yeni şifreniz eski şifreniz ile aynı olamaz! $item->password",
                    "type" => "error",
                    "position" => "top-center"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("users/updatePassword/$id"));
                die();
            }

            $update = $this->users_model->update(array("id" => $id), $data);

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
            $viewData->item = $this->users_model->get(
                array(
                    "id" => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

}
