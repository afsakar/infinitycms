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
    }

    public function index()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $viewData = new stdClass();

        //Tablodan verilerin çekilmesi.
        $items = $this->galleries_model->getAll(
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
        $config['file_name'] = $randName;

        if($item->gallery_type == "image"){
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
            $result = $this->galleries_image_model->add($data);
        } else {
            echo "başarısız";
        }

    }

    public function deleteImage($id, $parent_id)
    {
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

        //Tablodan verilerin çekilmesi.
        $items = $this->galleries_image_model->getAll(
            array("gallery_type" => "video", "gallery_id" => $id),
            "rank ASC"
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
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $this->breadcrumbs->push('Video Ekle','/');

        //Form Validation
        $this->load->library("form_validation");
        $this->form_validation->set_rules("url", "URL", "required|trim");
        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['url'] = $this->input->post('url');
            $data['gallery_id'] = $id;
            $data['gallery_type'] = "video";

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
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Galeriler', '/galleries');
        $this->breadcrumbs->push('Video Düzenle','/');
        //Form Validation
        $this->load->library("form_validation");
        $this->form_validation->set_rules("url", "URL", "required|trim");

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['url'] = $this->input->post('url');

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

        $delete = $this->galleries_image_model->delete(
            array(
                "id" => $id
            )
        );

        if ($delete) {
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
