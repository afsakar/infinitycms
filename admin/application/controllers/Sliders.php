<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sliders extends CI_Controller
{
    public $viewFolder = "";
    public $tableName = "sliders";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'sliders_view';
        $this->load->model('sliders_model');
        if(!get_active_user())
        {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        if(!permission("sliders", "show")){
            redirect(base_url());
        }
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Slider İşlemleri', '/sliders');

        $viewData = new stdClass();

        /* Pagination Start */
        $config["base_url"] = base_url("$this->tableName/index");
        $config["total_rows"] = $this->sliders_model->get_count();
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
        $items = $this->sliders_model->get_records(
            array(),
            "rank ASC",
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

    public function addForm(){
        if(!permission("sliders", "add")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Slider İşlemleri', '/sliders');
        $this->breadcrumbs->push('Slider Ekle','/');

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function addItem()
    {
        if(!permission("sliders", "add")){
            redirect(base_url());
        }
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Slider İşlemleri', '/sliders');
        $this->breadcrumbs->push('Slider Ekle','/');

        $this->load->library("form_validation");

            if ($_FILES["img_url"]["name"] == "") {
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Lütfen bir görsel seçiniz!",
                    "type" => "error",
                    "position" => "top-center"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url('sliders/addForm'));
            }

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("allowButton", "Buton seçeneği", "required|trim");
        $this->form_validation->set_rules("description", "Açıklama", "required|trim");

            if($this->input->post("allowButton") == 1){
                $this->form_validation->set_rules("buttonUrl", "Buton URL", "required|trim");
                $this->form_validation->set_rules("buttonText", "Buton Yazısı", "required|trim");
            }

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['title'] = $this->input->post('title');
            $data['description'] = htmlspecialchars($this->input->post('description'));
            $data['allowButton'] = $this->input->post('allowButton');
            $data['buttonUrl'] = $this->input->post('buttonUrl');
            $data['buttonText'] = $this->input->post('buttonText');

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
            $insert = $this->sliders_model->add($data);
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
            redirect(base_url('sliders'));

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

        if(!permission("sliders", "edit")){
            redirect(base_url());
        }
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Slider İşlemleri', '/sliders');
        $this->breadcrumbs->push('Slider Düzenle','/');

        $viewData = new stdClass();

        //Verilerin getirilmesi
        $item = $this->sliders_model->get(
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
        $this->breadcrumbs->push('Slider İşlemleri', '/sliders');
        $this->breadcrumbs->push('Slider Düzenle','/');

        if(!permission("sliders", "edit")){
            redirect(base_url());
        }
        $item = $this->sliders_model->get(
            array(
                "id" => $id
            )
        );

        $this->load->library("form_validation");

        // Kurallar yazilir..
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("allowButton", "Buton seçeneği", "required|trim");
        $this->form_validation->set_rules("description", "Açıklama", "required|trim");

        if($this->input->post("allowButton") == 1){
            $this->form_validation->set_rules("buttonUrl", "Buton URL", "required|trim");
            $this->form_validation->set_rules("buttonText", "Buton Yazısı", "required|trim");
        }

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if ($validate) {

            $data['title'] = $this->input->post('title');
            $data['description'] = htmlspecialchars($this->input->post('description'));
            $data['allowButton'] = $this->input->post('allowButton');
            if($data['allowButton'] == 0){
                $data['buttonUrl'] = "";
                $data['buttonText'] = "";
            }else{
                $data['buttonUrl'] = $this->input->post('buttonUrl');
                $data['buttonText'] = $this->input->post('buttonText');
            }

                // Upload Süreci...
                if ($_FILES["img_url"]["name"] !== "") {

                    $file_name = rand(0, 99999) . $this->viewFolder;

                    $config["allowed_types"] = "jpg|jpeg|png";
                    $config["upload_path"] = "uploads/$this->viewFolder/";
                    $config["file_name"] = $file_name;

                    $this->load->library("upload", $config);

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

                        redirect(base_url("sliders/updateForm/$id"));

                        die();

                    }

                }

            $update = $this->sliders_model->update(array("id" => $id), $data);

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

            redirect(base_url("sliders"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->sliders_model->get(
                array(
                    "id" => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function deleteItem($id)
    {
        if(!permission("sliders", "delete")){
            $alert = array(
                "title" => "Hata!",
                "text" => "Bu işlemi yapmaya yetkiniz bulunmuyor!",
                "type" => "error",
                "position" => "top-center"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url());
        }
        $getItem = $this->sliders_model->get(array("id" => $id));

        $delete = $this->sliders_model->delete(
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
        redirect(base_url('sliders'));
    }

    public function isActiveSetter($id){

        if ($id) {
            $isActive = $this->input->post("data");
            if ($isActive == "false") {
                $isActive = 0;
            } else {
                $isActive = 1;
            }

            $update = $this->sliders_model->update(array("id" => $id), array("isActive" => $isActive));

        }

    }

    public function rankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id) {
            $this->sliders_model->update(array("id" => $id, "rank !=" => $rank), array("rank" => $rank));
        }
    }

}
