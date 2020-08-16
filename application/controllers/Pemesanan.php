<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (($this->session->userdata('role_id') != '1') && ($this->session->userdata('role_id') != '2')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Pemesanan Unit';

        $data['pemesanan'] = $this->db->query("SELECT * FROM pemesanan");
        
        if(isset($_POST['cari'])){
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $data['pemesanan'] = $this->db->query("SELECT * FROM pemesanan WHERE MONTH(tgl_pesan)='$bulan' AND YEAR(tgl_pesan)='$tahun' ");
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pemesanan/index', $data);
        $this->load->view('templates/footer', $data);
    }


    public function aksi()
    {
        if(isset($_POST['simpan'])){
            $data = [
                'nama_unit' => htmlspecialchars($this->input->post('nama_unit')),
                'tipe' => htmlspecialchars($this->input->post('tipe')),
                'warna' => htmlspecialchars($this->input->post('warna')),
                'jumlah_pesan' => htmlspecialchars($this->input->post('jumlah_pesan')),
                'tgl_pesan' => htmlspecialchars($this->input->post('tgl_pesan')),
            ];

            $this->db->insert('pemesanan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Tambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Pemesanan');
        }elseif(isset($_POST['ubah'])){
            $data = [
                'nama_unit' => htmlspecialchars($this->input->post('nama_unit')),
                'tipe' => htmlspecialchars($this->input->post('tipe')),
                'warna' => htmlspecialchars($this->input->post('warna')),
                'jumlah_pesan' => htmlspecialchars($this->input->post('jumlah_pesan')),
            ];

            $this->db->where('id_pemesanan', $this->input->post('id_pemesanan'));
            $this->db->update('pemesanan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Ubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Pemesanan');
        }
    }

    function hapus($id)
    {
       $this->db->where('id_pemesanan', $id);
       $this->db->delete('pemesanan');
       $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Hapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('Pemesanan');
    }

    public function dt_ubah()
    {
        if ($_POST['id_pemesanan']) {
            $kd = $_POST['id_pemesanan'];
            $data['data'] = $this->db->get_where('pemesanan', ['id_pemesanan' => $kd])->row_array();

            $this->load->view('pemesanan/_uPesan', $data);
        }
    }

}