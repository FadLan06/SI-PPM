<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (($this->session->userdata('role_id') != '1') && ($this->session->userdata('role_id') != '3') && ($this->session->userdata('role_id') != '4')) {
            redirect('Auth');
        }
    }

    public function permintaan()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Laporan Permintaan Kendaraan';

        if(isset($_POST['cari'])){
            $filter = $this->input->post('filter');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');

            if($filter == 'semua'){
                $data['permintaan'] = $this->db->query("SELECT * FROM permintaan");
            }elseif($filter == '2'){
                $data['permintaan'] = $this->db->query("SELECT * FROM permintaan WHERE MONTH(tgl_spk)='$bulan' AND YEAR(tgl_spk)='$tahun'");
            }elseif($filter == '3'){
                $data['permintaan'] = $this->db->query("SELECT * FROM permintaan WHERE YEAR(tgl_spk)='$tahun'");
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/permintaan', $data);
        $this->load->view('templates/footer', $data);
    }

    function permintaan_()
    {
        if(isset($_POST['cetak']))
        {
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $data['title'] = 'Laporan Permintaan Kendaraan';

            $filter = $this->input->post('filter');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');

            if($filter == 'semua'){
                $data['permintaan'] = $this->db->query("SELECT * FROM permintaan ORDER BY tgl_spk ASC");
            }elseif($filter == '2'){
                $data['permintaan'] = $this->db->query("SELECT * FROM permintaan WHERE MONTH(tgl_spk)='$bulan' AND YEAR(tgl_spk)='$tahun' ORDER BY tgl_spk ASC");
            }elseif($filter == '3'){
                $data['permintaan'] = $this->db->query("SELECT * FROM permintaan WHERE YEAR(tgl_spk)='$tahun' ORDER BY tgl_spk ASC");
            }

            $this->load->view('laporan/cetak_permin',$data);

        }
    }

    public function export_permintaan(){
        // Load plugin PHPExcel nya
        $spreadsheet = new Spreadsheet;

        $spreadsheet->getProperties()->setCreator('MFZ')
                               ->setLastModifiedBy('SI PPM PT. MITSUBISHI GORONTALO')
                               ->setTitle("Data Permintaan Kendaraan")
                               ->setSubject("Permintaan Kendaraan")
                               ->setDescription("Laporan Permintaan Kendaraan")
                               ->setKeywords("Permintaan Kendaraan");

        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('borderStyle'  =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER// Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN PERMINTAAN KENDARAAN"); 
        $spreadsheet->getActiveSheet()->mergeCells('A1:M1');
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', "Dealer"); 
        $spreadsheet->getActiveSheet()->mergeCells('A2:B2');
        $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C2', ":  PT.Sinar Gorontalo Berlian Motor");

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', "Kode Dealer"); 
        $spreadsheet->getActiveSheet()->mergeCells('A3:B3');
        $spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C3', ":  100669");

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', "Area"); 
        $spreadsheet->getActiveSheet()->mergeCells('A4:B4');
        $spreadsheet->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C4', ":  Provinsi Gorontalo");

        $filter = $this->input->post('filter');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        if($filter == 'semua'){
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('K3', 'Periode');
        $spreadsheet->getActiveSheet()->getStyle('K3')->getFont()->setBold(TRUE);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('L3', ':  Semua Periode');
        }elseif($filter == 2){
            if($bulan == 1){
              $bul = 'Januari';
            }elseif($bulan == 2){
              $bul = 'Februari';
            }elseif($bulan == 3){
              $bul = 'Maret';
            }elseif($bulan == 4){
              $bul = 'April';
            }elseif($bulan == 5){
              $bul = 'Mei';
            }elseif($bulan == 6){
              $bul = 'Juni';
            }elseif($bulan == 7){
              $bul = 'Juli';
            }elseif($bulan == 8){
              $bul = 'Agustus';
            }elseif($bulan == 9){
              $bul = 'September';
            }elseif($bulan == 10){
              $bul = 'Oktober';
            }elseif($bulan == 11){
              $bul = 'November';
            }elseif($bulan == 12){
              $bul = 'Desember';
            }
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('K3', 'Periode');
        $spreadsheet->getActiveSheet()->getStyle('K3')->getFont()->setBold(TRUE);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('L3', ':  '.$bul.' '.$tahun);
        }elseif($filter == 3){
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('K3', 'Periode');
        $spreadsheet->getActiveSheet()->getStyle('K3')->getFont()->setBold(TRUE);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('L3', ':  '.$tahun);
        }

        $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A6', 'NO')
                  ->setCellValue('B6', 'TANGGAL SPK')
                  ->setCellValue('C6', 'NO SPK')
                  ->setCellValue('D6', 'CUSTOMER')
                  ->setCellValue('E6', 'NO. TELPON')
                  ->setCellValue('F6', 'NAMA UNIT')
                  ->setCellValue('G6', 'TIPE RN')
                  ->setCellValue('H6', 'WARNA')
                  ->setCellValue('I6', 'JUMLAH')
                  ->setCellValue('J6', 'STATUS SPK')
                  ->setCellValue('K6', 'METODE BAYAR')
                  ->setCellValue('L6', 'LEASING')
                  ->setCellValue('M6', 'TENOR');

        $spreadsheet->getActiveSheet()->getStyle('A6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('B6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('C6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('D6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('G6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('H6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('I6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('J6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('K6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('L6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('M6')->applyFromArray($style_col);

        if($filter == 'semua'){
            $permintaan = $this->db->query("SELECT * FROM permintaan ORDER BY tgl_spk ASC");
        }elseif($filter == '2'){
            $permintaan = $this->db->query("SELECT * FROM permintaan WHERE MONTH(tgl_spk)='$bulan' AND YEAR(tgl_spk)='$tahun' ORDER BY tgl_spk ASC");
        }elseif($filter == '3'){
            $permintaan = $this->db->query("SELECT * FROM permintaan WHERE YEAR(tgl_spk)='$tahun' ORDER BY tgl_spk ASC");
        }

        $kolom = 7;
        $nomor = 1;
        foreach($permintaan->result() as $data) {

           $spreadsheet->setActiveSheetIndex(0)
                       ->setCellValue('A' . $kolom, $nomor)
                       ->setCellValue('B' . $kolom, date('j F Y', strtotime($data->tgl_spk)))
                       ->setCellValue('C' . $kolom, $data->no_spk)
                       ->setCellValue('D' . $kolom, $data->nama_customer)
                       ->setCellValue('E' . $kolom, $data->no_telp)
                       ->setCellValue('F' . $kolom, $data->nama_unit)
                       ->setCellValue('G' . $kolom, $data->type_unit)
                       ->setCellValue('H' . $kolom, $data->warna)
                       ->setCellValue('I' . $kolom, $data->jumlah_permintaan)
                       ->setCellValue('J' . $kolom, $data->status_spk)
                       ->setCellValue('K' . $kolom, $data->bayar)
                       ->setCellValue('L' . $kolom, $data->leasing)
                       ->setCellValue('M' . $kolom, $data->tenor);

            $spreadsheet->getActiveSheet()->getStyle('A'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('B'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('C'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('D'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('E'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('F'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('G'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('H'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('I'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('J'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('K'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('L'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('M'.$kolom)->applyFromArray($style_row);

           $kolom++;
           $nomor++;

        }

         // Set width kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(16.43); // Set width kolom B
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(12.29); // Set width kolom C
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(35); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(10); // Set width kolom E

        $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        $writer = new Xlsx($spreadsheet);

        $title = 'Laporan Permintaan Kendaraan';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$title.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function pemesanan()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Laporan Pemesanan Unit';

        if(isset($_POST['cari'])){
            $filter = $this->input->post('filter');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');

            if($filter == 'semua'){
                $data['pemesanan'] = $this->db->query("SELECT * FROM pemesanan");
            }elseif($filter == '2'){
                $data['pemesanan'] = $this->db->query("SELECT * FROM pemesanan WHERE MONTH(tgl_pesan)='$bulan' AND YEAR(tgl_pesan)='$tahun' ");
            }elseif($filter == '3'){
                $data['pemesanan'] = $this->db->query("SELECT * FROM pemesanan WHERE YEAR(tgl_pesan)='$tahun' ");
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/pemesanan', $data);
        $this->load->view('templates/footer', $data);
    }

    function pemesanan_()
    {
        if(isset($_POST['cetak']))
        {
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $data['title'] = 'Laporan Pemesanan Unit';

            $filter = $this->input->post('filter');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');

            if($filter == 'semua'){
                $data['pemesanan'] = $this->db->query("SELECT * FROM pemesanan ORDER BY tgl_pesan ASC");
            }elseif($filter == '2'){
                $data['pemesanan'] = $this->db->query("SELECT * FROM pemesanan WHERE MONTH(tgl_pesan)='$bulan' AND YEAR(tgl_pesan)='$tahun' ORDER BY tgl_pesan ASC ");
            }elseif($filter == '3'){
                $data['pemesanan'] = $this->db->query("SELECT * FROM pemesanan WHERE YEAR(tgl_pesan)='$tahun' ORDER BY tgl_pesan ASC ");
            }

            $this->load->view('laporan/cetak_pesan',$data);

        }
    }

    public function export_pemesanan(){
        // Load plugin PHPExcel nya
        $spreadsheet = new Spreadsheet;

        $spreadsheet->getProperties()->setCreator('MFZ')
                               ->setLastModifiedBy('SI PPM PT. MITSUBISHI GORONTALO')
                               ->setTitle("Data Pemesanan Unit")
                               ->setSubject("Pemesanan Unit")
                               ->setDescription("Laporan Pemesanan Unit")
                               ->setKeywords("Pemesanan Unit");

        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('borderStyle'  =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER// Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN PEMESANAN UNIT"); 
        $spreadsheet->getActiveSheet()->mergeCells('A1:F1'); 
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', 'PT. SINAR GORONTALO BERLIAN MOTOR');
        $spreadsheet->getActiveSheet()->mergeCells('A2:F2'); 
        $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
        $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
        $spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $filter = $this->input->post('filter');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        if($filter == 'semua'){
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', 'Semua Periode');
            $spreadsheet->getActiveSheet()->mergeCells('A3:F3'); 
            $spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
            $spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }elseif($filter == 2){
            if($bulan == 1){
              $bul = 'Januari';
            }elseif($bulan == 2){
              $bul = 'Februari';
            }elseif($bulan == 3){
              $bul = 'Maret';
            }elseif($bulan == 4){
              $bul = 'April';
            }elseif($bulan == 5){
              $bul = 'Mei';
            }elseif($bulan == 6){
              $bul = 'Juni';
            }elseif($bulan == 7){
              $bul = 'Juli';
            }elseif($bulan == 8){
              $bul = 'Agustus';
            }elseif($bulan == 9){
              $bul = 'September';
            }elseif($bulan == 10){
              $bul = 'Oktober';
            }elseif($bulan == 11){
              $bul = 'November';
            }elseif($bulan == 12){
              $bul = 'Desember';
            }
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', $bul.' '.$tahun);
            $spreadsheet->getActiveSheet()->mergeCells('A3:F3'); 
            $spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
            $spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }elseif($filter == 3){
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', $tahun);
            $spreadsheet->getActiveSheet()->mergeCells('A3:F3'); 
            $spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
            $spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }

        $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A5', 'NO')
                  ->setCellValue('B5', 'TANGGAL PESAN')
                  ->setCellValue('C5', 'NAMA UNIT')
                  ->setCellValue('D5', 'TYPE UNIT')
                  ->setCellValue('E5', 'WARNA')
                  ->setCellValue('F5', 'JUMLAH PESAN');

        $spreadsheet->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);

        if($filter == 'semua'){
            $pemesanan = $this->db->query("SELECT * FROM pemesanan ORDER BY tgl_pesan ASC");
        }elseif($filter == '2'){
            $pemesanan = $this->db->query("SELECT * FROM pemesanan WHERE MONTH(tgl_pesan)='$bulan' AND YEAR(tgl_pesan)='$tahun' ORDER BY tgl_pesan ASC ");
        }elseif($filter == '3'){
            $pemesanan = $this->db->query("SELECT * FROM pemesanan WHERE YEAR(tgl_pesan)='$tahun' ORDER BY tgl_pesan ASC ");
        }

        $kolom = 6;
        $nomor = 1;
        foreach($pemesanan->result() as $data) {

           $spreadsheet->setActiveSheetIndex(0)
                       ->setCellValue('A' . $kolom, $nomor)
                       ->setCellValue('B' . $kolom, date('j F Y', strtotime($data->tgl_pesan)))
                       ->setCellValue('C' . $kolom, $data->nama_unit)
                       ->setCellValue('D' . $kolom, $data->tipe)
                       ->setCellValue('E' . $kolom, $data->warna)
                       ->setCellValue('F' . $kolom, $data->jumlah_pesan.' UNIT');

            $spreadsheet->getActiveSheet()->getStyle('A'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('B'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('C'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('D'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('E'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('F'.$kolom)->applyFromArray($style_row);

           $kolom++;
           $nomor++;

        }

         // Set width kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(16.43); // Set width kolom B
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(35); // Set width kolom D
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom E

        $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        $writer = new Xlsx($spreadsheet);

        $title = 'Laporan Pemesanan Unit';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$title.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function stok()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Laporan Stok Unit';

        if(isset($_POST['cari'])){
            $filter = $this->input->post('filter');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');

            if($filter == 'semua'){
                $data['stok'] = $this->db->query("SELECT * FROM stok");
            }elseif($filter == '2'){
                $data['stok'] = $this->db->query("SELECT * FROM stok WHERE MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'");
            }elseif($filter == '3'){
                $data['stok'] = $this->db->query("SELECT * FROM stok WHERE YEAR(tgl)='$tahun'");
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/stok', $data);
        $this->load->view('templates/footer', $data);
    }

    function stok_()
    {
        if(isset($_POST['cetak']))
        {
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $data['title'] = 'Laporan Stok Unit';

            $filter = $this->input->post('filter');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');

            if($filter == 'semua'){
                $data['stok'] = $this->db->query("SELECT * FROM stok ORDER BY tgl ASC");
            }elseif($filter == '2'){
                $data['stok'] = $this->db->query("SELECT * FROM stok WHERE MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' ORDER BY tgl ASC");
            }elseif($filter == '3'){
                $data['stok'] = $this->db->query("SELECT * FROM stok WHERE YEAR(tgl)='$tahun' ORDER BY tgl ASC");
            }

            $this->load->view('laporan/cetak_stok',$data);

        }
    }

    public function export_stok(){
        // Load plugin PHPExcel nya
        $spreadsheet = new Spreadsheet;

        $spreadsheet->getProperties()->setCreator('MFZ')
                               ->setLastModifiedBy('SI PPM PT. MITSUBISHI GORONTALO')
                               ->setTitle("Data Stok Unit")
                               ->setSubject("Stok Unit")
                               ->setDescription("Laporan Stok Unit")
                               ->setKeywords("Stok Unit");

        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('borderStyle'  =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER// Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN STOK UNIT"); 
        $spreadsheet->getActiveSheet()->mergeCells('A1:K1'); 
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', "Dealer"); 
        $spreadsheet->getActiveSheet()->mergeCells('A2:B2');
        $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C2', ":  PT.Sinar Gorontalo Berlian Motor");

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', "Kode Dealer"); 
        $spreadsheet->getActiveSheet()->mergeCells('A3:B3');
        $spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C3', ":  100669");

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', "Area"); 
        $spreadsheet->getActiveSheet()->mergeCells('A4:B4');
        $spreadsheet->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C4', ":  Provinsi Gorontalo");

        $filter = $this->input->post('filter');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        if($filter == 'semua'){
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('I3', 'Periode');
        $spreadsheet->getActiveSheet()->getStyle('I3')->getFont()->setBold(TRUE);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('J3', ':  Semua Periode');
        }elseif($filter == 2){
            if($bulan == 1){
              $bul = 'Januari';
            }elseif($bulan == 2){
              $bul = 'Februari';
            }elseif($bulan == 3){
              $bul = 'Maret';
            }elseif($bulan == 4){
              $bul = 'April';
            }elseif($bulan == 5){
              $bul = 'Mei';
            }elseif($bulan == 6){
              $bul = 'Juni';
            }elseif($bulan == 7){
              $bul = 'Juli';
            }elseif($bulan == 8){
              $bul = 'Agustus';
            }elseif($bulan == 9){
              $bul = 'September';
            }elseif($bulan == 10){
              $bul = 'Oktober';
            }elseif($bulan == 11){
              $bul = 'November';
            }elseif($bulan == 12){
              $bul = 'Desember';
            }
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('I3', 'Periode');
        $spreadsheet->getActiveSheet()->getStyle('I3')->getFont()->setBold(TRUE);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('J3', ':  '.$bul.' '.$tahun);
        }elseif($filter == 3){
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('I3', 'Periode');
        $spreadsheet->getActiveSheet()->getStyle('I3')->getFont()->setBold(TRUE);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('J3', ':  '.$tahun);
        }

        $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A6', 'NO')
                  ->setCellValue('B6', 'TANGGAL')
                  ->setCellValue('C6', 'NO RANGKA')
                  ->setCellValue('D6', 'NAMA UNIT')
                  ->setCellValue('E6', 'TYPE')
                  ->setCellValue('F6', 'WARNA')
                  ->setCellValue('G6', 'SISA STOK')
                  ->setCellValue('H6', 'SATUAN')
                  ->setCellValue('I6', 'STOK MASUK')
                  ->setCellValue('J6', 'STOK KELUAR')
                  ->setCellValue('K6', 'SISA');

        $spreadsheet->getActiveSheet()->getStyle('A6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('B6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('C6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('D6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('G6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('H6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('I6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('J6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('K6')->applyFromArray($style_col);

        if($filter == 'semua'){
            $stok = $this->db->query("SELECT * FROM stok ORDER BY tgl ASC");
        }elseif($filter == '2'){
            $stok = $this->db->query("SELECT * FROM stok WHERE MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' ORDER BY tgl ASC");
        }elseif($filter == '3'){
            $stok = $this->db->query("SELECT * FROM stok WHERE YEAR(tgl)='$tahun' ORDER BY tgl ASC");
        }

        $kolom = 7;
        $nomor = 1;
        foreach($stok->result() as $data) {

           $spreadsheet->setActiveSheetIndex(0)
                       ->setCellValue('A' . $kolom, $nomor)
                       ->setCellValue('B' . $kolom, date('j F Y', strtotime($data->tgl)))
                       ->setCellValue('C' . $kolom, $data->no_rangka)
                       ->setCellValue('D' . $kolom, $data->nama_unit)
                       ->setCellValue('E' . $kolom, $data->tipe)
                       ->setCellValue('F' . $kolom, $data->warna)
                       ->setCellValue('G' . $kolom, $data->sisa)
                       ->setCellValue('H' . $kolom, $data->satuan)
                       ->setCellValue('I' . $kolom, $data->stok_masuk)
                       ->setCellValue('J' . $kolom, $data->stok_keluar)
                       ->setCellValue('K' . $kolom, $data->sisa_stok);

            $spreadsheet->getActiveSheet()->getStyle('A'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('B'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('C'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('D'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('E'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('F'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('G'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('H'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('I'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('J'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('K'.$kolom)->applyFromArray($style_row);

           $kolom++;
           $nomor++;

        }

         // Set width kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(17); // Set width kolom B
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(40); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15); // Set width kolom

        $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        $writer = new Xlsx($spreadsheet);

        $title = 'Laporan Stok Unit';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$title.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function penjualan()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Laporan Penjualan Unit';

        if(isset($_POST['cari'])){
            $filter = $this->input->post('filter');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');

            if($filter == 'semua'){
                $data['historis'] = $this->db->query("SELECT * FROM historis");
            }elseif($filter == '2'){
                $data['historis'] = $this->db->query("SELECT * FROM historis WHERE MONTH(tgl_penjualan)='$bulan' AND YEAR(tgl_penjualan)='$tahun'");
            }elseif($filter == '3'){
                $data['historis'] = $this->db->query("SELECT * FROM historis WHERE YEAR(tgl_penjualan)='$tahun'");
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/penjualan', $data);
        $this->load->view('templates/footer', $data);
    }

    function penjualan_()
    {
        if(isset($_POST['cetak']))
        {
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $data['title'] = 'Laporan Penjualan Unit';

            $filter = $this->input->post('filter');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');

            if($filter == 'semua'){
                $data['historis'] = $this->db->query("SELECT * FROM historis ORDER BY tgl_penjualan ASC");
            }elseif($filter == '2'){
                $data['historis'] = $this->db->query("SELECT * FROM historis WHERE MONTH(tgl_penjualan)='$bulan' AND YEAR(tgl_penjualan)='$tahun' ORDER BY tgl_penjualan ASC");
            }elseif($filter == '3'){
                $data['historis'] = $this->db->query("SELECT * FROM historis WHERE YEAR(tgl_penjualan)='$tahun' ORDER BY tgl_penjualan ASC");
            }

            $this->load->view('laporan/cetak_pen',$data);

        }
    }

    public function export_penjualan(){
        // Load plugin PHPExcel nya
        $spreadsheet = new Spreadsheet;

        $spreadsheet->getProperties()->setCreator('MFZ')
                               ->setLastModifiedBy('SI PPM PT. MITSUBISHI GORONTALO')
                               ->setTitle("Data Penjualan Unit")
                               ->setSubject("Penjualan Unit")
                               ->setDescription("Laporan Penjualan Unit")
                               ->setKeywords("Penjualan Unit");

        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('borderStyle'  =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER// Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN PENJUALAN UNIT"); 
        $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', "Dealer"); 
        $spreadsheet->getActiveSheet()->mergeCells('A2:B2');
        $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C2', ":  PT.Sinar Gorontalo Berlian Motor");

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', "Kode Dealer"); 
        $spreadsheet->getActiveSheet()->mergeCells('A3:B3');
        $spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C3', ":  100669");

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', "Area"); 
        $spreadsheet->getActiveSheet()->mergeCells('A4:B4');
        $spreadsheet->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C4', ":  Provinsi Gorontalo");

        $filter = $this->input->post('filter');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        if($filter == 'semua'){
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G3', 'Periode');
        $spreadsheet->getActiveSheet()->getStyle('G3')->getFont()->setBold(TRUE);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('H3', ':  Semua Data Periode');
        }elseif($filter == 2){
            if($bulan == 1){
              $bul = 'Januari';
            }elseif($bulan == 2){
              $bul = 'Februari';
            }elseif($bulan == 3){
              $bul = 'Maret';
            }elseif($bulan == 4){
              $bul = 'April';
            }elseif($bulan == 5){
              $bul = 'Mei';
            }elseif($bulan == 6){
              $bul = 'Juni';
            }elseif($bulan == 7){
              $bul = 'Juli';
            }elseif($bulan == 8){
              $bul = 'Agustus';
            }elseif($bulan == 9){
              $bul = 'September';
            }elseif($bulan == 10){
              $bul = 'Oktober';
            }elseif($bulan == 11){
              $bul = 'November';
            }elseif($bulan == 12){
              $bul = 'Desember';
            }
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G3', 'Periode');
        $spreadsheet->getActiveSheet()->getStyle('G3')->getFont()->setBold(TRUE);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('H3', ':  '.$bul.' '.$tahun);
        }elseif($filter == 3){
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G3', 'Periode');
        $spreadsheet->getActiveSheet()->getStyle('G3')->getFont()->setBold(TRUE);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('H3', ':  '.$tahun);
        }

        $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A6', 'NO')
                  ->setCellValue('B6', 'TANGGAL')
                  ->setCellValue('C6', 'NAMA CUSTOMER')
                  ->setCellValue('D6', 'NO. TELPON')
                  ->setCellValue('E6', 'TYPE')
                  ->setCellValue('F6', 'NO RANGKA')
                  ->setCellValue('G6', 'SALES')
                  ->setCellValue('H6', 'HASIL PENJUALAN');

        $spreadsheet->getActiveSheet()->getStyle('A6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('B6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('C6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('D6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('G6')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('H6')->applyFromArray($style_col);

        if($filter == 'semua'){
            $historis = $this->db->query("SELECT * FROM historis ORDER BY tgl_penjualan ASC");
        }elseif($filter == '2'){
            $historis = $this->db->query("SELECT * FROM historis WHERE MONTH(tgl_penjualan)='$bulan' AND YEAR(tgl_penjualan)='$tahun' ORDER BY tgl_penjualan ASC");
        }elseif($filter == '3'){
            $historis = $this->db->query("SELECT * FROM historis WHERE YEAR(tgl_penjualan)='$tahun' ORDER BY tgl_penjualan ASC");
        }

        $kolom = 7;
        $nomor = 1;
        foreach($historis->result() as $data) {

           $spreadsheet->setActiveSheetIndex(0)
                       ->setCellValue('A' . $kolom, $nomor)
                       ->setCellValue('B' . $kolom, date('j F Y', strtotime($data->tgl_penjualan)))
                       ->setCellValue('C' . $kolom, $data->nama_customer)
                       ->setCellValue('D' . $kolom, $data->no_telp)
                       ->setCellValue('E' . $kolom, $data->type)
                       ->setCellValue('F' . $kolom, $data->no_rangka)
                       ->setCellValue('G' . $kolom, $data->sales)
                       ->setCellValue('H' . $kolom, $data->hasil_penjualan);

            $spreadsheet->getActiveSheet()->getStyle('A'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('B'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('C'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('D'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('E'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('F'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('G'.$kolom)->applyFromArray($style_row);
            $spreadsheet->getActiveSheet()->getStyle('H'.$kolom)->applyFromArray($style_row);

           $kolom++;
           $nomor++;

        }

         // Set width kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(18); // Set width kolom B
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(40); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(23); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(32);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(58); // Set width kolom E

        $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        $writer = new Xlsx($spreadsheet);

        $title = 'Laporan Penjualan Unit';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$title.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function peramalan()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Laporan Peramalan Penjualan';

        if(isset($_POST['cari'])){
            $filter = $this->input->post('filter');

            if($filter == 'semua'){
                $data['ramalan'] = $this->db->query("SELECT tipe, waktu, mad, mse, mape FROM ramalan GROUP BY tipe ORDER BY tipe ASC");
            }elseif($filter == 'mad'){
                $data['ramalan'] = $this->db->query("SELECT tipe, waktu, mad FROM ramalan GROUP BY tipe ORDER BY tipe ASC");
            }elseif($filter == 'mse'){
                $data['ramalan'] = $this->db->query("SELECT tipe, waktu, mse FROM ramalan GROUP BY tipe ORDER BY tipe ASC");
            }elseif($filter == 'mape'){
                $data['ramalan'] = $this->db->query("SELECT tipe, waktu, mape FROM ramalan GROUP BY tipe ORDER BY tipe ASC");
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/peramalan', $data);
        $this->load->view('templates/footer', $data);
    }

    function peramalan_()
    {
        if(isset($_POST['cetak']))
        {
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $data['title'] = 'Laporan Penjualan Unit';

            $filter = $this->input->post('filter');

            if($filter == 'semua'){
                $data['ramalan'] = $this->db->query("SELECT tipe, waktu, mad, mse, mape FROM ramalan GROUP BY tipe ORDER BY tipe ASC");
            }elseif($filter == 'mad'){
                $data['ramalan'] = $this->db->query("SELECT tipe, waktu, mad FROM ramalan GROUP BY tipe ORDER BY tipe ASC");
            }elseif($filter == 'mse'){
                $data['ramalan'] = $this->db->query("SELECT tipe, waktu, mse FROM ramalan GROUP BY tipe ORDER BY tipe ASC");
            }elseif($filter == 'mape'){
                $data['ramalan'] = $this->db->query("SELECT tipe, waktu, mape FROM ramalan GROUP BY tipe ORDER BY tipe ASC");
            }

            $this->load->view('laporan/cetak_ramal',$data);

        }
    }

    public function eoq()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Laporan Persediaan EOQ';

        if(isset($_POST['cari'])){
            $filter = $this->input->post('filter');

            $this->db->order_by('waktu', 'DESC');
            $data['fore'] = $this->db->get_where('ramalan',['tipe' => $_POST['filter']])->row_array();
            $this->db->order_by('waktu', 'DESC');
            $data['eoq'] = $this->db->get_where('eoq',['tipe' => $_POST['filter']])->result_array();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/eoq', $data);
        $this->load->view('templates/footer', $data);
    }

    function eoq_()
    {
        if(isset($_POST['cetak']))
        {
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $data['title'] = 'Laporan Persediaan EOQ';

            $filter = $this->input->post('filter');

            $this->db->order_by('waktu', 'DESC');
            $data['fore'] = $this->db->get_where('ramalan',['tipe' => $_POST['filter']])->row_array();
            $this->db->order_by('waktu', 'DESC');
            $data['eoq'] = $this->db->get_where('eoq',['tipe' => $_POST['filter']])->result_array();

            $this->load->view('laporan/cetak_eoq',$data);

        }
    }
}