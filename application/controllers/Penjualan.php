<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != '1') {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Historis Penjualan Unit';

        $data['historis'] = $this->db->query("SELECT * FROM historis")->result_array();
        
        if(isset($_POST['cari'])){
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $data['historis'] = $this->db->query("SELECT * FROM historis WHERE MONTH(tgl_penjualan)='$bulan' AND YEAR(tgl_penjualan)='$tahun' ORDER BY tgl_penjualan ASC")->result_array();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penjualan/index', $data);
        $this->load->view('templates/footer', $data);

    }

    public function aksi()
    {
        if(isset($_POST['simpan'])){
            $data = [
                'tgl_penjualan' => htmlspecialchars($this->input->post('tgl_penjualan')),
                'nama_customer' => htmlspecialchars($this->input->post('nama_customer')),
                'no_telp' => htmlspecialchars($this->input->post('no_telp')),
                'type' => htmlspecialchars($this->input->post('type')),
                'no_rangka' => htmlspecialchars($this->input->post('no_rangka')),
                'sales' => htmlspecialchars($this->input->post('sales')),
                'hasil_penjualan' => htmlspecialchars($this->input->post('hasil_penjualan')),
                'singkat' => htmlspecialchars($this->input->post('singkat')),
            ];

            $this->db->insert('historis', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Tambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Penjualan');
        }elseif(isset($_POST['ubah'])){
            $data = [
                'tgl_penjualan' => htmlspecialchars($this->input->post('tgl_penjualan')),
                'nama_customer' => htmlspecialchars($this->input->post('nama_customer')),
                'no_telp' => htmlspecialchars($this->input->post('no_telp')),
                'type' => htmlspecialchars($this->input->post('type')),
                'no_rangka' => htmlspecialchars($this->input->post('no_rangka')),
                'sales' => htmlspecialchars($this->input->post('sales')),
                'hasil_penjualan' => htmlspecialchars($this->input->post('hasil_penjualan')),
                'singkat' => htmlspecialchars($this->input->post('singkat')),
            ];

            $this->db->where('id_historis', $this->input->post('id_historis'));
            $this->db->update('historis', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Ubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Penjualan');
        }
    }

    function hapus($id)
    {
       $this->db->where('id_historis', $id);
       $this->db->delete('historis');
       $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Hapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('Penjualan');
    }

    public function dt_view()
    {
        if ($_POST['id_historis']) {
            $kd = $_POST['id_historis'];
            $data['data'] = $this->db->get_where('historis', ['id_historis' => $kd])->row_array();

            $this->load->view('penjualan/_vHisto', $data);
        }
    }

    public function dt_ubah()
    {
        if ($_POST['id_historis']) {
            $kd = $_POST['id_historis'];
            $data['data'] = $this->db->get_where('historis', ['id_historis' => $kd])->row_array();

            $this->load->view('penjualan/_uHisto', $data);
        }
    }

}