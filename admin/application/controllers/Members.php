<?php
defined('BASEPATH') or exit('No direct script access allowed');

class members extends CI_Controller
{
    public $viewFolder = "";
    public $tableName = "members";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'members_view';
        $this->load->model('members_model');
        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        if (!permission("members", "show")) {
            redirect(base_url());
        }
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Aboneler', '/members');

        $viewData = new stdClass();

        /* Pagination Start */
        $config["base_url"] = base_url("$this->tableName/index");
        $config["total_rows"] = $this->members_model->get_count();
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
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $viewData->links = $this->pagination->create_links();
        /* Pagination End */

        //Tablodan verilerin çekilmesi.
        $items = $this->members_model->get_records(
            array(),
            "",
            $config["per_page"],
            $page
        );

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $viewData->breadcrumbs = $this->breadcrumbs->show();


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function deleteItem($id)
    {
        if (!permission("members", "delete")) {
            $alert = array(
                "title" => "Hata!",
                "text" => "Bu işlemi yapmaya yetkiniz bulunmuyor!",
                "type" => "error",
                "position" => "top-center"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url());
        }
        $getItem = $this->members_model->get(array("id" => $id));

        $delete = $this->members_model->delete(
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
        redirect(base_url('members'));
    }

    public function isActiveSetter($id)
    {

        if ($id) {
            $isActive = $this->input->post("data");
            if ($isActive == "false") {
                $isActive = 0;
            } else {
                $isActive = 1;
            }

            $update = $this->members_model->update(array("id" => $id), array("isActive" => $isActive));

        }

    }

    public function messageForm()
    {

        if (!permission("members", "send")) {
            redirect(base_url("members"));
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Aboneler', '/members');
        $this->breadcrumbs->push('Yeni Mesaj Oluştur', '/');

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "send";
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function sendMessage(){

        if (!permission("members", "send")) {
            redirect(base_url("members"));
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Aboneler', '/members');
        $this->breadcrumbs->push('Yeni Mesaj Oluştur', '/');

        $this->load->library("form_validation");

        $this->form_validation->set_rules("subject", "Konu", "required|trim");
        $this->form_validation->set_rules("message", "Mesaj", "required|trim");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            $data["subject"] = $this->input->post("subject");
            $data['message'] = htmlspecialchars($this->input->post('message'));

            $members = $this->members_model->getAll(array("isActive" => 1), "");

            foreach ($members as $member) {
                $new_arr[] = $member->email;
            }
            $res_arr = implode(',', $new_arr);

            $send = members_mail($res_arr, $data["subject"], $data['message']);

            if ($send) {
                $alert = array(
                    "title" => "İşlem başarılı!",
                    "text" => "Mesaj başarıyla gönderildi!",
                    "type" => "success",
                    "position" => "top-center"
                );
            } else {
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Mesaj gönderilirken bir hata oluştu, lütfen tekrar deneyin!",
                    "type" => "error",
                    "position" => "top-center"
                );
            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url('members'));

        } else {
            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "send";
            $viewData->breadcrumbs = $this->breadcrumbs->show();
            $this->session->set_flashdata("formError", $viewData->formError = true);

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

}
