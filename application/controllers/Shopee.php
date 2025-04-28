<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopee extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
	    checkSessionUser();
	    $login_status = $this->session->userdata('role');

	    if ($login_status != "SUPERADMIN") {
	        redirect('my404');
	    }
	    $this->load->model("Model_master");
	}

	public function index()
	{
	    $data['title']   = "Shopee";
	    $data['table']  = $this->Model_master->getMasterOneTable("*", "tbl_list_shopee", "nama", "asc", "");
	    $this->template->load("template", "shopee/data_shopee", $data);
	}

	public function tambah_table()
	{
		$nama 		= $this->input->post('nama');
		$nama_table = $this->input->post('nama_table');
		$keterangan = $this->input->post('keterangan');

		$data_sama = $this->Model_master->check_existing_name_master("id", "tbl_list_shopee", "nama", $nama);
		if ($data_sama) {
      		$this->session->set_flashdata("error", "Nama table sudah ada, harap gunakan lain");
    	} else {
    		$data = array(
	          "nama"      		=> $nama,
	          "nama_table"    	=> preg_replace('/[^a-zA-Z0-9]/', '_', $nama_table),
	          "keterangan"     	=> $keterangan,
	          "created_date" 	=> date('Y-m-d H:i:s')
	        );
	        
	          $action = $this->Model_master->tambahMaster("tbl_list_shopee", $data);
	          if ($action) {
	            $this->session->set_flashdata("success", "<b>Berhasil</b> - Data berhasil ditambahkan");
	          } else {
	            $this->session->set_flashdata("error", "<b>Tidak Berhasil</b> - Data tidak berhasil ditambahkan");
	          }
    	}
    	redirect('shopee');
	}
}
