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
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Menü İşlemleri', '/menu');

        $viewData = new stdClass();

        //Tablodan verilerin çekilmesi.
        $items = $this->menu_model->getAll(
            array("isSubmenu" => 0),
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
            $data['isSubmenu'] = $this->input->post('isSubmenu');
            $data['url'] = permalink($this->input->post('url'));
            if($data['isSubmenu'] == 0){
                $data['isMain'] = 1;
            }else{
                $data['isMain'] = 0;
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
        $viewData->submenus = $submenu;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function updateItem($id)
    {
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
            $data['isSubmenu'] = $this->input->post('isSubmenu');
            $data['url'] = permalink($this->input->post('url'));

            if($data['isSubmenu'] == 0){
                $data['isMain'] = 1;
            }else{
                $data['isMain'] = 0;
            }
//            if (!$data['url']) {
//                $data['url'] = permalink($this->input->post('title'));
//            }


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
            $viewData->submenus = $submenu;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
    }

    public function deleteItem($id)
    {
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
