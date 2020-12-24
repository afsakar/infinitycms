<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galleries extends CI_Controller
{
    public $viewFolder = "";
    public $tableName = "galleries";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'galleries_view';
        $this->load->model('galleries_model');
        $this->load->model('galleries_image_model');
        if(!get_active_user())
        {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        if(!permission("galleries", "show")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $viewData = new stdClass();
        /* Pagination Start */
        $config["base_url"] = base_url("$this->tableName/index");
        $config["total_rows"] = $this->galleries_model->get_count();
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
        $items = $this->galleries_model->get_records(
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

        if(!permission("galleries", "add")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $this->breadcrumbs->push('Galeri Ekle', '/');
        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function addItem()
    {
        if(!permission("galleries", "add")){
            redirect(base_url());
        }

        /* Breadcrumbs bilgileri start */
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $this->breadcrumbs->push('Galeri Ekle', '/');
        /* Breadcrumbs bilgileri end */

        /* Form validation start */
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Galeri Adı", "required|trim");
        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));
        $validate = $this->form_validation->run();
        /* Form validation end */


        if ($validate) {

            //Form'dan verileri al.
            $data['title'] = $this->input->post('title');
            $data['gallery_type'] = $this->input->post('gallery_type');
            $data['folder_name'] = permalink($this->input->post('folder_name'));
            $data['seo'] = json_encode($this->input->post('seo'), JSON_UNESCAPED_UNICODE);
            $data['url'] = permalink($this->input->post('url'));

            /* URL kontrolü */
            if (!$data['url']) {
                $data['url'] = permalink($this->input->post('title'));
            }

            /* Klasör adı kontrolü start */
            if (!$data['folder_name']) {
                $data['folder_name'] = permalink($this->input->post('title'));
            }

            //Tablodan aynı klasör adında ve aynı galeri türündeki kayıtları getir.
            $folder = $this->galleries_model->getAll(array("folder_name" => $data['folder_name'], "gallery_type" => $data['gallery_type']), array());
            if (!empty($folder)) {
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Aynı klasör adında bir kayıt mevcut, lütfen klasör adını kontrol edin!",
                    "type" => "error",
                    "position" => "top-center"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url('galleries/addForm'));
                exit;
            } else {
                if (!$data['folder_name']) {
                    $data['folder_name'] = permalink($this->input->post('title'));
                }
            }
            /* Klasör adı kontrolü end */

            /* Klasör oluştur start */
            $type = $data['gallery_type'];
            $path = "uploads/$this->viewFolder/";
            $folder_name = $data['folder_name'];

            if ($type == "image") {
                $path = "$path/image/$folder_name";
                $newFolder = mkdir($path, 0755);
            } elseif ($type == "file") {
                $path = "$path/file/$folder_name";
                $newFolder = mkdir($path, 0755);
            }

            //Klasör oluşturma izin kontrolü
            if ($type != "video") {
                if (!$newFolder) {
                    $alert = array(
                        "title" => "İşlem başarısız!",
                        "text" => "Klasör oluşturulurken bir hata oluştu, lütfen tekrar deneyin! (Yetki Hatası!)",
                        "type" => "error",
                        "position" => "top-center"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url('galleries'));
                }
            }
            /* Klasör oluştur end */

            /* Form verilerini kaydet start */
            $insert = $this->galleries_model->add($data);
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
            redirect(base_url('galleries'));

            /* Form verilerini kaydet end */


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

    public function updateForm($id){

        if(!permission("galleries", "edit")){
            redirect(base_url());
        }

        /* Breadcrumbs bilgileri start */
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $this->breadcrumbs->push('Galeri Düzenle', '/');
        /* Breadcrumbs bilgileri end */

        $viewData = new stdClass();

        //Verilerin getirilmesi
        $item = $this->galleries_model->get(
            array(
                "id" => $id
            )
        );

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $viewData->seo = json_decode($item->seo, true);
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function updateItem($id)
    {
        if(!permission("galleries", "edit")){
            redirect(base_url());
        }

        /* Tablodan verileri çek start */
        $item = $this->galleries_model->get(array("id" => $id));
        /* Tablodan verileri çek end */

        /* Breadcrumbs bilgileri start */
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $this->breadcrumbs->push('Galeri Düzenle', '/');
        /* Breadcrumbs bilgileri end */

        /* Form validation start */
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Galeri Adı", "required|trim");
        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));
        $validate = $this->form_validation->run();
        /* Form validation end */

        /* Form verilerini kontrol et start */
        if ($validate) {

            //Form'dan verileri al.
            $data['title'] = $this->input->post('title');
            $data['gallery_type'] = $item->gallery_type;
            $data['folder_name'] = permalink($this->input->post('folder_name'));
            $data['seo'] = json_encode($this->input->post('seo'), JSON_UNESCAPED_UNICODE);
            $data['url'] = permalink($this->input->post('url'));

            /* URL kontrolü */
            if (!$data['url']) {
                $data['url'] = permalink($this->input->post('title'));
            }

            /* Klasör adı kontrolü start */
            if (!$data['folder_name']) {
                $data['folder_name'] = permalink($this->input->post('title'));
            }

            //Tablodan aynı klasör adında ve aynı galeri türündeki kayıtları getir.
            $folder = $this->galleries_model->getAll(array("folder_name" => $data['folder_name'], "gallery_type" => $data['gallery_type']), array());
            if (!empty($folder)) {
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Aynı klasör adında bir kayıt mevcut, lütfen klasör adını kontrol edin!",
                    "type" => "error",
                    "position" => "top-center"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url('galleries/addForm'));
                die();
            } else {
                if (!$data['folder_name']) {
                    $data['folder_name'] = permalink($this->input->post('title'));
                }
            }
            /* Klasör adı kontrolü end */

            /* Klasör oluştur start */
            $type = $data['gallery_type'];
            $path = "uploads/$this->viewFolder/";
            $folder_name = $data['folder_name'];

            /* Galeri tipini kontrol et start */
            if($type == $item->gallery_type && $type == "image"){
                /* Klasör adı değişmiş mi? start */
                if($item->folder_name != $folder_name){
                    rename("$path/image/$item->folder_name", "$path/image/$folder_name");
                }else{
                    $item->folder_name = $data['folder_name'];
                }
                /* Klasör adı değişmiş mi? end */
            }elseif($type == $item->gallery_type && $type == "file"){
                /* Klasör adı değişmiş mi? start */
                if($item->folder_name != $folder_name){
                    rename("$path/file/$item->folder_name", "$path/file/$folder_name");
                }else{
                    $item->folder_name = $data['folder_name'];
                }
            }
            /* Galeri tipini kontrol et end */


//            if ($type == "image") {
//                $path = "$path/images/$folder_name";
//                $newFolder = mkdir($path, 0755);
//            } elseif ($type == "file") {
//                $path = "$path/files/$folder_name";
//                $newFolder = mkdir($path, 0755);
//            }
//
//            //Klasör oluşturma izin kontrolü
//            if ($type != "video") {
//                if (!$newFolder) {
//                    $alert = array(
//                        "title" => "İşlem başarısız!",
//                        "text" => "Klasör oluşturulurken bir hata oluştu, lütfen tekrar deneyin! (Yetki Hatası!)",
//                        "type" => "error",
//                        "position" => "top-center"
//                    );
//                    $this->session->set_flashdata("alert", $alert);
//                    redirect(base_url('galleries'));
//                }
//            }
//            /* Klasör oluştur end */

            /* Form verilerini güncelle start */
            $update = $this->galleries_model->update(array("id" => $id), $data);
            if ($update) {
                $alert = array(
                    "title" => "İşlem başarılı!",
                    "text" => "Kayıt başarıyla güncellendi!",
                    "type" => "success",
                    "position" => "top-center"
                );
            } else {
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Kayıt güncellenirken bir hata oluştu, lütfen tekrar deneyin!",
                    "type" => "error",
                    "position" => "top-center"
                );
            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url('galleries'));
            /* Form verilerini güncelle end */

        } else {

            $viewData = new stdClass();

            //Verilerin getirilmesi
            $item = $this->galleries_model->get(
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
        if(!permission("galleries", "delete")){
            redirect(base_url());
        }

        $item = $this->galleries_model->get(array("id" => $id));
        $delete = $this->galleries_model->delete(
            array(
                "id" => $id
            )
        );

        if ($delete) {

            $type = $item->gallery_type;
            $path = "uploads/$this->viewFolder/";
            $folder_name = $item->folder_name;

            if ($type == "image") {
                $path = "$path/images/$folder_name";
                rmdir($path);
            } elseif ($type == "file") {
                $path = "$path/files/$folder_name";
                rmdir($path);
            }

            /* Item'e ait görsellerin silinmesi start */
//            $getImages = $this->galleries_image_model->getAll(array("project_id" => $id), array());
//
//            foreach ($getImages as $image) {
//                $delete = $this->galleries_image_model->delete(
//                    array(
//                        "id" => $image->id
//                    )
//                );
//                unlink("uploads/{$this->viewFolder}/$image->image_url");
//            }
            /* Item'e ait görsellerin silinmesi end */

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
        redirect(base_url('galleries'));
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

            $update = $this->galleries_model->update(array("id" => $id), array("isActive" => $isActive));

        }

    }

    public function rankSetter()
    {
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id) {
            $this->galleries_model->update(array("id" => $id, "rank !=" => $rank), array("rank" => $rank));
        }
    }

    public function isCoverSetter($id, $parent_id)
    {

        if ($id && $parent_id) {
            $isCover = $this->input->post("data");
            if ($isCover == "false") {
                $isCover = 0;
            } else {
                $isCover = 1;
            }

            if ($isCover = 0) {
                $update = $this->galleries_image_model->update(array("id" => $id, "project_id" => $parent_id), array("isCover" => 0));
                $update = $this->galleries_image_model->update(array("id !=" => $id, "project_id" => $parent_id), array("isCover" => 1));
            } else {
                $update = $this->galleries_image_model->update(array("id" => $id, "project_id" => $parent_id), array("isCover" => 1));
                $update = $this->galleries_image_model->update(array("id !=" => $id, "project_id" => $parent_id), array("isCover" => 0));
            }

        }

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->itemImages = $this->galleries_image_model->getAll(array("project_id" => $parent_id), "rank ASC");


        $renderHtml = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_view", $viewData, true);

        echo $renderHtml;

    }

    /* Resim ve dosya işlemleri start */

    public function imageIsActiveSetter($id)
    {
        if ($id) {

            $isActive = $this->input->post("data");
            if ($isActive == "false") {
                $isActive = 0;
            } else {
                $isActive = 1;
            }
            $item = $this->galleries_image_model->get(array("id" => $id));
            $kral = $this->galleries_model->get(array("id" => $item->gallery_id));
            if($kral->gallery_type == "image"){
                $update = $this->galleries_image_model->update(array("id" => $id), array("isActive" => $isActive));
            }elseif($kral->gallery_type == "file"){
                $update = $this->galleries_image_model->update(array("id" => $id), array("isActive" => $isActive));
            }else{
                $update = $this->galleries_image_model->update(array("id" => $id), array("isActive" => $isActive));
            }

        }

    }

    public function imageRankSetter()
    {
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id) {
            $this->galleries_image_model->update(array("id" => $id, "rank !=" => $rank), array("rank" => $rank));
        }
    }

    public function imageForm($id)
    {

        /* Breadcrumbs bilgileri start */
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $this->breadcrumbs->push('Galeri Dosyaları', '/');
        /* Breadcrumbs bilgileri end */

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $item = $this->galleries_model->get(
            array(
                "id" => $id
            )
        );

        $viewData->item = $item;
        if($item->gallery_type == "image"){
            $viewData->itemImages = $this->galleries_image_model->getAll(array("gallery_id" => $id, "gallery_type" => $item->gallery_type), "rank ASC");
        }elseif($item->gallery_type == "file"){
            $viewData->itemImages = $this->galleries_image_model->getAll(array("gallery_id" => $id, "gallery_type" => $item->gallery_type), "rank ASC");
        }else{
            $viewData->itemImages = $this->galleries_image_model->getAll(array("gallery_id" => $id, "gallery_type" => $item->gallery_type), "rank ASC");
        }


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function imageUpload($id)
    {
        $item = $this->galleries_model->get(
            array(
                "id" => $id
            )
        );

        $randName = $item->gallery_type.'-'.rand(0, 99999);

        if($item->gallery_type == "image"){
            $config['file_name'] = $randName;
            $config["allowed_types"] = "jpg|jpeg|png|svg|gif";
            $config["upload_path"] = "uploads/$this->viewFolder/$item->gallery_type/$item->folder_name";
            $this->load->library('upload', $config);
            $upload = $this->upload->do_upload("file");
        }elseif($item->gallery_type == "file"){
            $config["allowed_types"] = "jpg|jpeg|png|pdf|doc|docx|ai|avi|css|dwg|html|js|json|mp3|mp4|ppt|psd|svg|txt|xls|xlsx|xml|zip|rar|tzg|xlsm";
            $config["upload_path"] = "uploads/$this->viewFolder/$item->gallery_type/$item->folder_name";
            $this->load->library('upload', $config);
            $upload = $this->upload->do_upload("file");
        }
        if ($upload) {
            $data['url'] = $config["upload_path"].'/'.$this->upload->data("file_name");
            $data['gallery_id'] = $id;
            $data['gallery_type'] = $item->gallery_type;
            $data['file_name'] = end(explode("/", $data["url"]));
            $result = $this->galleries_image_model->add($data);
        } else {
            echo "başarısız";
        }

    }

    public function deleteImage($id, $parent_id)
    {
        if(!permission("galleries", "delete")){
            redirect(base_url());
        }

        $fileName = $this->galleries_image_model->get(
            array("id" => $id)
        );

        $delete = $this->galleries_image_model->delete(
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
            unlink("$fileName->url");
        } else {
            $alert = array(
                "title" => "İşlem başarısız!",
                "text" => "Görsel silinirken bir hata oluştu, lütfen tekrar deneyin!",
                "type" => "error",
                "position" => "top-center"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("galleries/imageForm/$parent_id"));
    }

    public function refreshImageList($id, $type)
    {

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        if($type === "image"){
            $viewData->itemImages = $this->galleries_image_model->getAll(array("gallery_id" => $id), "rank ASC");
        }elseif($type === "file"){
            $viewData->itemImages = $this->galleries_image_model->getAll(array("gallery_id" => $id), "rank ASC");
        }else{
            $viewData->itemImages = $this->galleries_image_model->getAll(array("gallery_id" => $id), "rank ASC");
        }

        $renderHtml = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_view", $viewData, true);

        echo $renderHtml;
    }

    /* Video işlemleri start */

    public function videos($id)
    {
        $this->breadcrumbs->unshift('Anasayfa', '/', true);
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $this->breadcrumbs->push('Videolar', '/');
        $viewData = new stdClass();

        /* Pagination Start */
        $config["base_url"] = base_url("$this->tableName/videos/$id");
        $config["total_rows"] = $this->galleries_image_model->get_count(array("gallery_id"=>$id));
        $config["uri_segment"] = 4;
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4): 0;
        $viewData->links = $this->pagination->create_links();
        /* Pagination End */

        //Tablodan verilerin çekilmesi.
        $items = $this->galleries_image_model->get_records(
            array("gallery_type" => "video", "gallery_id" => $id),
            "rank ASC",
            $config["per_page"],
            $page
        );

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video";
        $viewData->subViewFolder2 = "list";
        $viewData->items = $items;
        $viewData->id = $id;
        $viewData->breadcrumbs = $this->breadcrumbs->show();


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/{$viewData->subViewFolder2}/index", $viewData);
    }

    public function addVideoForm($id){

        if(!permission("galleries", "add")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $this->breadcrumbs->push('Video Ekle','/');
        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video";
        $viewData->subViewFolder2 = "add";
        $viewData->id = $id;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/{$viewData->subViewFolder2}/index", $viewData);

    }

    public function addVideo($id)
    {
        if(!permission("galleries", "add")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $this->breadcrumbs->push('Video Ekle','/');

        //Form Validation
        $this->load->library("form_validation");

        if ($_FILES["video_cover"]["name"] == "") {
            $alert = array(
                "title" => "İşlem başarısız!",
                "text" => "Lütfen bir görsel seçiniz!",
                "type" => "error",
                "position" => "top-center"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("galleries/addVideoForm/$id"));
        }

        $this->form_validation->set_rules("url", "URL", "required|trim");
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['url'] = $this->input->post('url');
            $data['gallery_id'] = $id;
            $data['file_name'] = $this->input->post('title');
            $data['gallery_type'] = "video";

            $randName = rand(0, 99999) . $this->viewFolder;

            $config["allowed_types"] = "jpg|jpeg|png";
            $config["upload_path"] = "uploads/$this->viewFolder/video/";
            $config['file_name'] = $randName;

            $this->load->library('upload', $config);

            $upload = $this->upload->do_upload("video_cover");

            if ($upload) {
                $data['video_cover'] = $this->upload->data("file_name");
            } else {
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Görsel yüklenirken bir hata oluştu, lütfen tekrar deneyin!",
                    "type" => "error",
                    "position" => "top-center"
                );
            }

            //Form verilerini kaydet
            $insert = $this->galleries_image_model->add($data);
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
            redirect(base_url("galleries/videos/$id"));

        } else {

            $viewData = new stdClass();

            //View'e gönderilen verilerin set edilmesi.
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "video";
            $viewData->subViewFolder2 = "add";
            $viewData->form_error = true;
            $viewData->id = $id;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/{$viewData->subViewFolder2}/index", $viewData);

        }
    }

    public function updateVideoForm($id, $parent_id){

        if(!permission("galleries", "edit")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $this->breadcrumbs->push('Video Düzenle','/');

        //Verilerin getirilmesi
        $item = $this->galleries_image_model->get(
            array(
                "id" => $id
            )
        );

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video";
        $viewData->subViewFolder2 = "update";
        $viewData->id = $parent_id;
        $viewData->item = $item;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/{$viewData->subViewFolder2}/index", $viewData);

    }

    public function updateVideo($id, $parent_id)
    {
        if(!permission("galleries", "edit")){
            redirect(base_url());
        }

        $item = $this->galleries_image_model->get(
            array(
                "id" => $id
            )
        );

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $this->breadcrumbs->push('Video Düzenle','/');
        //Form Validation
        $this->load->library("form_validation");
        $this->form_validation->set_rules("url", "URL", "required|trim");
        $this->form_validation->set_rules("title", "Başlık", "required|trim");

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['url'] = $this->input->post('url');
            $data['file_name'] = $this->input->post('title');

            // Upload Süreci...
            if ($_FILES["video_cover"]["name"] !== "") {

                $file_name = rand(0, 99999) . $this->viewFolder;

                $config["allowed_types"] = "jpg|jpeg|png";
                $config["upload_path"] = "uploads/$this->viewFolder/video/";
                $config["file_name"] = $file_name;

                $this->load->library("upload", $config);

                $upload = $this->upload->do_upload("video_cover");

                if ($upload) {

                    $data['video_cover'] = $this->upload->data("file_name");
                    unlink("uploads/{$this->viewFolder}/video/$item->video_cover");

                } else {

                    $alert = array(
                        "title" => "İşlem başarısız!",
                        "text" => "Görsel yüklenirken bir problem oluştu!",
                        "type" => "error",
                        "position" => "top-center"
                    );

                    $this->session->set_flashdata("alert", $alert);

                    redirect(base_url("galleries/videos/$parent_id"));

                    die();

                }

            }

            //Form verilerini güncelle
            $update = $this->galleries_image_model->update(array("id" => $id), $data);
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
            redirect(base_url("galleries/videos/$parent_id"));

        } else {

            $viewData = new stdClass();

            //Verilerin getirilmesi
            $item = $this->galleries_image_model->get(
                array(
                    "id" => $id
                )
            );

            //View'e gönderilen verilerin set edilmesi.
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "video";
            $viewData->subViewFolder2 = "update";
            $viewData->form_error = true;
            $viewData->item = $item;
            $viewData->id = $parent_id;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/{$viewData->subViewFolder2}/index", $viewData);

        }
    }

    public function deleteVideo($id, $parent_id)
    {
        if(!permission("galleries", "delete")){
            redirect(base_url());
        }
        $getItem = $this->galleries_image_model->get(array("id" => $id));
        $delete = $this->galleries_image_model->delete(
            array(
                "id" => $id
            )
        );

        if ($delete) {
            unlink("uploads/{$this->viewFolder}/video/$getItem->video_cover");
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
        redirect(base_url("galleries/videos/$parent_id"));
    }

    public function videoActiveSetter($id)
    {

        if ($id) {
            $isActive = $this->input->post("data");
            if ($isActive == "false") {
                $isActive = 0;
            } else {
                $isActive = 1;
            }

            $update = $this->galleries_image_model->update(array("id" => $id), array("isActive" => $isActive));

        }

    }

    public function videoRankSetter($parent_id)
    {
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id) {
            $this->galleries_image_model->update(array("id" => $id, "rank !=" => $rank, "gallery_id" => $parent_id), array("rank" => $rank));
        }
    }

}
