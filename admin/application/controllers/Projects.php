<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends CI_Controller
{
    public $viewFolder = "";
    public $tableName = "projects";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'projects_view';
        $this->load->model('projects_model');
        $this->load->model('projects_image_model');
    }

    public function index()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Projeler', '/projects');
        $viewData = new stdClass();

        //Tablodan verilerin çekilmesi.
        $items = $this->projects_model->getAll(
            array(),
            "rank ASC"
        );

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $viewData->breadcrumbs = $this->breadcrumbs->show();


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function addForm(){
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Projeler', '/projects');
        $this->breadcrumbs->push('Proje Ekle','/');
        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->breadcrumbs = $this->breadcrumbs->show();
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function addItem()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Projeler', '/projects');
        $this->breadcrumbs->push('Proje Ekle','/');

        //Form Validation
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("description", "Açıklama", "required");
        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['title'] = $this->input->post('title');
            $data['description'] = htmlspecialchars($this->input->post('description'));
            $data['seo'] = json_encode($this->input->post('seo'), JSON_UNESCAPED_UNICODE);
            $data['url'] = permalink($this->input->post('url'));

            if (!$data['url']) {
                $data['url'] = permalink($this->input->post('title'));
            }


            //Form verilerini kaydet
            $insert = $this->projects_model->add($data);
            if ($insert) {
                $alert = array(
                    "title"     => "İşlem başarılı!",
                    "text"      => "Kayıt başarıyla eklendi!",
                    "type"      => "success",
                    "position"  => "top-center"
                );
            } else {
                $alert = array(
                    "title"     => "İşlem başarısız!",
                    "text"      => "Kayıt eklenirken bir hata oluştu, lütfen tekrar deneyin!",
                    "type"      => "error",
                    "position"  => "top-center"
                );
            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url('projects'));

        } else {

            $viewData = new stdClass();

            //View'e gönderilen verilerin set edilmesi.
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
    }

    public function updateItem($id)
    {
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Projeler', '/projects');
        $this->breadcrumbs->push('Proje Düzenle','/');
        //Form Validation
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("description", "Açıklama", "required");
        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['title'] = $this->input->post('title');
            $data['description'] = htmlspecialchars($this->input->post('description'));
            $data['seo'] = json_encode($this->input->post('seo'), JSON_UNESCAPED_UNICODE);
            $data['url'] = permalink($this->input->post('url'));

            if (!$data['url']) {
                $data['url'] = permalink($this->input->post('title'));
            }


            //Form verilerini güncelle
            $update = $this->projects_model->update(array("id" => $id), $data);
            if ($update) {
                $alert = array(
                    "title"     => "İşlem başarılı!",
                    "text"      => "Kayıt başarıyla güncellendi!",
                    "type"      => "success",
                    "position"  => "top-center"
                );
            } else {
                $alert = array(
                    "title"     => "İşlem başarısız!",
                    "text"      => "Kayıt güncellenirken bir hata oluştu, lütfen tekrar deneyin!",
                    "type"      => "error",
                    "position"  => "top-center"
                );
            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url('projects'));

        } else {

            $viewData = new stdClass();

            //Verilerin getirilmesi
            $item = $this->projects_model->get(
                array(
                    "id" => $id
                )
            );

            //View'e gönderilen verilerin set edilmesi.
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;
            $viewData->seo = json_decode($item->seo, true);
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
    }

    public function deleteItem($id)
    {

        $delete = $this->projects_model->delete(
            array(
                "id" => $id
            )
        );

        if ($delete) {

            /* Item'e ait görsellerin silinmesi start */
            $getImages = $this->projects_image_model->getAll(array("project_id" => $id), array());

            foreach ($getImages as $image){
                $delete = $this->projects_image_model->delete(
                    array(
                        "id" => $image->id
                    )
                );
                unlink("uploads/{$this->viewFolder}/$image->image_url");
            }
            /* Item'e ait görsellerin silinmesi end */

            $alert = array(
                "title"     => "İşlem başarılı!",
                "text"      => "Kayıt başarıyla silindi!",
                "type"      => "success",
                "position"  => "top-center"
            );
        } else {
            $alert = array(
                "title"     => "İşlem başarısız!",
                "text"      => "Kayıt silinirken bir hata oluştu, lütfen tekrar deneyin!",
                "type"      => "error",
                "position"  => "top-center"
            );
        }

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url('projects'));
    }

    public function deleteImage($id, $parent_id)
    {
        $fileName = $this->projects_image_model->get(
            array("id" => $id)
        );

        $delete = $this->projects_image_model->delete(
            array(
                "id" => $id
            )
        );

        if ($delete) {
        $alert = array(
            "title"     => "İşlem başarılı!",
            "text"      => "Görsel başarıyla silindi!",
            "type"      => "success",
            "position"  => "top-center"
        );
            unlink("uploads/{$this->viewFolder}/$fileName->image_url");
        } else {
            $alert = array(
                "title"     => "İşlem başarısız!",
                "text"      => "Görsel silinirken bir hata oluştu, lütfen tekrar deneyin!",
                "type"      => "error",
                "position"  => "top-center"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("projects/imageForm/$parent_id"));
    }

    public function isActiveSetter($id){

        if($id){
            $isActive = $this->input->post("data");
            if($isActive == "false"){
                $isActive = 0;
            }else{
                $isActive = 1;
            }

            $update = $this->projects_model->update(array("id" => $id), array("isActive" => $isActive));

        }

    }

    public function isCoverSetter($id, $parent_id){

        if($id && $parent_id){
            $isCover = $this->input->post("data");
            if($isCover == "false"){
                $isCover = 0;
            }else{
                $isCover = 1;
            }

            if($isCover = 0){
                $update = $this->projects_image_model->update(array("id" => $id, "project_id" => $parent_id), array("isCover" => 0));
                $update = $this->projects_image_model->update(array("id !=" => $id, "project_id" => $parent_id), array("isCover" => 1));
            }else{
                $update = $this->projects_image_model->update(array("id" => $id, "project_id" => $parent_id), array("isCover" => 1));
                $update = $this->projects_image_model->update(array("id !=" => $id, "project_id" => $parent_id), array("isCover" => 0));
            }

        }

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->itemImages = $this->projects_image_model->getAll(array("project_id" => $parent_id), "rank ASC");


        $renderHtml = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_view", $viewData, true);

        echo $renderHtml;

    }

    public function imageIsActiveSetter($id){

        if($id){
            $isActive = $this->input->post("data");
            if($isActive == "false"){
                $isActive = 0;
            }else{
                $isActive = 1;
            }

            $update = $this->projects_image_model->update(array("id" => $id), array("isActive" => $isActive));

        }

    }

    public function rankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id)
        {
            $this->projects_model->update(array("id" => $id, "rank !=" => $rank), array("rank" => $rank));
        }
    }

    public function imageRankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id)
        {
            $this->projects_image_model->update(array("id" => $id, "rank !=" => $rank), array("rank" => $rank));
        }
    }

    public function imageForm($id)
    {

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $item = $this->projects_model->get(
            array(
                "id" => $id
            )
        );

        $viewData->item = $item;
        $viewData->itemImages = $this->projects_image_model->getAll(array("project_id" => $id), "rank ASC");


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function imageUpload($id){


        $randName = rand(0,99999).$this->viewFolder;

        $config["allowed_types"] = "jpg|jpeg|png";
        $config["upload_path"] = "uploads/$this->viewFolder/";
        $config['file_name'] = $randName;

        $this->load->library('upload', $config);

        $upload = $this->upload->do_upload("file");

        if($upload){
            $data['image_url'] = $this->upload->data("file_name");
            $data['project_id'] = $id;

            $result = $this->projects_image_model->add($data);

        }else{
            echo "başarısız";
        }

    }

    public function refreshImageList($id){

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->itemImages = $this->projects_image_model->getAll(array("project_id" => $id), "rank ASC");


       $renderHtml = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_view", $viewData, true);

       echo $renderHtml;
    }

}
