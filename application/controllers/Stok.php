<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok extends CI_Controller
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
        $data['title'] = 'Stok Unit';

        $data['stok'] = $this->db->query("SELECT * FROM stok")->result_array();
        
        if(isset($_POST['cari'])){
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $data['stok'] = $this->db->query("SELECT * FROM stok WHERE MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' ")->result_array();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('stok/index', $data);
        $this->load->view('templates/footer', $data);
    }


    public function aksi()
    {
        if(isset($_POST['simpan'])){
            $data = [
                'tgl' => htmlspecialchars($this->input->post('tgl')),
                'no_rangka' => htmlspecialchars($this->input->post('no_rangka')),
                'nama_unit' => htmlspecialchars($this->input->post('nama_unit')),
                'tipe' => htmlspecialchars($this->input->post('tipe')),
                'warna' => htmlspecialchars($this->input->post('warna')),
                'sisa' => htmlspecialchars($this->input->post('sisa')),
                'satuan' => htmlspecialchars($this->input->post('satuan')),
                'stok_masuk' => htmlspecialchars($this->input->post('stok_masuk')),
                'stok_keluar' => htmlspecialchars($this->input->post('stok_keluar')),
                'sisa_stok' => htmlspecialchars($this->input->post('sisa_stok')),
            ];

            $this->db->insert('stok', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Tambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Stok');
        }elseif(isset($_POST['ubah'])){
            $data = [
                'tgl' => htmlspecialchars($this->input->post('tgl')),
                'no_rangka' => htmlspecialchars($this->input->post('no_rangka')),
                'nama_unit' => htmlspecialchars($this->input->post('nama_unit')),
                'tipe' => htmlspecialchars($this->input->post('tipe')),
                'warna' => htmlspecialchars($this->input->post('warna')),
                'sisa' => htmlspecialchars($this->input->post('sisa')),
                'satuan' => htmlspecialchars($this->input->post('satuan')),
                'stok_masuk' => htmlspecialchars($this->input->post('stok_masuk')),
                'stok_keluar' => htmlspecialchars($this->input->post('stok_keluar')),
                'sisa_stok' => htmlspecialchars($this->input->post('stok_masuk')-$this->input->post('stok_keluar')),
            ];

            $this->db->where('id_stok', $this->input->post('id_stok'));
            $this->db->update('stok', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Ubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Stok');
        }
    }

    function hapus($id)
    {
       $this->db->where('id_stok', $id);
       $this->db->delete('stok');
       $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Hapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('Stok');
    }

    public function dt_view()
    {
        if ($_POST['id_stok']) {
            $kd = $_POST['id_stok'];
            $data['data'] = $this->db->get_where('stok', ['id_stok' => $kd])->row_array();

            $this->load->view('stok/_vStok', $data);
        }
    }

    public function dt_ubah()
    {
        if ($_POST['id_stok']) {
            $kd = $_POST['id_stok'];
            $data['data'] = $this->db->get_where('stok', ['id_stok' => $kd])->row_array();

            $this->load->view('stok/_uStok', $data);
        }
    }

}