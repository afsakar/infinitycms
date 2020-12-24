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
        $this->load->model('projects_category_model');
        if(!get_active_user())
        {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        if(!permission("projects", "show")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Projeler', '/projects');
        $viewData = new stdClass();
        /* Pagination Start */
        $config["base_url"] = base_url("$this->tableName/index");
        $config["total_rows"] = $this->projects_model->get_count();
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
        $items = $this->projects_model->get_records(
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

        if(!permission("projects", "add")){
            redirect(base_url());
        }

        $category = $this->projects_category_model->getAll(array("isActive" => 1), "");

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Projeler', '/projects');
        $this->breadcrumbs->push('Proje Ekle','/');
        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->categories = $category;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function addItem()
    {
        if(!permission("projects", "add")){
            redirect(base_url());
        }

        $category = $this->projects_category_model->getAll(array("isActive" => 1), "");
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Projeler', '/projects');
        $this->breadcrumbs->push('Proje Ekle','/');

        //Form Validation
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Başlık", "required|is_unique[projects.title]|trim");
        $this->form_validation->set_rules("description", "Açıklama", "required");
        $this->form_validation->set_rules("projectDate", "Tarih", "required");
        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            "is_unique" => "<strong>{field}</strong> alanında başka bir kayıt mecvut."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['title'] = $this->input->post('title');
            $data['category_id'] = $this->input->post('category_id');
            $data['projectDate'] = $this->input->post('projectDate');
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
            $viewData->categories = $category;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
    }

    public function updateForm($id){

        if(!permission("projects", "edit")){
            redirect(base_url());
        }

        $category = $this->projects_category_model->getAll(array("isActive" => 1), "");

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Projeler', '/projects');
        $this->breadcrumbs->push('Proje Düzenle','/');
        $viewData = new stdClass();

        $items = $this->projects_model->get(
            array(
                "id" => $id
            )
        );

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $items;
        $viewData->categories = $category;
        $viewData->seo = json_decode($items->seo, true);
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function updateItem($id)
    {
        if(!permission("projects", "edit")){
            redirect(base_url());
        }

        $item = $this->projects_model->get(
            array(
                "id" => $id
            )
        );

        $category = $this->projects_category_model->getAll(array("isActive" => 1), "");

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Projeler', '/projects');
        $this->breadcrumbs->push('Proje Düzenle','/');
        //Form Validation
        $this->load->library("form_validation");
        if($this->input->post('title') != $item->title){
            $this->form_validation->set_rules("title", "Başlık", "required|is_unique[projects.title]|trim");
        }
        $this->form_validation->set_rules("description", "Açıklama", "required");
        $this->form_validation->set_rules("projectDate", "Tarih", "required");
        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            "is_unique" => "<strong>{field}</strong> alanında başka bir kayıt mecvut."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['title'] = $this->input->post('title');
            $data['category_id'] = $this->input->post('category_id');
            $data['projectDate'] = $this->input->post('projectDate');
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
            $viewData->categories = $category;
            $viewData->seo = json_decode($item->seo, true);
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
    }

    public function deleteItem($id)
    {
        if(!permission("projects", "delete")){
            redirect(base_url());
        }


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
        if(!permission("projects", "delete")){
            redirect(base_url());
        }

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
        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Projeler', '/projects');
        $this->breadcrumbs->push('Proje Görselleri','/');

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
        $viewData->breadcrumbs = $this->breadcrumbs->show();


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
            $alert = array(
                "title"     => "İşlem başarısız!",
                "text"      => "Görseller eklenirken bir hata oluştu, lütfen tekrar deneyin!",
                "type"      => "error",
                "position"  => "top-center"
            );
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

    //Kategoriler
    public function projects_category()
    {
        if(!permission("projects_category", "show")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Projeler', '/projects');
        $this->breadcrumbs->push('Proje Kategorileri', '/');
        $viewData = new stdClass();
        /* Pagination Start */
        $config["base_url"] = base_url("$this->tableName/projects_category");
        $config["total_rows"] = $this->projects_category_model->get_count();
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
        $items = $this->projects_category_model->get_records(
            array(),
            "",
            $config["per_page"],
            $page
        );

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "category";
        $viewData->subViewFolder2 = "list";
        $viewData->items = $items;
        $viewData->breadcrumbs = $this->breadcrumbs->show();


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/{$viewData->subViewFolder2}/index", $viewData);
    }

    public function categoryForm(){

        if(!permission("projects_category", "add")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Projeler', '/brands');
        $this->breadcrumbs->push('Proje Kategorileri','/projects_category');
        $this->breadcrumbs->push('Kategori Ekle','/');

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "category";
        $viewData->subViewFolder2 = "add";
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/{$viewData->subViewFolder2}/index", $viewData);

    }

    public function addCategory()
    {
        if(!permission("projects_category", "add")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Projeler', '/brands');
        $this->breadcrumbs->push('Proje Kategorileri','/projects_category');
        $this->breadcrumbs->push('Kategori Ekle','/');

        //Form Validation
        $this->load->library("form_validation");
        $this->form_validation->set_rules("category_name", "Kategori Adı", "required|is_unique[projects_category.category_name]|trim");
        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            "is_unique" => "<strong>{field}</strong> alanında aynı isimde bir kayıt mecvut."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['category_name'] = $this->input->post('category_name');

            //Form verilerini kaydet
            $insert = $this->projects_category_model->add($data);
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
            redirect(base_url('projects_category'));

        } else {

            $viewData = new stdClass();

            //View'e gönderilen verilerin set edilmesi.
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "category";
            $viewData->subViewFolder2 = "add";
            $viewData->form_error = true;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/{$viewData->subViewFolder2}/index", $viewData);

        }
    }

    public function categoryUpdate($id){

        if(!permission("projects_category", "edit")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Projeler', '/brands');
        $this->breadcrumbs->push('Proje Kategorileri','/projects_category');
        $this->breadcrumbs->push('Kategori Düzenle','/');

        $viewData = new stdClass();

        //Verilerin getirilmesi
        $item = $this->projects_category_model->get(
            array(
                "id" => $id
            )
        );

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "category";
        $viewData->subViewFolder2 = "update";
        $viewData->item = $item;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/{$viewData->subViewFolder2}/index", $viewData);

    }

    public function updateCategory($id)
    {
        if(!permission("projects_category", "edit")){
            redirect(base_url());
        }

        $this->breadcrumbs->unshift('Anasayfa', '/', false);
        $this->breadcrumbs->push('Projeler', '/brands');
        $this->breadcrumbs->push('Proje Kategorileri','/projects_category');
        $this->breadcrumbs->push('Kategori Düzenle','/');

        //Form Validation
        $this->load->library("form_validation");
        $this->form_validation->set_rules("category_name", "Kategori Adı", "required|is_unique[projects_category.category_name]|trim");
        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            "is_unique" => "<strong>{field}</strong> alanında aynı isimde bir kayıt mecvut."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if ($validate) {
            //Form'dan verileri al.
            $data['category_name'] = $this->input->post('category_name');

            //Form verilerini güncelle
            $update = $this->projects_category_model->update(array("id" => $id), $data);
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
            redirect(base_url('projects_category'));

        } else {

            $viewData = new stdClass();

            //Verilerin getirilmesi
            $item = $this->projects_category_model->get(
                array(
                    "id" => $id
                )
            );

            //View'e gönderilen verilerin set edilmesi.
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "category";
            $viewData->subViewFolder2 = "update";
            $viewData->form_error = true;
            $viewData->item = $item;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/{$viewData->subViewFolder2}/index", $viewData);

        }
    }

    public function isActiveCategory($id){

        if($id){
            $isActive = $this->input->post("data");
            if($isActive == "false"){
                $isActive = 0;
            }else{
                $isActive = 1;
            }

            $update = $this->projects_category_model->update(array("id" => $id), array("isActive" => $isActive));

        }

    }

    public function categoryDelete($id)
    {
        if(!permission("projects_category", "delete")){
            redirect(base_url());
        }


        $delete = $this->projects_category_model->delete(
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
        redirect(base_url('projects_category'));
    }


}
