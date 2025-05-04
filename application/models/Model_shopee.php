<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_shopee extends CI_Model {

    public function get_kolom_mapping($id){
        $this->db->select("shopee.*");
        $this->db->from("tbl_kolom_table_shopee shopee");
        $this->db->where("shopee.id_list_shopee", $id);
        $this->db->order_by("shopee.id", "asc");
        $data = $this->db->get();
            if($data->num_rows() > 0){
                return $data->result_array();
            } else {
                return array();
            }
    }

    public function get_kolom_table_shopee($id){
        $this->db->select("shopee.kolom_table, shopee.type, shopee.constraint, shopee.auto_increment, shopee.unsigned, shopee.null");
        $this->db->from("tbl_kolom_table_shopee shopee");
        $this->db->where("shopee.id_list_shopee", $id);
        $this->db->order_by("shopee.id", "asc");
        $data = $this->db->get();
            if($data->num_rows() > 0){
                return $data->result_array();
            } else {
                return array();
            }
    }

    public function get_nama_table_shopee($id){
        $this->db->select("list.nama_table");
        $this->db->from("tbl_list_shopee list");
        $this->db->where("list.id", $id);
        $this->db->order_by("list.id", "asc");
        $data = $this->db->get();
            if($data->num_rows() > 0){
                return $data->result_array();
            } else {
                return array();
            }
    }

}
?>