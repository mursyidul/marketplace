<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
        $this->load->library('form_validation');
    	$this->load->model("Model_master");
    }

	public function index()
	{
		$this->load->view('register_page');
	} 

	public function tampilan()
	{
		$this->load->view('register_page');
	}

	public function action() 
	{
        $this->load->library('form_validation');
        // Validasi form
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tbl_user.nama]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_user.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|is_unique[tbl_user.phone]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            // Tampilkan kembali form jika gagal
            
	        $this->load->view('register_page');
            // redirect('register');
        } else {
            // Hash password dan simpan ke database
            $data = [
                'id_role' => "3",
                'nama' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'status' => "Active",
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
          		'created_date' => date('Y-m-d H:i:s')
            ];
            $action = $this->Model_master->tambahMaster("tbl_user", $data);
	          if ($action) {
	            $this->session->set_flashdata("success", "<b>Berhasil</b> - Data berhasil ditambahkan");
	          } else {
	            $this->session->set_flashdata("error", "<b>Tidak Berhasil</b> - Data tidak berhasil ditambahkan");
	          }
      		redirect('login');
        }

    }
}
