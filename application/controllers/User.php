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
    $phone    = $this->input->post("phone");
    $email    = $this->input->post("email");
    $id_role  = $this->input->post("id_role");
    $data_sama = $this->Model_master->check_existing_name_master_dua("id_user", "tbl_user", "phone", $phone, "email", $email);
    if ($data_sama) {
      $this->session->set_flashdata("error", "Email dan phone sudah terdaftar");
    } else {
      $insert_data = true;
      if ($id_role == "4") {
        $kabid = $this->Model_master->check_existing_name_master("id_user", "tbl_user", "id_role", "4");
        if ($kabid) {
          $insert_data = false;
          $this->session->set_flashdata("error", "Kepala bidang sudah terdaftar, mohon edit kepala bidang lama terlebih dahulu");
        }
      }
      if ($insert_data) {
        $config['upload_path'] = './file/tanda_tangan/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 0;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $this->load->library('upload', $config);

        $var_file_galeri = "";

        $list_gambar = array();
        if ($this->upload->do_upload('gambar')) {
          $gbr1 = $this->upload->data();
          array_push($list_gambar, array('name' => $gbr1['file_name'], 'size' => $gbr1['file_size']));
          $file_size_company = $gbr1['file_size'];
          $var_file_galeri = $gbr1['file_name'];
        }

        $this->load->library('image_lib');
        foreach ($list_gambar as $gambar) {

          if ($gambar['size'] >= 2048) {
            $config['image_library'] = 'gd2';
            $config['source_image'] = './file/tanda_tangan/' . $gambar['name'];
            $config['create_thumb'] = false;
            $config['maintain_ratio'] = true;
            $config['width'] = '500';
            $config['height'] = '500';
            $config['master_dim'] = 'height';
            $config['new_image'] = './file/tanda_tangan/' . $gambar['name'];

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
          }
        }

        $email      = $this->input->post("email");
        $nama       = $this->input->post("nama");
        $phone      = $this->input->post("phone");
        $password   = $this->input->post("password");
        $status     = $this->input->post("status");

        $data = array(
          "email"     => $email,
          "id_role"   => $id_role,
          "nama"      => $nama,
          "gambar"    => $var_file_galeri,
          "phone"     => $phone,
          "password"  => password_hash($password), PASSWORD_DEFAULT),
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
    }
    redirect('user');
  }

  public function edit_user()
  {
    $id_user = $this->input->post("id_user");
    $phone   = $this->input->post("phone");
    $email   = $this->input->post("email");
    $id_role   = $this->input->post("id_role");

    $data_sama = array(
      "phone"       => $phone,
      "email"       => $email,
      "id_user !="  => $id_user
    );
    $data_sama = $this->Model_master->check_data_exist("tbl_user", $data_sama);
    if ($data_sama) {
      $this->session->set_flashdata("error", "Email dan phone sudah terdaftar");
    } else {
        $user_edit = $this->db->get_where('tbl_user', ['id_user' => $id_user])->row();
        $config['upload_path'] = './file/tanda_tangan/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 0;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $this->load->library('upload', $config);

        $var_file_galeri = "";

        $list_gambar = array();
        if ($this->upload->do_upload('gambar')) {
          $gbr1 = $this->upload->data();
          array_push($list_gambar, array('name' => $gbr1['file_name'], 'size' => $gbr1['file_size']));
          $file_size_company = $gbr1['file_size'];
          $var_file_galeri = $gbr1['file_name'];
        }

        $this->load->library('image_lib');
        foreach ($list_gambar as $gambar) {

          if ($gambar['size'] >= 2048) {
            $config['image_library'] = 'gd2';
            $config['source_image'] = './file/tanda_tangan/' . $gambar['name'];
            $config['create_thumb'] = false;
            $config['maintain_ratio'] = true;
            $config['width'] = '500';
            $config['height'] = '500';
            $config['master_dim'] = 'height';
            $config['new_image'] = './file/tanda_tangan/' . $gambar['name'];

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
          }
        }

        $file_galeri_var = $var_file_galeri;
        if ($file_galeri_var == "") {
          $file_galeri_var = $user_edit->gambar;
        } else {
          unlink("./file/tanda_tangan/" . $user_edit->gambar);
        }
       
      $id_user    = $this->input->post("id_user");
      $id_role    = $this->input->post("id_role");
      $email      = $this->input->post("email");
      $nama       = $this->input->post("nama");
      $phone      = $this->input->post("phone");
      $password   = $this->input->post("password");
      $status     = $this->input->post("status");


      $data = array(
        "id_role"   => $id_role,
        "email"     => $email,
        "nama"      => $nama,
        "phone"     => $phone,
        "gambar"    => $file_galeri_var,
        "status"    => $status
      );
      // echo "<pre>", print_r($data, 1), "</pre>";
      if ($password != "") {
        $data["password"] = password_hash($password), PASSWORD_DEFAULT);
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
    
  public function export()
    {
      if (isset($_GET['status']) && ! empty($_GET['status'])){
        $status = $_GET['status'];
      } else {
        $status = "Active";
      }
        $items    = $this->Model_user->getUser($status);
        //Lakukan proses export data siswa, jika data siswa tidak kosong
        if(!empty($items)){
            //inisialisasi object library php spreadsheet
            $spreadsheet = new Spreadsheet();
            $drawing = new Drawing();
            $drawing1 = new Drawing();
            $drawing2 = new Drawing();
            $sheet = $spreadsheet->getActiveSheet();
            // Variabel untuk menampung pengaturan style title, row header, dan row data tabel
 
            //Style title
            $style_title = [
                // Set font bold
                'font' => ['bold' => true],
                //Set aligntment di middle
                'alignment' => [
                    'horizontal' => PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ]
            ];
 
            // Style row header
            $style_col = [
                // Set font bold
                'font' => ['bold' => true],
                //Set aligntment di middle
                'alignment' => [
                    'horizontal' => PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                //Set border atas, bawah, kanan kiri cell dengan garis tipis
                'borders' => [
                    'top' => ['borderStyle'  => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    'right' => ['borderStyle'  => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    'bottom' => ['borderStyle'  => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    'left' => ['borderStyle'  => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
                ]
            ];
 
            // Style row data
            $style_row = [
                //Set aligntment di tengah
                'alignment' => [
                    'vertical' => PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                //Set border atas, bawah, kanan kiri cell dengan garis tipis
                'borders' => [
                    'top' => ['borderStyle'  => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    'right' => ['borderStyle'  => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    'bottom' => ['borderStyle'  => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    'left' => ['borderStyle'  => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
              ]
            ];
            // Style row data
            $style_row_center = [
                //Set aligntment di tengah
                'alignment' => [
                    'horizontal' => PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                //Set border atas, bawah, kanan kiri cell dengan garis tipis
                'borders' => [
                    'top' => ['borderStyle'  => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    'right' => ['borderStyle'  => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    'bottom' => ['borderStyle'  => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    'left' => ['borderStyle'  => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
              ]
            ];


            $drawing->setPath('./file/excel/pcs fix.png'); 
            $drawing->setHeight(90);
            $drawing->setCoordinates('A1');
            $drawing->setOffsetX(13);
            $drawing->setOffsetY(-7);
            $drawing->getShadow()->setVisible(true);
            $drawing->getShadow()->setDirection(45);
            $drawing->setWorksheet($sheet);

            $drawing1->setPath('./file/excel/k3 fix.png');
            $drawing1->setHeight(50);
            $drawing1->setCoordinates('I1');
            $drawing1->setOffsetX(-20);
            $drawing1->setOffsetY(17);
            $drawing1->getShadow()->setVisible(true);
            $drawing1->getShadow()->setDirection(45);
            $drawing1->setWorksheet($sheet);

            $drawing2->setPath('./file/excel/safety fix.png');
            $drawing2->setHeight(50);
            $drawing2->setCoordinates('I1');
            $drawing2->setOffsetX(39);
            $drawing2->setOffsetY(17);
            $drawing2->getShadow()->setVisible(true);
            $drawing2->getShadow()->setDirection(45);
            $drawing2->setWorksheet($sheet);

            $sheet->mergeCells('A1:I4');
 
            $sheet->setCellValue('A5', "No");
            $sheet->setCellValue('B5', "Nama User");
            $sheet->setCellValue('C5', "Email");
            $sheet->setCellValue('D5', "Jabatan");
            $sheet->setCellValue('E5', "Perusahaan");
            $sheet->setCellValue('F5', "Role");
            $sheet->setCellValue('G5', "Handphone");
            $sheet->setCellValue('H5', "Tanda Tangan");
            $sheet->setCellValue('I5', "Status");
            
            // Apply style judul tabel dan row header 
            $sheet->getStyle('A1:I4')->applyFromArray($style_col);
            $sheet->getStyle('A5')->applyFromArray($style_col);
            $sheet->getStyle('B5')->applyFromArray($style_col);
            $sheet->getStyle('C5')->applyFromArray($style_col);
            $sheet->getStyle('D5')->applyFromArray($style_col);
            $sheet->getStyle('E5')->applyFromArray($style_col);
            $sheet->getStyle('F5')->applyFromArray($style_col);
            $sheet->getStyle('G5')->applyFromArray($style_col);
            $sheet->getStyle('H5')->applyFromArray($style_col);
            $sheet->getStyle('I5')->applyFromArray($style_col);
         
            // Set baris pertama untuk data tabel dimulai dari row cell 5
            $numrow = 6;
            foreach($items as $key => $v){ // Lakukan looping pada variabel siswa
 
                //Proses menghitung rata rata nilai per siswa
                // Set row data berdasarkan nama kolom masing-masing dimulai dari row cell 5
                $sheet->setCellValue('A'.$numrow, ($key+1));
                $sheet->setCellValue('B'.$numrow, $v['nama']);
                $sheet->setCellValue('C'.$numrow, $v['email']);
                $sheet->setCellValue('D'.$numrow, $v['jabatan']);
                $sheet->setCellValue('E'.$numrow, $v['nama_vendor']);
                $sheet->setCellValue('F'.$numrow, $v['nama_role']);
                $sheet->setCellValue('G'.$numrow, $v['phone']);
                $sheet->setCellValue('H'.$numrow, "http:".base_url('file/tanda_tangan/'.$v['gambar']));
                $sheet->setCellValue('I'.$numrow, $v['status']);
                  
                // Apply style row data
                $sheet->getStyle('A'.$numrow)->applyFromArray($style_row_center);
                $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
                $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
                $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
                $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
                $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
                $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
                $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
                $sheet->getStyle('I'.$numrow)->applyFromArray($style_row);
                  
                // Tambah 1, sehingga data selanjutnya akan di set pada baris selanjutnya
                $numrow++;
            }
            // Set width kolom
            $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
            $sheet->getColumnDimension('B')->setWidth(35); // Set width kolom B
            $sheet->getColumnDimension('C')->setWidth(30); // Set width kolom C
            $sheet->getColumnDimension('D')->setWidth(25); // Set width kolom C
            $sheet->getColumnDimension('E')->setWidth(20); // Set width kolom C
            $sheet->getColumnDimension('F')->setWidth(25); // Set width kolom C
            $sheet->getColumnDimension('G')->setWidth(25); // Set width kolom C
            $sheet->getColumnDimension('H')->setWidth(45); // Set width kolom C
            $sheet->getColumnDimension('I')->setWidth(20); // Set width kolom C
            
            // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
            $sheet->getDefaultRowDimension()->setRowHeight(-1);
            // Set orientasi kertas LANDSCAPE
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul sheet
            $sheet->setTitle("Laporan User");
            // Proses download file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="User.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }else{
            // print_r("Mohon maaf, data tidak dapat di export");
            $this->session->set_flashdata("error", "Mohon maaf, data tidak dapat di export");
            redirect('user');
        }
    }

}