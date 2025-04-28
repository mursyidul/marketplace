<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

    public function checkUser($email, $tipe){
        $this->db->select("user.*, role.nama as nama_role, role.id as id_role");
        $this->db->from("tbl_user user");
        $this->db->join("tbl_role role", "role.id=user.id_role", "LEFT");
        if ($tipe == 'email') {
            $this->db->where(array(
                "email" => $email
            ));
        } else {
            $this->db->where(array(
                "phone" => $email
            ));
        }

        $user = $this->db->get();
        if($user->num_rows() > 0){
            return $user->row();
        } else {
            return false;
        }
    }
    public function checkStatus($email, $tipe){
        $this->db->select("id_user, nama as nama_user, status");
        $this->db->from("tbl_user");
        if ($tipe == 'email') {
            $this->db->where(array(
                "email" => $email,
                "status" => "Active"
            ));
        } else {
            $this->db->where(array(
                "phone" => $email,
                "status" => "Active"
            ));
        }
        $user = $this->db->get();
        if($user->num_rows() > 0){
            return $user->row();
        } else {
            return false;
        }
    }
}

    // Fungsi untuk verifikasi login user
    // public function login($email, $password) {
    //     $query = $this->db->get_where('users', ['email' => $email]);

    //     if ($query->num_rows() == 1) {
    //         $user = $query->row();

    //         // Verifikasi password hash
    //         if (password_verify($password, $user->password)) {
    //             return $user; // Login berhasil
    //         }
    //     }

    //     return false; // Login gagal
    // }