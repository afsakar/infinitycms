<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Popups extends CI_Controller
{
    public $viewFolder = "";
    public $tableName = "popups";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'popups_view';
        $this->load->model('popups_model');
        if(!get_active_user())
        {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        if(!permission("popups", "show")){
            redirect(base_url());
        }
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Popuplar', '/popups');

        $viewData = new stdClass();

        /* Pagination Start */
        $config["base_url"] = base_url("$this->tableName/index");
        $config["total_rows"] = $this->popups_model->get_count();
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
        $items = $this->popups_model->get_records(
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

    public function addForm(){
        if(!permission("popups", "add")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Popuplar', '/popups');
        $this->breadcrumbs->push('Popup Ekle','/');

        $viewData = new stdClass();
        $this->load->model('menu_model');
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->menus = $this->menu_model->getAll(array("isActive" => 1), "rank ASC");
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function addItem()
    {
        if(!permission("popups", "add")){
            redirect(base_url());
        }
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Popuplar', '/popups');
        $this->breadcrumbs->push('Popup Ekle','/');

        $this->load->library("form_validation");

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("description", "Açıklama", "required|trim");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['page'] = $this->input->post('page');
            $data['popup_id'] = rand(1,100000);


            //Form verilerini kaydet
            $insert = $this->popups_model->add($data);
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
            redirect(base_url('popups'));

        } else {
            $viewData = new stdClass();
            $this->load->model('menu_model');

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->menus = $this->menu_model->getAll(array("isActive" => 1), "rank ASC");
            $this->session->set_flashdata("formError", $viewData->formError = true);
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
    }

    public function updateForm($id){

        if(!permission("popups", "edit")){
            redirect(base_url());
        }
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Popuplar', '/popups');
        $this->breadcrumbs->push('Popup Düzenle','/');

        $viewData = new stdClass();

        //Verilerin getirilmesi
        $item = $this->popups_model->get(
            array(
                "id" => $id
            )
        );
        $this->load->model('menu_model');

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $viewData->menus = $this->menu_model->getAll(array("isActive" => 1), "rank ASC");
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function updateItem($id){

        if(!permission("popups", "edit")){
            redirect(base_url());
        }
        $item = $this->popups_model->get(
            array(
                "id" => $id
            )
        );

        $this->load->library("form_validation");

        // Kurallar yazilir..
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("description", "Açıklama", "required|trim");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if ($validate) {

            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['page'] = $this->input->post('page');

            $update = $this->popups_model->update(array("id" => $id), $data);

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

            redirect(base_url("popups"));

        } else {

            $viewData = new stdClass();

            $this->load->model('menu_model');
            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->menus = $this->menu_model->getAll(array("isActive" => 1), "rank ASC");
            $viewData->form_error = true;

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->popups_model->get(
                array(
                    "id" => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function deleteItem($id)
    {
        if(!permission("popups", "delete")){
            $alert = array(
                "title" => "Hata!",
                "text" => "Bu işlemi yapmaya yetkiniz bulunmuyor!",
                "type" => "error",
                "position" => "top-center"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url());
        }
        $getItem = $this->popups_model->get(array("id" => $id));

        $delete = $this->popups_model->delete(
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
        redirect(base_url('popups'));
    }

    public function deleteImage($id, $parent_id)
    {
        if(!permission("popups", "delete")){
            $alert = array(
                "title" => "Hata!",
                "text" => "Bu işlemi yapmaya yetkiniz bulunmuyor!",
                "type" => "error",
                "position" => "top-center"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url());
        }
        $fileName = $this->popups_image_model->get(
            array("id" => $id)
        );

        $delete = $this->popups_image_model->delete(
            array(
                "id" => $id
            )
        );

        if ($delete) {
            $alert = array(
                "title" => "İşlem başarılı!",
                "text" => "Görsel başarıyla silindi!",
                "type" => "success",
                "position" => "top-center"
            );
            unlink("uploads/{$this->viewFolder}/$fileName->image_url");
        } else {
            $alert = array(
                "title" => "İşlem başarısız!",
                "text" => "Görsel silinirken bir hata oluştu, lütfen tekrar deneyin!",
                "type" => "error",
                "position" => "top-center"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("popups/imageForm/$parent_id"));
    }

    public function isActiveSetter($id){

        if ($id) {
            $isActive = $this->input->post("data");
            if ($isActive == "false") {
                $isActive = 0;
            } else {
                $isActive = 1;
            }

            $update = $this->popups_model->update(array("id" => $id), array("isActive" => $isActive));

        }

    }

    public function isCoverSetter($id, $parent_id){

        if ($id && $parent_id) {
            $isCover = $this->input->post("data");
            if ($isCover == "false") {
                $isCover = 0;
            } else {
                $isCover = 1;
            }

            if ($isCover = 0) {
                $update = $this->popups_image_model->update(array("id" => $id, "popups_id" => $parent_id), array("isCover" => 0));
                $update = $this->popups_image_model->update(array("id !=" => $id, "popups_id" => $parent_id), array("isCover" => 1));
            } else {
                $update = $this->popups_image_model->update(array("id" => $id, "popups_id" => $parent_id), array("isCover" => 1));
                $update = $this->popups_image_model->update(array("id !=" => $id, "popups_id" => $parent_id), array("isCover" => 0));
            }

        }

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->itemImages = $this->popups_image_model->getAll(array("popups_id" => $parent_id), "rank ASC");


        $renderHtml = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_view", $viewData, true);

        echo $renderHtml;

    }

    public function imageIsActiveSetter($id){

        if ($id) {
            $isActive = $this->input->post("data");
            if ($isActive == "false") {
                $isActive = 0;
            } else {
                $isActive = 1;
            }

            $update = $this->popups_image_model->update(array("id" => $id), array("isActive" => $isActive));

        }

    }

    public function rankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id) {
            $this->popups_model->update(array("id" => $id, "rank !=" => $rank), array("rank" => $rank));
        }
    }

    public function imageRankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id) {
            $this->popups_image_model->update(array("id" => $id, "rank !=" => $rank), array("rank" => $rank));
        }
    }

    public function imageForm($id)
    {

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Popuplar', '/popups');
        $this->breadcrumbs->push('Popup Görselleri','/');

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $item = $this->popups_model->get(
            array(
                "id" => $id
            )
        );

        $viewData->item = $item;
        $viewData->itemImages = $this->popups_image_model->getAll(array("popups_id" => $id), "rank ASC");
        $viewData->breadcrumbs = $this->breadcrumbs->show();


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function imageUpload($id){


        $randName = rand(0, 99999) . $this->viewFolder;

        $config["allowed_types"] = "jpg|jpeg|png";
        $config["upload_path"] = "uploads/$this->viewFolder/";
        $config['file_name'] = $randName;

        $this->load->library('upload', $config);

        $upload = $this->upload->do_upload("file");

        if ($upload) {
            $data['image_url'] = $this->upload->data("file_name");
            $data['popups_id'] = $id;

            $result = $this->popups_image_model->add($data);

        } else {
            echo "başarısız";
        }

    }

    public function refreshImageList($id){

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->itemImages = $this->popups_image_model->getAll(array("popups_id" => $id), "rank ASC");


        $renderHtml = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_view", $viewData, true);

        echo $renderHtml;
    }

}
