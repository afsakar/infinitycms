<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    public $viewFolder = "";
    public $tableName = "news";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'news_view';
        $this->load->model('news_model');
        $this->load->model('news_image_model');
    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin çekilmesi.
        $items = $this->news_model->getAll(
            array(),
            "rank ASC"
        );

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function addForm(){
        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function addItem()
    {

        $this->load->library("form_validation");
        $news_type = $this->input->post("news_type");

        if ($news_type == "image") {
            if ($_FILES["img_url"]["name"] == "") {
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Lütfen bir görsel seçiniz!",
                    "type" => "error",
                    "position" => "top-center"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url('news/addForm'));
            }
        } elseif ($news_type == "video") {
            $this->form_validation->set_rules("video_url", "Video URL", "required|trim");
        }

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
            $data['news_type'] = $news_type;
            $data['url'] = permalink($this->input->post('url'));

            if (!$data['url']) {
                $data['url'] = permalink($this->input->post('title'));
            }

            if ($news_type == "image") {

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

            } elseif ($news_type == "video") {
                $data['video_url'] = $this->input->post('video_url');
            }

            //Form verilerini kaydet
            $insert = $this->news_model->add($data);
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
            redirect(base_url('news'));

        } else {
            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $this->session->set_flashdata("formError", $viewData->formError = true);
            $viewData->news_type = $news_type;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
    }

    public function updateForm($id){

        $viewData = new stdClass();

        //Verilerin getirilmesi
        $item = $this->news_model->get(
            array(
                "id" => $id
            )
        );


        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $viewData->news_type = $item->news_type;
        $viewData->seo = json_decode($item->seo, true);

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function updateItem($id){

        $item = $this->news_model->get(
            array(
                "id" => $id
            )
        );

        $this->load->library("form_validation");

        // Kurallar yazilir..

        $news_type = $this->input->post("news_type");

        if ($news_type == "video") {

            $this->form_validation->set_rules("video_url", "Video URL", "required|trim");

        }

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("description", "Açıklama", "required");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if ($validate) {

            $data['title'] = $this->input->post('title');
            $data['description'] = htmlspecialchars($this->input->post('description'));
            $data['seo'] = json_encode($this->input->post('seo'), JSON_UNESCAPED_UNICODE);
            $data['news_type'] = $news_type;
            $data['url'] = permalink($this->input->post('url'));

            if (!$data['url']) {
                $data['url'] = permalink($this->input->post('title'));
            }

            if ($news_type == "image") {

                // Upload Süreci...


                if ($_FILES["img_url"]["name"] !== "") {
            //TODO eğer foto boş ise resim seçilmiş isse
                    $file_name = rand(0, 99999) . $this->viewFolder;

                    $config["allowed_types"] = "jpg|jpeg|png";
                    $config["upload_path"] = "uploads/$this->viewFolder/";
                    $config["file_name"] = $file_name;

                    $this->load->library("upload", $config);

                    $upload = $this->upload->do_upload("img_url");

                    if ($upload) {

                        $data['img_url'] = $this->upload->data("file_name");
                        $data['video_url'] = "";
                        unlink("uploads/{$this->viewFolder}/$item->img_url");

                    } else {

                        $alert = array(
                            "title" => "İşlem başarısız!",
                            "text" => "Görsel yüklenirken bir problem oluştu!",
                            "type" => "error",
                            "position" => "top-center"
                        );

                        $this->session->set_flashdata("alert", $alert);

                        redirect(base_url("news/updateForm/$id"));

                        die();

                    }

                } else {

                    $alert = array(
                        "title" => "İşlem başarısız!",
                        "text" => "Lütfen görsel seçiniz!",
                        "type" => "error",
                        "position" => "top-center"
                    );

                    $this->session->set_flashdata("alert", $alert);

                    redirect(base_url("news/updateForm/$id"));

                }

            } else if ($news_type == "video") {
                $data['video_url'] = $this->input->post('video_url');
                $data['img_url'] = "";
                unlink("uploads/{$this->viewFolder}/$item->img_url");

            }

            $update = $this->news_model->update(array("id" => $id), $data);

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

            redirect(base_url("news"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->news_type = $news_type;

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->news_model->get(
                array(
                    "id" => $id,
                )
            );
            $viewData->seo = json_decode($item->seo, true);

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function deleteItem($id)
    {
        $getItem = $this->news_model->get(array("id" => $id));

        $delete = $this->news_model->delete(
            array(
                "id" => $id
            )
        );

        if ($delete) {
            unlink("uploads/{$this->viewFolder}/$getItem->img_url");
            /* Item'e ait görsellerin silinmesi start */
            $getImages = $this->news_image_model->getAll(array("news_id" => $id), array());

            foreach ($getImages as $image) {
                $delete = $this->news_image_model->delete(
                    array(
                        "id" => $image->id
                    )
                );
                unlink("uploads/{$this->viewFolder}/$image->image_url");
            }
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
        redirect(base_url('news'));
    }

    public function deleteImage($id, $parent_id)
    {
        $fileName = $this->news_image_model->get(
            array("id" => $id)
        );

        $delete = $this->news_image_model->delete(
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
        redirect(base_url("news/imageForm/$parent_id"));
    }

    public function isActiveSetter($id){

        if ($id) {
            $isActive = $this->input->post("data");
            if ($isActive == "false") {
                $isActive = 0;
            } else {
                $isActive = 1;
            }

            $update = $this->news_model->update(array("id" => $id), array("isActive" => $isActive));

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
                $update = $this->news_image_model->update(array("id" => $id, "news_id" => $parent_id), array("isCover" => 0));
                $update = $this->news_image_model->update(array("id !=" => $id, "news_id" => $parent_id), array("isCover" => 1));
            } else {
                $update = $this->news_image_model->update(array("id" => $id, "news_id" => $parent_id), array("isCover" => 1));
                $update = $this->news_image_model->update(array("id !=" => $id, "news_id" => $parent_id), array("isCover" => 0));
            }

        }

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->itemImages = $this->news_image_model->getAll(array("news_id" => $parent_id), "rank ASC");


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

            $update = $this->news_image_model->update(array("id" => $id), array("isActive" => $isActive));

        }

    }

    public function rankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id) {
            $this->news_model->update(array("id" => $id, "rank !=" => $rank), array("rank" => $rank));
        }
    }

    public function imageRankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id) {
            $this->news_image_model->update(array("id" => $id, "rank !=" => $rank), array("rank" => $rank));
        }
    }

    public function imageForm($id)
    {

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $item = $this->news_model->get(
            array(
                "id" => $id
            )
        );

        $viewData->item = $item;
        $viewData->itemImages = $this->news_image_model->getAll(array("news_id" => $id), "rank ASC");


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
            $data['news_id'] = $id;

            $result = $this->news_image_model->add($data);

        } else {
            echo "başarısız";
        }

    }

    public function refreshImageList($id){

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->itemImages = $this->news_image_model->getAll(array("news_id" => $id), "rank ASC");


        $renderHtml = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_view", $viewData, true);

        echo $renderHtml;
    }

}
