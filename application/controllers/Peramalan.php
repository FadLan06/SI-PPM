<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peramalan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != '1') {
            redirect('Auth');
        }
        date_default_timezone_set('Asia/Hong_Kong');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Peramalan Penjualan';

        if(isset($_POST['cari'])){
            $data['pen'] = $this->db->query("SELECT tgl_penjualan, COUNT(MONTH(tgl_penjualan)) as tgl FROM historis GROUP BY MONTH(tgl_penjualan), YEAR(tgl_penjualan) ORDER BY YEAR(tgl_penjualan), MONTH(tgl_penjualan) ASC");
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('peramalan/index', $data);
        $this->load->view('templates/footer', $data);
    }

    function aksi()
    {
        if(isset($_POST['simpan'])){
            $data = [
                'alpha'     => htmlspecialchars($this->input->post('alpha')),
                'forecast'  => htmlspecialchars($this->input->post('forecast')),
                'error'     => htmlspecialchars($this->input->post('error')),
                'mad'       => htmlspecialchars($this->input->post('mad')),
                'mse'       => htmlspecialchars($this->input->post('mse')),
                'mape'      => htmlspecialchars($this->input->post('mape')),
                'tipe'      => htmlspecialchars($this->input->post('tipe')),
                'waktu'     => date('y-m-d H:i:s')
            ];

            $this->db->insert('ramalan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Simpan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Peramalan');
        }
    }

}