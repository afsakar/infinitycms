<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blank extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $menus = $this->menu_model->getAll(
            array("isMain !=" => 0, "isActive" => 1),
            "rank ASC"
        );

        $viewData = new stdClass();
        $viewData->menus = $menus;

		$this->load->view('blank_view', $viewData);
	}
}
