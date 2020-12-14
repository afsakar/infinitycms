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

    public function projectsList()
    {
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Projeler', '/projects');

        $categories = $this->data_model->getAll("projects_category", array("isActive"=>1),"");
        $projects = $this->data_model->getAll("projects", array("isActive"=>1),"rank ASC");

        $viewData = new stdClass();
        $viewData->title = "Projeler";
        $viewData->viewFolder = "projects_view";
        $viewData->menus = $this->menus;
        $viewData->categories = $categories;
        $viewData->projects = $projects;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("projects/index", $viewData);
    }

    public function projectDetail($url = "")
    {

        $projects = $this->data_model->get("projects", array("isActive"=>1, "url" => $url));
        $categories = $this->data_model->get("projects_category", array("isActive"=>1, "id" => $projects->category_id));
        $images = $this->data_model->getAll("project_images", array("isActive"=>1, "project_id" => $projects->id, "isCover" => 0),"");

        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Projeler', '/projects');
        $this->breadcrumbs->push("$projects->title", '/');

        $viewData = new stdClass();
        $viewData->title = "$projects->title";
        $viewData->viewFolder = "projects_view";
        $viewData->menus = $this->menus;
        $viewData->categories = $categories;
        $viewData->project = $projects;
        $viewData->images = $images;
        $viewData->nextProje = $this->data_model->get("projects", array("isActive"=>1, "id >" => $projects->id));
        $viewData->prevProje = $this->data_model->get("projects", array("isActive"=>1, "id <" => $projects->id));
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("projects/detail", $viewData);
    }
}
