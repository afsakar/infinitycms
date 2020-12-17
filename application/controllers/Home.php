<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "homepage";
        $this->load->model('data_model');
        $this->menus = $this->data_model->getAll("menu", array("isMain !=" => 0, "isActive" => 1), "rank ASC");
    }

    public function index()
    {
        $viewData = new stdClass();
        $viewData->title = "";
        $viewData->menus = $this->menus;

        $this->load->view("homepage", $viewData);
    }

    //Projeler
    public function projectsList()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Projeler', '/projects');

        $categories = $this->data_model->getAll("projects_category", array("isActive" => 1), "");
        $projects = $this->data_model->getAll("projects", array("isActive" => 1), "rank ASC");
        $page = $this->data_model->get("menu", array("isActive" => 1, "url" => "projects"));

        $viewData = new stdClass();
        $viewData->title = "Projeler";
        $viewData->viewFolder = "projects_view";
        $viewData->controllerView = "projects";
        $viewData->menus = $this->menus;
        $viewData->categories = $categories;
        $viewData->pages = $page;
        $viewData->projects = $projects;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("$viewData->controllerView/index", $viewData);
    }

    public function projectDetail($url = "")
    {

        $projects = $this->data_model->get("projects", array("isActive" => 1, "url" => $url));
        $categories = $this->data_model->get("projects_category", array("isActive" => 1, "id" => $projects->category_id));
        $images = $this->data_model->getAll("project_images", array("isActive" => 1, "project_id" => $projects->id, "isCover" => 0), "rank ASC");

        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Projeler', '/projects');
        $this->breadcrumbs->push("$projects->title", '/');

        $viewData = new stdClass();
        $viewData->title = "$projects->title";
        $viewData->viewFolder = "projects_view";
        $viewData->controllerView = "projects";
        $viewData->menus = $this->menus;
        $viewData->categories = $categories;
        $viewData->project = $projects;
        $viewData->images = $images;
        $viewData->nextProje = $this->data_model->get("projects", array("isActive" => 1, "rank >" => $projects->rank));
        $viewData->prevProje = $this->data_model->get("projects", array("isActive" => 1, "rank <" => $projects->rank));
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("$viewData->controllerView/detail", $viewData);
    }

    //Etkinlikler
    public function courseList()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Etkinlikler', '/courses');

        $courses = $this->data_model->getAll("courses", array("isActive" => 1), "eventDate ASC");
        $page = $this->data_model->get("menu", array("isActive" => 1, "url" => "courses"));

        $viewData = new stdClass();
        $viewData->title = "Etkinlikler";
        $viewData->viewFolder = "courses_view";
        $viewData->controllerView = "courses";
        $viewData->menus = $this->menus;
        $viewData->pages = $page;
        $viewData->courses = $courses;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("$viewData->controllerView/index", $viewData);
    }

    public function courseDetail($url = "")
    {

        $courses = $this->data_model->get("courses", array("isActive" => 1, "url" => $url));
        $images = $this->data_model->getAll("courses_images", array("isActive" => 1, "courses_id" => $courses->id), "rank ASC");

        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Etkinlikler', '/courses');
        $this->breadcrumbs->push("$courses->title", '/');

        $viewData = new stdClass();
        $viewData->title = "$courses->title";
        $viewData->viewFolder = "courses_view";
        $viewData->menus = $this->menus;
        $viewData->course = $courses;
        $viewData->controllerView = "courses";
        $viewData->images = $images;
        $viewData->nextProje = $this->data_model->get("courses", array("isActive" => 1, "rank >" => $courses->rank));
        $viewData->prevProje = $this->data_model->get("courses", array("isActive" => 1, "rank <" => $courses->rank));
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("$viewData->controllerView/detail", $viewData);
    }

    //Etkinlikler
    public function pageList()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Sayfalar', '/pages');

        $pages = $this->data_model->getAll("menu", array("isActive" => 1, "content !=" => ""), "rank ASC");
        $page = $this->data_model->get("menu", array("isActive" => 1, "url" => "pages"));

        $viewData = new stdClass();
        $viewData->title = "Sayfalar";
        $viewData->controllerView = "pages";
        $viewData->menus = $this->menus;
        $viewData->pages = $pages;
        $viewData->page = $page;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("$viewData->controllerView/index", $viewData);
    }

    public function pageDetail($url = "")
    {

        $page = $this->data_model->get("menu", array("isActive" => 1, "url" => $url));

        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Sayfalar', '/pages');
        $this->breadcrumbs->push("$page->title", '/');

        $viewData = new stdClass();
        $viewData->title = "$page->title";
        $viewData->viewFolder = "menu_view";
        $viewData->menus = $this->menus;
        $viewData->pages = $page;
        $viewData->controllerView = "pages";
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("$viewData->controllerView/detail", $viewData);
    }

    //İletişim
    public function contact()
    {
//        $files = glob("admin/uploads/captcha/*"); // get all file names
//        foreach($files as $file)
//        {
//            if(is_file($file))
//                unlink($file);
//        }

        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('İletişim', '/contact');

        $pages = $this->data_model->getAll("menu", array("isActive" => 1, "content !=" => ""), "rank ASC");
        $page = $this->data_model->get("menu", array("isActive" => 1, "url" => "contact"));

        $this->load->helpers("captcha");
        $config = array(
            "word" => '',
            "img_path" => 'admin/uploads/captcha/',
            "img_url" => base_url("admin/uploads/captcha"),
            "font_path" => base_url('sources/captcha_font/Metropolis.ttf'),
            "img_width" => 150,
            "img_height" => 50,
            "expiration" => 7200,
            "word_length" => 6,
            "font_size" => 30,
            "img_id" => "captcha_img",
            "pool" => "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ",
            "colors" => array(
                "background" => array(56, 255, 45),
                "border" => array(255, 255, 255),
                "text" => array(0, 0, 0),
                "grid" => array(255, 40, 40)
            )
        );

        $captcha = create_captcha($config);

        $viewData = new stdClass();
        $viewData->title = "İletişim";
        $viewData->controllerView = "contact";
        $viewData->menus = $this->menus;
        $viewData->pages = $pages;
        $viewData->page = $page;
        $viewData->captcha = $captcha;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->session->set_userdata("captcha", $viewData->captcha["word"]);

        $this->load->view("$viewData->controllerView/index", $viewData);
    }

    public function contactMail()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("name","Ad Soyad","trim|required");
        $this->form_validation->set_rules("email","Email","trim|required|valid_email");
        $this->form_validation->set_rules("phone","Telefon","trim|required|regex_match[/^[0-9]{10}$/]");
        $this->form_validation->set_rules("subject","Konu","trim|required");
        $this->form_validation->set_rules("message","Mesaj","trim|required");
        $this->form_validation->set_rules("captcha","Güvenlik Kodu","trim|required");

        if($this->form_validation->run() === FALSE){

            $this->form_validation->set_message(array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
                "regex_match" => "Lütfen geçerli bir telefon numarası giriniz ve numara başına 0 koynadam yazınız.",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz."
            ));

            $this->breadcrumbs->unshift('Anasayfa', '/');
            $this->breadcrumbs->push('İletişim', '/contact');

            $pages = $this->data_model->getAll("menu", array("isActive" => 1, "content !=" => ""), "rank ASC");
            $page = $this->data_model->get("menu", array("isActive" => 1, "url" => "contact"));

            $this->load->helpers("captcha");
            $config = array(
                "word" => '',
                "img_path" => 'admin/uploads/captcha/',
                "img_url" => base_url("admin/uploads/captcha"),
                "font_path" => base_url('sources/captcha_font/Metropolis.ttf'),
                "img_width" => 150,
                "img_height" => 50,
                "expiration" => 7200,
                "word_length" => 6,
                "font_size" => 30,
                "img_id" => "captcha_img",
                "pool" => "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                "colors" => array(
                    "background" => array(56, 255, 45),
                    "border" => array(255, 255, 255),
                    "text" => array(0, 0, 0),
                    "grid" => array(255, 40, 40)
                )
            );
            $alert = array(
                "title" => "İşlem başarısız!",
                "text" => "Eksik veya hatalı alan doldurdunuz!",
                "type" => "error",
                "position" => "top-right"
            );
            $this->session->set_flashdata("alert", $alert);

            $captcha = create_captcha($config);

            $viewData = new stdClass();
            $viewData->title = "İletişim";
            $viewData->controllerView = "contact";
            $viewData->menus = $this->menus;
            $viewData->pages = $pages;
            $viewData->page = $page;
            $viewData->captcha = $captcha;
            $viewData->breadcrumbs = $this->breadcrumbs->show();
            $viewData->form_error = true;

            $this->session->set_userdata("captcha", $viewData->captcha["word"]);

            $this->load->view("$viewData->controllerView/index", $viewData);

        }else{

            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['subject'] = $this->input->post('subject');
            $data['message'] = $this->input->post('message');
            $captcha_code = $this->input->post('captcha');

            if($this->session->userdata("captcha") == $captcha_code){
                $send = contact_mail($data['name'], $data['email'], $data['phone'], "Site iletişim mesajı: ".$data['subject'], $data['message']);
                if($send){
                    $this->data_model->add("contact", $data);
                    $alert = array(
                        "title" => "İşlem başarılı!",
                        "text" => "Mesajınız başarıyla gönderildi!",
                        "type" => "success",
                        "position" => "top-right"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("contact"));
                }else{
                    $alert = array(
                        "title" => "İşlem başarısız!",
                        "text" => "Mesajınız gönderilemedi, lütfen daha sonra tekrar deneyin!",
                        "type" => "error",
                        "position" => "top-right"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("contact"));
                }
            }else{
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Güvenlik kodu yanlış girildi!",
                    "type" => "error",
                    "position" => "top-right"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("contact"));
            }
        }

    }

    public function member(){

       
            $data["email"] = $this->input->post("email");
            $data["ip_address"] = $this->input->ip_address();
            $add = $this->data_model->add("members", $data);
            if($add){
                $alert = array(
                    "title" => "Teşekkürler!",
                    "text" => "Başarıyla abone oldunuz!",
                    "type" => "success",
                    "position" => "top-center"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url());
            }else{
                $alert = array(
                    "title" => "Hata!",
                    "text" => "İşlem başarısız, lütfen daha sonra tekrar deneyin!",
                    "type" => "error",
                    "position" => "top-center"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url());
            }

    }
}
