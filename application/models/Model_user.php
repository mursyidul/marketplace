<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {

   public $table  = 'tbl_user';
   public $id     = 'tbl_user.id_user';

    public function getUser($status){
        $this->db->select("role.nama as nama_role, user.*");
        $this->db->from("tbl_user user");
        $this->db->join("tbl_role role", "role.id=user.id_role", "LEFT");

        if($status!=""){
          $this->db->where('user.status =', $status);
        }
        $this->db->order_by("user.nama", "asc");
        $data = $this->db->get();
            if($data->num_rows() > 0){
                return $data->result_array();
            } else {
                return array();
            }
    }

    public function get_role(){
        $this->db->select("role.*");
        $this->db->from("tbl_role role");
        $this->db->where("role.id !=", "1");
        // $this->db->or_where("role.id", "3");
        $this->db->order_by("role.id", "desc");
        $data = $this->db->get();
            if($data->num_rows() > 0){
                return $data->result_array();
            } else {
                return array();
            }
    }

}
?>