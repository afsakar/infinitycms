<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public $viewFolder = "";
    public $tableName = "menu";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'menu_view';
        $this->load->model('menu_model');
        if(!get_active_user())
        {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        if(!permission("menu", "show")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Menü İşlemleri', '/menu');

        $viewData = new stdClass();
        /* Pagination Start */
        $config["base_url"] = base_url("$this->tableName/index");
        $config["total_rows"] = $this->menu_model->get_count();
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
        $items = $this->menu_model->get_records(
            array("isSubmenu" => 0),
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

        if(!permission("menu", "add")){
            redirect(base_url());
        }

        $items = $this->menu_model->getAll(
            array("isSubmenu" => 0),
            "rank ASC"
        );

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Menü İşlemleri', '/menu');
        $this->breadcrumbs->push('Menü Ekle','/');

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->items = $items;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function addItem()
    {
        if(!permission("menu", "add")){
            redirect(base_url());
        }

        $items = $this->menu_model->getAll(
            array("isSubmenu" => 0),
            "rank ASC"
        );

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Menü İşlemleri', '/menu');
        $this->breadcrumbs->push('Menü Ekle','/');

        $this->load->library("form_validation");

        $this->form_validation->set_rules("title", "Başlık", "required|is_unique[menu.title]|trim");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır",
            "is_unique" => "<strong>{field}</strong> alanında aynı isimde başka bir kayıt mevcut."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['title'] = $this->input->post('title');
            $data['content'] = htmlspecialchars($this->input->post('content'));
            $data['isSubmenu'] = $this->input->post('isSubmenu');
            $data['url'] = permalink($this->input->post('url'));
            $data['seo'] = json_encode($this->input->post('seo'), JSON_UNESCAPED_UNICODE);
            if($data['isSubmenu'] == 0){
                $data['isMain'] = 1;
            }else{
                $data['isMain'] = 0;
            }

            if (!$data['url']) {
                $data['url'] = permalink($this->input->post('title'));
            }

            if ($_FILES["img_url"]["name"] !== "") {
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
            }

            //Form verilerini kaydet
            $insert = $this->menu_model->add($data);
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
            redirect(base_url('menu'));

        } else {
            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->items = $items;
            $this->session->set_flashdata("formError", $viewData->formError = true);
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
    }

    public function updateForm($id){

        if(!permission("menu", "edit")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Menü İşlemleri', '/menu');
        $this->breadcrumbs->push('Menü Düzenle','/');

        $viewData = new stdClass();

        //Verilerin getirilmesi
        $item = $this->menu_model->get(
            array(
                "id" => $id
            )
        );

        $submenu = $this->menu_model->getAll(
            array("isSubmenu" => 0, "id !=" => $item->id),
            "rank ASC"
        );

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $viewData->seo = json_decode($item->seo, true);
        $viewData->submenus = $submenu;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function updateItem($id)
    {
        if(!permission("menu", "edit")){
            redirect(base_url());
        }

        $item = $this->menu_model->get(
            array(
                "id" => $id
            )
        );

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Menü İşlemleri', '/menu');
        $this->breadcrumbs->push('Menü Düzenle','/');
        //Form Validation
        $this->load->library("form_validation");

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['title'] = $this->input->post('title');
            $data['content'] = htmlspecialchars($this->input->post('content'));
            $data['isSubmenu'] = $this->input->post('isSubmenu');
            $data['isFooter'] = $this->input->post('isFooter');
            $data['url'] = permalink($this->input->post('url'));
            $data['seo'] = json_encode($this->input->post('seo'), JSON_UNESCAPED_UNICODE);

            if($data['isSubmenu'] == 0){
                $data['isMain'] = 1;
            }else{
                $data['isMain'] = 0;
            }
            if (!$data['url']) {
                $data['url'] = permalink($this->input->post('title'));
            }

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

                    redirect(base_url("menu/updateForm/$id"));

                    die();

                }

            }

            //Form verilerini güncelle
            $update = $this->menu_model->update(array("id" => $id), $data);
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
            redirect(base_url('menu'));

        } else {

            $viewData = new stdClass();

            //Verilerin getirilmesi
            $item = $this->menu_model->get(
                array(
                    "id" => $id
                )
            );

            $submenu = $this->menu_model->getAll(
                array("isSubmenu" => 0, "id !=" => $item->id),
                "rank ASC"
            );

            //View'e gönderilen verilerin set edilmesi.
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->formError = true;
            $viewData->item = $item;
            $viewData->seo = json_decode($item->seo, true);
            $viewData->submenus = $submenu;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
    }

    public function deleteItem($id)
    {
        if(!permission("menu", "delete")){
            redirect(base_url());
        }

        $getItem = $this->menu_model->get(array("id" => $id));

        $delete = $this->menu_model->delete(
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
        redirect(base_url('menu'));
    }

    public function isActiveSetter($id){

        if ($id) {
            $isActive = $this->input->post("data");
            if ($isActive == "false") {
                $isActive = 0;
            } else {
                $isActive = 1;
            }

            $update = $this->menu_model->update(array("id" => $id), array("isActive" => $isActive));

        }

    }

    public function rankSetter(){
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id) {
            $this->menu_model->update(array("id" => $id, "rank !=" => $rank, "isSubmenu" => 0), array("rank" => $rank));
        }
    }

}
