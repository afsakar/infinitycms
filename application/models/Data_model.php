<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_records($tableName, $where = array(), $orderBy, $limit, $count)
    {
        return $this->db->where($where)->order_by($orderBy)->limit($limit, $count)->get($tableName)->result();
    }

    public function get_count($tableName, $where = array())
    {
        return $this->db->where($where)->count_all($tableName);
    }

    //Bütün kayıtları getir
    public function get($tableName, $where = array())
    {
        return $this->db->where($where)->get($tableName)->row();
    }

    //Bütün kayıtları getir
    public function getAll($tableName, $where = array(), $orderBy)
    {
        return $this->db->where($where)->order_by($orderBy)->get($tableName)->result();
    }

    //Veritabanına ekle
    public function add($tableName, $data = array())
    {
        return $this->db->insert($tableName, $data);
    }

    //Kayıt güncelle
    public function update($tableName, $where = array(), $data = array())
    {
        return $this->db->where($where)->update($tableName, $data);
    }

    //Kayıt Silme
    public function delete($tableName, $where = array())
    {
        return $this->db->where($where)->delete($tableName);
    }

}