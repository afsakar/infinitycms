<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "homepage";
        $this->load->model('data_model');
        $this->menus = $this->data_model->getAll("menu", array("isMain !=" => 0, "isActive" => 1), "rank ASC");
        $pageActive = $this->data_model->get("menu", array("url" => $this->uri->segment(1)));

    }

    public function index()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Haberler', '/news');

        $news = $this->data_model->getAll("news", array("isActive" => 1), "rank ASC");
        $page = $this->data_model->get("menu", array("isActive" => 1, "url" => "news"));

        if($page->isActive == 0){
            redirect(base_url());
        }

        $viewData = new stdClass();
        /* Pagination Start */
        $config["base_url"] = base_url("news/page/");
        $config["total_rows"] = $this->data_model->get_count("news", array());
        $config["uri_segment"] = 3;
        $config["per_page"] = 2;
        $config["num_links"] = 2;

        $config['full_tag_open'] = '<div class="cr-pagination text-center"><ul>';
        $config['full_tag_close'] = '</ul></div>';
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
        $kral = ($this->uri->segment(3)) ? $this->uri->segment(3): 0;
        $viewData->links = $this->pagination->create_links();
        /* Pagination End */

        $sayfa = $this->data_model->get_records("news", array("isActive" => 1), "rank ASC", $config["per_page"], $kral);

        $viewData->title = "Haberler";
        $viewData->viewFolder = "news_view";
        $viewData->controllerView = "news";
        $viewData->menus = $this->menus;
        $viewData->footerMenu = $this->data_model->getAll("menu", array("isActive" => 1, "isFooter" => 1), "rank ASC");
        $viewData->pages = $page;
        $viewData->news = $sayfa;
        $viewData->breadcrumbs = $this->breadcrumbs->show();
        $viewData->records = $this->db->where(array("isActive" => 1))->order_by("rank ASC")->limit(3)->get("news")->result();

        $this->load->view("$viewData->controllerView/index", $viewData);
    }

    public function page()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Haberler', '/news');

        $news = $this->data_model->getAll("news", array("isActive" => 1), "rank ASC");
        $page = $this->data_model->get("menu", array("isActive" => 1, "url" => "news"));

        if($page->isActive == 0){
            redirect(base_url());
        }

        $viewData = new stdClass();
        /* Pagination Start */
        $config["base_url"] = base_url("news/page/");
        $config["total_rows"] = $this->data_model->get_count("news", array());
        $config["uri_segment"] = 3;
        $config["per_page"] = 2;
        $config["num_links"] = 2;

        $config['full_tag_open'] = '<div class="cr-pagination text-center"><ul>';
        $config['full_tag_close'] = '</ul></div>';
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
        $kral = ($this->uri->segment(3)) ? $this->uri->segment(3): 0;
        $viewData->links = $this->pagination->create_links();
        /* Pagination End */

        $sayfa = $this->data_model->get_records("news", array("isActive" => 1), "rank ASC", $config["per_page"], $kral);

        $viewData->title = "Haberler";
        $viewData->viewFolder = "news_view";
        $viewData->controllerView = "news";
        $viewData->menus = $this->menus;
        $viewData->footerMenu = $this->data_model->getAll("menu", array("isActive" => 1, "isFooter" => 1), "rank ASC");
        $viewData->pages = $page;
        $viewData->news = $sayfa;
        $viewData->breadcrumbs = $this->breadcrumbs->show();
        $viewData->records = $this->db->where(array("isActive" => 1))->order_by("rank ASC")->limit(3)->get("news")->result();

        $this->load->view("$viewData->controllerView/index", $viewData);
    }

    public function newsDetail($url = "")
    {

        $news = $this->data_model->get("news", array("isActive" => 1, "url" => $url));
        $images = $this->data_model->getAll("news_images", array("isActive" => 1, "news_id" => $news->id), "rank ASC");

        if($news->isActive == 0){
            redirect(base_url("news"));
        }

        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Haberler', '/news');
        $this->breadcrumbs->push("$news->title", '/');

        $viewData = new stdClass();
        $viewData->title = "$news->title";
        $viewData->viewFolder = "news_view";
        $viewData->controllerView = "news";
        $viewData->menus = $this->menus;
        $viewData->footerMenu = $this->data_model->getAll("menu", array("isActive" => 1, "isFooter" => 1), "rank ASC");
        $viewData->comments = $this->data_model->getAll("comments", array("isActive" => 1, "news_id" => $news->id), "createdAt DESC");
        $viewData->comment_count = $this->db->where(array("isActive" => 1, "news_id" => $news->id))->order_by("createdAt DESC")->get("comments")->num_rows();
        $viewData->news = $news;
        $viewData->author = $this->data_model->get("users", array("id" => $news->user_id));
        $viewData->user = $user = get_active_user();
        $viewData->images = $images;
        $viewData->nextProje = $this->data_model->get("news", array("isActive" => 1, "rank >" => $news->rank));
        $viewData->prevProje = $this->data_model->get("news", array("isActive" => 1, "rank <" => $news->rank));
        $viewData->breadcrumbs = $this->breadcrumbs->show();
        $viewData->records = $this->db->where(array("isActive" => 1))->order_by("rank ASC")->limit(3)->get("news")->result();

        $this->load->view("$viewData->controllerView/detail", $viewData);
    }

    public function addComment($id){
        $user = get_active_user();

        $item = $this->data_model->get(
            "news",
            array(
                "id" => $id
            )
        );

        $this->load->library("form_validation");

        // Kurallar yazilir..
        if(!$user){
            $this->form_validation->set_rules("name", "Ad soyad", "required|trim");
            $this->form_validation->set_rules("email", "Email", "required|trim|valid_email");
        }
        $this->form_validation->set_rules("content", "Yorum", "required");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            "valid_email" => "Lütfen geçerli bir eposta adresi giriniz."
        ));

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){
            if($user){
                $data["name"] = $user->full_name;
                $data["email"] = $user->email;
                $data["user_id"] = $user->id;
                if(settings("user_comment") == 0){
                    $data["isActive"] = 1;
                }else{
                    $data["isActive"] = 0;
                }
            }else{
                $data["name"] = $this->input->post("name");
                $data["email"] = $this->input->post("email");
                $data["user_id"] = 0;
                if(settings("visitor_comment") == 0){
                    $data["isActive"] = 1;
                }else{
                    $data["isActive"] = 0;
                }
            }
        $data["content"] = $this->input->post("content");
        $data["news_id"] = $id;

        $insert = $this->data_model->add("comments", $data);

        if($insert){
            if($user){
                if(settings("user_comment") == 0){
                    $alert = array(
                        "title" => "Teşekkürler",
                        "text" => "Yorumunuz başarıyla eklendi!",
                        "type" => "success",
                        "position" => "top-right"
                    );
                }else{
                    $alert = array(
                        "title" => "Yorumunuz başarıyla eklendi!",
                        "text" => "Yorumunuz onaylandıktan sonra yayınlanacaktır!",
                        "type" => "success",
                        "position" => "top-right"
                    );
                }
            }else{
                if(settings("visitor_comment") == 0){
                    $alert = array(
                        "title" => "Teşekkürler",
                        "text" => "Yorumunuz başarıyla eklendi!",
                        "type" => "success",
                        "position" => "top-right"
                    );
                }else{
                    $alert = array(
                        "title" => "Yorumunuz başarıyla eklendi!",
                        "text" => "Yorumunuz onaylandıktan sonra yayınlanacaktır!",
                        "type" => "success",
                        "position" => "top-right"
                    );
                }
            }
            if(settings("comment_mail") == 1){
                $message = "Yorum yapan: ".$data["name"]." (".$data["email"].")<br><br>Konu: ".$item->title."<br><br>Yorum: <br><br>".$data["content"];
                comment_mail($item->title, $message);
            }
        }else{
            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Yorumunuz eklenirken bir problem oluştu",
                "type" => "error",
                "position" => "top-right"
            );
        }
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("news/$item->url"));

        }else{

            $news = $this->data_model->get("news", array("isActive" => 1, "id" => $id));
            $images = $this->data_model->getAll("news_images", array("isActive" => 1, "news_id" => $news->id), "rank ASC");

            if($news->isActive == 0){
                redirect(base_url("news"));
            }

            $this->breadcrumbs->unshift('Anasayfa', '/');
            $this->breadcrumbs->push('Haberler', '/news');
            $this->breadcrumbs->push("$news->title", '/');

            $viewData = new stdClass();
            $viewData->title = "$news->title";
            $viewData->viewFolder = "news_view";
            $viewData->controllerView = "news";
            $viewData->menus = $this->menus;
            $viewData->footerMenu = $this->data_model->getAll("menu", array("isActive" => 1, "isFooter" => 1), "rank ASC");
            $viewData->comments = $this->data_model->getAll("comments", array("isActive" => 1, "news_id" => $news->id), "createdAt DESC");
            $viewData->comment_count = $this->db->where(array("isActive" => 1, "news_id" => $news->id))->order_by("createdAt DESC")->get("comments")->num_rows();
            $viewData->news = $news;
            $viewData->author = $this->data_model->get("users", array("id" => $news->user_id));
            $viewData->user = $user = get_active_user();
            $viewData->images = $images;
            $viewData->form_error = true;
            $viewData->nextProje = $this->data_model->get("news", array("isActive" => 1, "rank >" => $news->rank));
            $viewData->prevProje = $this->data_model->get("news", array("isActive" => 1, "rank <" => $news->rank));
            $viewData->breadcrumbs = $this->breadcrumbs->show();
            $viewData->records = $this->db->where(array("isActive" => 1))->order_by("rank ASC")->limit(3)->get("news")->result();

            $this->load->view("$viewData->controllerView/detail", $viewData);

        }
    }
}