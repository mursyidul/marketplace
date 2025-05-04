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
        $this->load->model("Model_shopee");
	    $this->load->dbforge();
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
              "status"          => "0",
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

	public function mapping($id)
	{
		$data['table'] 		= $this->db->get_where('tbl_list_shopee',['id' => $id])->row();
        $data['mapping']    = $this->Model_shopee->get_kolom_mapping($id);
		$this->template->load("template", "mapping_shopee/data_mapping_shopee", $data);
	}

	public function tambah_mapping()
	{
		$id_list_shopee = $this->input->post('id_list_shopee');
		$nama_table 	= $this->input->post('nama_table');
		$kolom_excel 	= $this->input->post('kolom_excel');
		$kolom_table 	= $this->input->post('kolom_table');
		$type 			= $this->input->post('type');
		$constraint 	= $this->input->post('constraint');
		$null 		    = $this->input->post('null');
		$auto_increment = $this->input->post('auto_increment');
        $unsigned       = $this->input->post('unsigned');

		$data = array(
          "id_list_shopee"  => $id_list_shopee,
          "kolom_excel"     => $kolom_excel,
          "kolom_table"  	=> preg_replace('/[^a-zA-Z0-9]/', '_', $kolom_table),
          "type"     		=> $type,
          "constraint"     	=> $constraint,
          "null"     	    => $null,
          "auto_increment"  => $auto_increment,
          "unsigned"        => $unsigned,
          "created_date" 	=> date('Y-m-d H:i:s')
        );
        
          $action = $this->Model_master->tambahMaster("tbl_kolom_table_shopee", $data);
          if ($action) {
            $this->session->set_flashdata("success", "<b>Berhasil</b> - Data berhasil ditambahkan");
          } else {
            $this->session->set_flashdata("error", "<b>Tidak Berhasil</b> - Data tidak berhasil ditambahkan");
          }
        redirect('shopee/mapping/'.$id_list_shopee);
	}

    public function delete_mapping()
      {
        $id = $this->input->post("id");
        $delete = $this->Model_master->deleteMaster($id, "id", "tbl_kolom_table_shopee");

        if ($delete) {
          echo json_encode(array("status" => "success", "data" => $id, "message" => "Berhasil menghapus kolom mapping"));

        } else {
          echo json_encode(array("status" => "error", "message" => "Tidak dapat menghapus kolom mapping"));
        }
      }

    public function change_add_table()
    {
        $id = $this->input->post('id');

        $nama_table = $this->db->get_where('tbl_list_shopee',['id' => $id])->row();
        $data = $this->Model_shopee->get_kolom_table_shopee($id);
        // echo "<pre>", print_r($data, 1), "</pre>";

        $fields = [];
        foreach ($data as $k) {
            $nama_tabel = $k['kolom_table'];
            unset($k['kolom_table']); // hapus nama kolom dari definisi field
            $fields[$nama_tabel] = $k;
        }
        // echo "<pre>", print_r($fields, 1), "</pre>";
        $this->dbforge->add_field($fields);
        // $this->dbforge->add_key($data[0]['kolom_table'], TRUE); // Primary key

        // Buat tabel
        if ($this->dbforge->create_table($nama_table->nama_table)) {
            $alter = "
                ALTER TABLE ".$nama_table->nama_table." 
                MODIFY ".$data[0]['kolom_table']." INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY
            ";

            if ($this->db->query($alter)) {
                $this->db->set("status", "1");
                $this->db->where("tbl_list_shopee.id", $id);
                $this->db->update("tbl_list_shopee");
                echo json_encode(array("status" => "success", "data" => $id, "message" => "Table ".$nama_table->nama_table." berhasil dibuat"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Gagal membuat tabel ".$nama_table->nama_table));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Gagal membuat tabel ".$nama_table->nama_table));
        }
    }

	// public function kolom()
	// {
	// 	$fields = [
    //         'id' => [
    //             'type'           => 'INT',
    //             'unsigned'       => TRUE,
    //             'auto_increment' => TRUE
    //         ],
    //         'name' => [
    //             'type'       => 'VARCHAR',
    //             'constraint' => '100',
    //         ],
    //         'price' => [
    //             'type'       => 'DECIMAL',
    //             'constraint' => '10,2',
    //         ],
    //         'stock' => [
    //             'type'       => 'INT',
    //             'constraint' => 11,
    //         ],
    //         'created_at' => [
    //             'type' => 'DATETIME',
    //             'null' => TRUE,
    //         ],
    //     ];

    //     // Tambahkan kolom ke dbforge
    //     $this->dbforge->add_field($fields);
    //     $this->dbforge->add_key('id', TRUE); // Primary key

    //     // Buat tabel
    //     if ($this->dbforge->create_table('products')) {
    //         echo "Tabel 'products' berhasil dibuat!";
    //     } else {
    //         echo "Gagal membuat tabel 'products'.";
    //     }
	// }

	// public function create_orders_table() {
    //     // Langkah 1: Buat tabel menggunakan dbforge
    //     $fields = [
    //         'id' => [
    //             'type' => 'INT',
    //             'unsigned' => TRUE,
    //             'auto_increment' => TRUE
    //         ],
    //         'customer_name' => [
    //             'type' => 'VARCHAR',
    //             'constraint' => 100,
    //         ],
    //         'status' => [
    //             'type' => 'VARCHAR',
    //             'constraint' => 20, // sementara sebagai varchar
    //         ],
    //         'created_at' => [
    //             'type' => 'DATETIME',
    //             'null' => TRUE,
    //         ],
    //     ];

    //     $this->dbforge->add_field($fields);
    //     $this->dbforge->add_key('id', TRUE);

    //     if ($this->dbforge->create_table('orders', TRUE)) {
    //         echo "Tabel 'orders' dibuat.<br>";

    //         // Langkah 2: Ubah kolom 'status' jadi ENUM via query mentah
    //         $alter = "
    //             ALTER TABLE `orders` 
    //             MODIFY `status` ENUM('pending','paid','shipped','cancelled') 
    //             NOT NULL DEFAULT 'pending'
    //         ";

    //         if ($this->db->query($alter)) {
    //             echo "Kolom 'status' diubah menjadi ENUM.";
    //         } else {
    //             echo "Gagal mengubah kolom 'status' menjadi ENUM.";
    //         }

    //     } else {
    //         echo "Gagal membuat tabel 'orders'.";
    //     }
    // }
}
