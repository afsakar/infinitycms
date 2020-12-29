<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $viewFolder = "";

	public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'dashboard_view';

        if(!get_active_user())
        {
            redirect(base_url("login"));
        }

    }

    public function index()
	{
        $todo = $this->db->where(array("isActive" => 1))->get("todo")->result();

        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->user = get_active_user();
        $viewData->todo_checked = $this->db->where(array("isActive" => 1, "user_id" => $viewData->user->id))->get("todo")->result();
        $viewData->todo_unchecked = $this->db->where(array("isActive" => 0, "user_id" => $viewData->user->id))->get("todo")->result();
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

	public function todoCheck($id){

        $today = date("Y-m-d H:i:s");
        $todo = $this->db->where(array("id" => $id))->get("todo")->result();
        if($todo->isActive == 0){
            $this->db->where(array("id" => $id))->update("todo", array("checkedAt" => $today));
        }

        if ($id) {
            $isActive = $this->input->post("data");
            if ($isActive == "false") {
                $isActive = 0;
            } else {
                $isActive = 1;
            }

            $update = $this->db->where(array("id" => $id))->update("todo", array("isActive" => $isActive));

        }
    }

    public function addTodo(){

	    $user = get_active_user();
	    $data["title"] = $this->input->post("title");
	    $data["user_id"] = $user->id;

	    $insert = $this->db->insert("todo", $data);
	    if($insert){
            $alert = array(
                "title"     => "İşlem başarılı!",
                "text"      => "Kayıt başarıyla eklendi!",
                "type"      => "success",
                "position"  => "top-center"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url());
        }

    }

    public function todoDelete($id){
        $delete = $this->db->where(array("id" => $id))->delete("todo");
        if ($delete) {
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
        redirect(base_url());
    }
}
