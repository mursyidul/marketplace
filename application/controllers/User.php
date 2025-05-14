<?php

defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    checkSessionUser();
    $login_status = $this->session->userdata('role');

    if ($login_status != "SUPERADMIN") {
        redirect('my404');
    }
    $this->load->model("Model_master");
    $this->load->model("Model_user");
  }

  public function index()
  {
    $data['title']   = "User";
    if (isset($_GET['status']) && ! empty($_GET['status'])){
      $status = $_GET['status'];
    } else {
      $status = "Active";
    }
    $data['user']    = $this->Model_user->getUser($status);
    $data['role']    = $this->Model_user->get_role();
    $this->template->load("template", "user/data_user", $data);

  }

  public function tambah_user()
  {
    $nama       = $this->input->post("nama");
    $email      = $this->input->post("email");
    $phone      = $this->input->post("phone");
    $password   = $this->input->post("password");
    $status     = $this->input->post("status");
    $id_role    = $this->input->post("id_role");
    $data_sama = $this->Model_master->check_existing_name_master_dua("id_user", "tbl_user", "phone", $phone, "email", $email);
    if ($data_sama) {
      $this->session->set_flashdata("error", "Email dan phone sudah terdaftar");
    } else {
      $data = array(
        "email"     => $email,
        "id_role"   => $id_role,
        "nama"      => $nama,
        "phone"     => $phone,
        "password"  => password_hash($password, PASSWORD_DEFAULT),
        "status"    => $status,
        "created_date" => date('Y-m-d H:i:s')
      );

      $action = $this->Model_master->tambahMaster("tbl_user", $data);
      if ($action) {
        $this->session->set_flashdata("success", "<b>Berhasil</b> - Data berhasil ditambahkan");
      } else {
        $this->session->set_flashdata("error", "<b>Tidak Berhasil</b> - Data tidak berhasil ditambahkan");
      }
    }
    redirect('user');
  }

  public function edit_user()
  { 
    $id_user    = $this->input->post("id_user");
    $id_role    = $this->input->post("id_role");
    $email      = $this->input->post("email");
    $nama       = $this->input->post("nama");
    $phone      = $this->input->post("phone");
    $password   = $this->input->post("password");
    $status     = $this->input->post("status");

    $data_sama = array(
      "phone"       => $phone,
      "email"       => $email,
      "id_user !="  => $id_user
    );
    $data_sama = $this->Model_master->check_data_exist("tbl_user", $data_sama);
    if ($data_sama) {
      $this->session->set_flashdata("error", "Email dan phone sudah terdaftar");
    } else {


      $data = array(
        "id_role"   => $id_role,
        "email"     => $email,
        "nama"      => $nama,
        "phone"     => $phone,
        "status"    => $status
      );
      // echo "<pre>", print_r($data, 1), "</pre>";
      if ($password != "") {
        $data["password"] = password_hash(($password), PASSWORD_DEFAULT);
      }

      $action = $this->Model_master->editMaster(array('id_user' => $id_user), "tbl_user", $data);
      if ($action) {
        $this->session->set_flashdata("success", "<b>Berhasil</b> - Data berhasil di update");
      } else {
        $this->session->set_flashdata("error", "<b>Tidak Berhasil</b> Data tidak berhasil di update");
      }
    }
    redirect("user");
  }

  public function delete_user()
  {
    $id_user = $this->input->post("id_user");
    $delete = $this->Model_master->deleteMaster($id_user, "id_user", "tbl_user");

    if ($delete) {
      echo json_encode(array("status" => "success", "data" => $id_user, "message" => "Berhasil menghapus user"));
    } else {
      echo json_encode(array("status" => "error", "message" => "Tidak dapat menghapus user"));
    }
  }
}