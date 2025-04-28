<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_master extends CI_Model
{
    public function getMasterOneTable($query, $table, $order, $sort, $condition)
    {
        $this->db->select($query);
        $this->db->from($table);
        if ($condition != "") {
            $this->db->where($condition);
        }
        $this->db->order_by($order, $sort);
        return $this->db->get()->result_array();
    }
    public function check_existing_name_master($id_table, $table, $column, $value)
    {
        $this->db->select($id_table);
        $this->db->from($table);
        $this->db->where($column, $value);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }
    public function check_existing_name_master_dua($id_table, $table, $column, $value, $column2, $value2)
    {
        $this->db->select($id_table);
        $this->db->from($table);
        $this->db->where($column, $value);
        $this->db->or_where($column2, $value2);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }
    public function check_existing_name_master_dua_and($id_table, $table, $column, $value, $column2, $value2)
    {
        $this->db->select($id_table);
        $this->db->from($table);
        $this->db->where($column, $value);
        $this->db->where($column2, $value2);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    public function tambahMaster($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function check_data_exist($table, $data)
    {
        $this->db->select("*");
        $data = $this->db->get_where($table, $data);
        if($data->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function editMaster($id_master, $table, $dataMaster)
    {
        $this->db->where($id_master);
        $this->db->update($table, $dataMaster);
        if($this->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteMaster($id_master, $id_table,$table)
    {
        $this->db->where($id_table, $id_master)->delete($table);
        if($this->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
}
