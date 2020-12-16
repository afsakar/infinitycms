<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "homepage";
        $this->load->model('data_model');
        $this->menus = $this->data_model->getAll("menu",array("isMain !=" => 0, "isActive" => 1),"rank ASC");
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

        $categories = $this->data_model->getAll("projects_category", array("isActive"=>1),"");
        $projects = $this->data_model->getAll("projects", array("isActive"=>1),"rank ASC");
        $page = $this->data_model->get("menu", array("isActive"=>1, "url" => "projects"));

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

        $projects = $this->data_model->get("projects", array("isActive"=>1, "url" => $url));
        $categories = $this->data_model->get("projects_category", array("isActive"=>1, "id" => $projects->category_id));
        $images = $this->data_model->getAll("project_images", array("isActive"=>1, "project_id" => $projects->id, "isCover" => 0),"rank ASC");

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
        $viewData->nextProje = $this->data_model->get("projects", array("isActive"=>1, "rank >" => $projects->rank));
        $viewData->prevProje = $this->data_model->get("projects", array("isActive"=>1, "rank <" => $projects->rank));
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("$viewData->controllerView/detail", $viewData);
    }

    //Etkinlikler
    public function courseList()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Etkinlikler', '/courses');

        $courses = $this->data_model->getAll("courses", array("isActive"=>1),"eventDate ASC");
        $page = $this->data_model->get("menu", array("isActive"=>1, "url" => "courses"));

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

        $courses = $this->data_model->get("courses", array("isActive"=>1, "url" => $url));
        $images = $this->data_model->getAll("courses_images", array("isActive"=>1, "courses_id" => $courses->id),"rank ASC");

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
        $viewData->nextProje = $this->data_model->get("courses", array("isActive"=>1, "rank >" => $courses->rank));
        $viewData->prevProje = $this->data_model->get("courses", array("isActive"=>1, "rank <" => $courses->rank));
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("$viewData->controllerView/detail", $viewData);
    }

    //Etkinlikler
    public function pageList()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Sayfalar', '/pages');

        $pages = $this->data_model->getAll("menu",array("isActive" => 1, "content !=" => ""),"rank ASC");
        $page = $this->data_model->get("menu", array("isActive"=>1, "url" => "projects"));

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

        $page = $this->data_model->get("menu", array("isActive"=>1, "url" => $url));

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
}
