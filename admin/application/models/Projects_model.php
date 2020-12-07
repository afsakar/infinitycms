<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects_model extends CI_Model
{
    public $tableName = "projects";

    public function __construct()
    {
        parent::__construct();
    }

    //Bütün kayıtları getir
    public function get($where = array())
    {
        return $this->db->where($where)->get($this->tableName)->row();
    }

    //Bütün kayıtları getir
    public function getAll($where = array(), $orderBy)
    {
        return $this->db->where($where)->order_by($orderBy)->get($this->tableName)->result();
    }

    //Veritabanına ekle
    public function add($data = array())
    {
        return $this->db->insert($this->tableName, $data);
    }

    //Kayıt güncelle
    public function update($where = array(), $data = array())
    {
        return $this->db->where($where)->update($this->tableName, $data);
    }

    //Kayıt Silme
    public function delete($where = array())
    {
        return $this->db->where($where)->delete($this->tableName);
    }

}