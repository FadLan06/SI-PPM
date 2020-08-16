<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends CI_Controller
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
        $data['title'] = 'Permintaan Kendaraan SPK';

        $data['permintaan'] = $this->db->query("SELECT * FROM permintaan");

        if(isset($_POST['cari'])){
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $data['permintaan'] = $this->db->query("SELECT * FROM permintaan WHERE MONTH(tgl_spk)='$bulan' AND YEAR(tgl_spk)='$tahun' ");
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('permintaan/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function aksi()
    {
        if(isset($_POST['simpan'])){
            $data = [
                'tgl_spk' => htmlspecialchars($this->input->post('tgl_spk')),
                'no_spk' => htmlspecialchars($this->input->post('no_spk')),
                'nama_customer' => htmlspecialchars($this->input->post('nama_customer')),
                'no_telp' => htmlspecialchars($this->input->post('no_telp')),
                'nama_unit' => htmlspecialchars($this->input->post('nama_unit')),
                'type_unit' => htmlspecialchars($this->input->post('tipe_unit')),
                'warna' => htmlspecialchars($this->input->post('warna')),
                'jumlah_permintaan' => htmlspecialchars($this->input->post('jumlah_permintaan')),
                'status_spk' => htmlspecialchars($this->input->post('status_spk')),
                'bayar' => htmlspecialchars($this->input->post('bayar')),
                'leasing' => htmlspecialchars($this->input->post('leasing')),
                'tenor' => htmlspecialchars($this->input->post('tenor')),
            ];

            $this->db->insert('permintaan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Tambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Permintaan');
        }elseif(isset($_POST['ubah'])){
            $data = [
                'tgl_spk' => htmlspecialchars($this->input->post('tgl_spk')),
                'no_spk' => htmlspecialchars($this->input->post('no_spk')),
                'nama_customer' => htmlspecialchars($this->input->post('nama_customer')),
                'no_telp' => htmlspecialchars($this->input->post('no_telp')),
                'nama_unit' => htmlspecialchars($this->input->post('nama_unit')),
                'type_unit' => htmlspecialchars($this->input->post('tipe_unit')),
                'warna' => htmlspecialchars($this->input->post('warna')),
                'jumlah_permintaan' => htmlspecialchars($this->input->post('jumlah_permintaan')),
                'status_spk' => htmlspecialchars($this->input->post('status_spk')),
                'bayar' => htmlspecialchars($this->input->post('bayar')),
                'leasing' => htmlspecialchars($this->input->post('leasing')),
                'tenor' => htmlspecialchars($this->input->post('tenor')),
            ];

            $this->db->where('id_permintaan', $this->input->post('id_permintaan'));
            $this->db->update('permintaan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Ubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Permintaan');
        }
    }

    function hapus($id)
    {
       $this->db->where('id_permintaan', $id);
       $this->db->delete('permintaan');
       $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Hapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('Permintaan');
    }

    public function dt_view()
    {
        if ($_POST['id_permintaan']) {
            $kd = $_POST['id_permintaan'];
            $data['data'] = $this->db->get_where('permintaan', ['id_permintaan' => $kd])->row_array();

            $this->load->view('permintaan/_vPermin', $data);
        }
    }

    public function dt_ubah()
    {
        if ($_POST['id_permintaan']) {
            $kd = $_POST['id_permintaan'];
            $data['data'] = $this->db->get_where('permintaan', ['id_permintaan' => $kd])->row_array();

            $this->load->view('permintaan/_uPermin', $data);
        }
    }
}