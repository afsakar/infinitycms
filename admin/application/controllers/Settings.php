<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    public $viewFolder = "";
    public $tableName = "settings";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'settings_view';
        $this->load->model('settings_model');
        $this->load->database();
        if(!get_active_user())
        {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $item = $this->settings_model->get();
        $this->breadcrumbs->unshift('Anasayfa', '/');
        $this->breadcrumbs->push('Genel Ayarlar','/');

        $viewData = new stdClass();

        //View'e gönderilen verilerin set edilmesi.
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $viewData->breadcrumbs = $this->breadcrumbs->show();

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function updateSetting(){

        $item = $this->settings_model->get();

        $this->load->library("form_validation");
        $this->form_validation->set_rules("settings[title]", "Site/Şirket Adı", "required|trim");

        $this->form_validation->set_message(array(
            "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
        ));

        //Form validation çalıştır
        $validate = $this->form_validation->run();

        if($validate){

            if ($_FILES["logo"]["name"] !== "") {

                $file_name = rand(0, 99999) . $this->viewFolder;

                $config["allowed_types"] = "jpg|jpeg|png";
                $config["upload_path"] = "uploads/$this->viewFolder/";
                $config["file_name"] = $file_name;

                $this->load->library("upload", $config);

                $upload = $this->upload->do_upload("logo");

                if ($upload) {

                    $data['logo'] = $this->upload->data("file_name");
                    unlink("uploads/{$this->viewFolder}/$item->logo");
                    $update = $this->settings_model->update(array("id" => 1), $data);

                } else {

                    $alert = array(
                        "title" => "İşlem başarısız!",
                        "text" => "Görsel yüklenirken bir problem oluştu!",
                        "type" => "error",
                        "position" => "top-center"
                    );

                    $this->session->set_flashdata("alert", $alert);

                    redirect(base_url("settings"));

                    die();

                }

            }

            if ($_FILES["favicon"]["name"] !== "") {

                $file_name = rand(0, 99999) . $this->viewFolder;

                $config["allowed_types"] = "jpg|jpeg|png";
                $config["upload_path"] = "uploads/$this->viewFolder/";
                $config["file_name"] = $file_name;

                $this->load->library("upload", $config);

                $upload = $this->upload->do_upload("favicon");

                if ($upload) {

                    $data['favicon'] = $this->upload->data("file_name");
                    unlink("uploads/{$this->viewFolder}/$item->favicon");
                    $update = $this->settings_model->update(array("id" => 1), $data);

                } else {

                    $alert = array(
                        "title" => "İşlem başarısız!",
                        "text" => "Görsel yüklenirken bir problem oluştu!",
                        "type" => "error",
                        "position" => "top-center"
                    );

                    $this->session->set_flashdata("alert", $alert);

                    redirect(base_url("settings"));

                    die();

                }

            }

            $html = '<?php'.PHP_EOL.PHP_EOL;
            foreach ($this->input->post('settings') as $key => $val) {
                $html .= '$settings["'.$key.'"] ='."'".$val."';".PHP_EOL;
            }

            $update = file_put_contents(FCPATH . '/application/helpers/settings.php', $html);

            if ($update) {
                $alert = array(
                    "title" => "İşlem başarılı!",
                    "text" => "Kayıt başarıyla güncellendi!",
                    "type" => "success",
                    "position" => "top-center"
                );
            } else {
                $alert = array(
                    "title" => "İşlem başarısız!",
                    "text" => "Kayıt güncellenirken bir hata oluştu, lütfen tekrar deneyin!",
                    "type" => "error",
                    "position" => "top-center"
                );
            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url('settings'));
            die();

        }else{

            $this->breadcrumbs->unshift('Anasayfa', '/');
            $this->breadcrumbs->push('Ayarlar', '/settings');
            $this->breadcrumbs->push('Genel Ayarlar','/');

            $viewData = new stdClass();

            //View'e gönderilen verilerin set edilmesi.
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $this->session->set_flashdata("form_error", $viewData->form_error = true);
            $viewData->item = $item;
            $viewData->breadcrumbs = $this->breadcrumbs->show();

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
    }

}
