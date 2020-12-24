<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{
    public $viewFolder = "";
    public $tableName = "contact";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'contact_view';
        $this->load->model('contact_model');
        $this->load->model("users_model");
        if(!get_active_user())
        {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        if(!permission("contact", "show")){
            redirect(base_url());
        }
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('İletişim Mesajları', '/contact');

        $viewData = new stdClass();

        /* Pagination Start */
        $config["base_url"] = base_url("$this->tableName/index");
        $config["total_rows"] = $this->contact_model->get_count();
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
        $items = $this->contact_model->get_records(
            array(),
            "createdAt DESC",
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

    public function readForm($id){

        if(!permission("contact", "edit")){
            redirect(base_url());
        }
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('İletişim Mesajları', '/contact');
        $this->breadcrumbs->push('Mesaj Yanıtla','/');

        $viewData = new stdClass();

        //Verilerin getirilmesi
        $item = $this->contact_model->get(
            array(
                "id" => $id
            )
        );

        $user = get_active_user();

        if($item->isRead == 0){
            $this->contact_model->update(array("id" => $id), array("readDate" => date("d M Y H:i:s"), "readUser" => $user->id, "isRead" => 1));
        }

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "read";
        $viewData->item = $item;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function reply($id){

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('İletişim Mesajları', '/contact');
        $this->breadcrumbs->push('Mesaj Yanıtla','/');

        if(!permission("contact", "send")){
            redirect(base_url());
        }
        $item = $this->contact_model->get(
            array(
                "id" => $id
            )
        );

        $this->load->library("form_validation");

        // Kurallar yazilir..
        $this->form_validation->set_rules("replyMessage", "Mesaj", "required|trim");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if ($validate) {

            $data['message'] = $this->input->post('replyMessage');
            $data['to'] = $this->input->post('to');
            $data['subject'] = "RE: ".$this->input->post('subject');
            $data['oldMessage'] = "<br><br><br><hr><small>$item->message($item->createdAt tarihli mesajınız.)</small>";

            $send = reply_mail($data["to"], $data["subject"], $data["message"], $data['oldMessage']);

            // TODO Alert sistemi eklenecek...
            if ($send) {

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Mesaj başarıyla gönderildi!",
                    "type" => "success",
                    "position" => "top-center"
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Mesaj gönderilirken bir problem oluştu",
                    "type" => "error",
                    "position" => "top-center"
                );
            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("contact/readForm/$item->id"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "read";
            $viewData->form_error = true;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->contact_model->get(
                array(
                    "id" => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function deleteItem($id)
    {
        if(!permission("contact", "delete")){
            $alert = array(
                "title" => "Hata!",
                "text" => "Bu işlemi yapmaya yetkiniz bulunmuyor!",
                "type" => "error",
                "position" => "top-center"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url());
        }
        $getItem = $this->contact_model->get(array("id" => $id));

        $delete = $this->contact_model->delete(
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
        redirect(base_url('contact'));
    }

}
