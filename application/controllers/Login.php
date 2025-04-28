<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Model_login", "mLogin");
	}

	public function index()
	{
		$this->load->view('login_page');
	}

	public function action()
	{
		$email = $this->input->post("email", TRUE);
		$password = $this->input->post("password");
		if(isset($email) && isset($password)){
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			    $tipe = 'email';
			} elseif (preg_match('/^(\+62|62|0)8[1-9][0-9]{7,10}$/', $email)) {
			    $tipe = 'whatsapp';
			} else {
			    $tipe = 'invalid';
			}

			if ($tipe == 'invalid') {
			    // Tampilkan error ke user
			    $this->session->set_flashdata("error", "Login gagal! Periksa akun anda");
				redirect("");
			} else {
				$checkUser = $this->mLogin->checkUser($email, $tipe);
				// echo $this->db->last_query();
				// echo "<pre>", print_r($checkUser, 1), "</pre>";
				if ($checkUser && password_verify($password, $checkUser->password)) {
				    // echo "A";
					$checkStatus = $this->mLogin->checkStatus($email, $tipe);
					if($checkStatus && password_verify($password, $checkUser->password)){
						// echo "B";
						$dataUser = array(
						"id_user" 	=> $checkUser->id_user,
						"nama_user" => $checkUser->nama,
						"role" 		=> $checkUser->nama_role,
						"id_role" 	=> $checkUser->id_role,
						"pls_login" => "Y"
					);
					$this->session->set_userdata($dataUser);
					redirect("dashboard");
					} else {
						// echo "C";
						$this->session->set_flashdata("error", "Maaf, akun anda belum diaktifkan");
						redirect("");
					}
				} else {
					// echo "D";
					$this->session->set_flashdata("error", "Login gagal! Periksa akun anda");
					redirect("");
				}
				
			    // Lanjut proses simpan data
			    // Simpan $tipe ke kolom jenis_kontak misalnya
			}
		}
	}

	public function doLogout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
