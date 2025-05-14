<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Performa extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
	    checkSessionUser();
	    $login_status = $this->session->userdata('role');

	    if ($login_status != "SUPERADMIN") {
	        redirect('my404');
	    }
	    $this->load->model("Model_master");
        $this->load->model("Model_shopee");
	    $this->load->dbforge();
	}

	public function index()
	{
	    $data['title']   = "Data Performa";
	    $data['performa']  = $this->Model_master->getMasterOneTable("*", "tbl_performa_shopee", "id", "asc", "");
	    $this->template->load("template", "performa/data_performa", $data);
	}

    public function upload_excel_shopee() {
        require 'vendor/autoload.php'; // Autoload Composer
        $id = 1;
        $kolom_table      = $this->Model_master->getMasterOneTable("*", "tbl_kolom_table_shopee", "id", "asc", "id_list_shopee = '1' and kolom_table != 'id'");
        // echo "<pre>", print_r($kolom_table, 1), "</pre>";
        $nama_file = $_FILES['file']['name'];
        $file = $_FILES['file']['tmp_name'];

        $reader = new Xlsx();
        $spreadsheet = $reader->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        // echo "<pre>", print_r($sheet, 1), "</pre>"; // Sesuaikan nama tabel
        // Skip baris pertama (judul kolom)
        $data_excel = [];
        for ($i = 1; $i < count($sheet); $i++) {
            $a= 0; 
            foreach ($kolom_table as $k) {
                $data = [
                    "urutan" => $i,
                    $k['kolom_table'] => $sheet[$i][$a],
                ];
                array_push($data_excel, $data);
            // echo "<pre>", print_r($a." = ".$k['kolom_table']." ".$i." = ".$sheet[$i][$a], 1), "</pre>"; // Sesuaikan nama tabel
            $a++; }
            // $data = [
            //     'nama' => $sheet[$i][0],
            //     'email' => $sheet[$i][1],
            //     'telepon' => $sheet[$i][2]
            // ];
            

        }
            // echo "<pre>", print_r($data1, 1), "</pre>";

        $date_start     = $this->input->post('date_start');
        $date_end       = $this->input->post('date_end');
        $keterangan     = $this->input->post('keterangan');

        $data_performa = array(
          "date_start"          => date("Y-m-d", strtotime($date_start)),
          "date_end"            => date("Y-m-d", strtotime($date_end)),
          "upload_file"         => $nama_file,
          "keterangan"          => $keterangan,
          "created_date"        => date('Y-m-d H:i:s')
        );

        $action = $this->Model_master->tambahMaster("tbl_performa_shopee", $data_performa);
          if ($action) {
            $grouped = [];

            foreach ($data_excel as $item) {
                $urutan = $item['urutan'];
                unset($item['urutan']); // Hapus 'urutan' dari item untuk disimpan hanya key-value lainnya
                foreach ($item as $key => $value) {
                    $grouped[$urutan][$key] = $value;
                }
            }
            $this->Model_master->insert_all("tbl_list_excel", $grouped);
            $this->session->set_flashdata("success", "<b>Berhasil</b> - Data berhasil ditambahkan");
          } else {
            $this->session->set_flashdata("error", "<b>Tidak Berhasil</b> - Data tidak berhasil ditambahkan");
          }
        redirect('performa');
    }

    // password database marketplace hosting Iu0AIp^dG*@
}
