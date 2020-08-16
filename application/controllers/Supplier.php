<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != '2') {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Beranda';

        $data['permintaan'] = $this->db->get('permintaan')->num_rows();
        $data['pemesanan'] = $this->db->get('pemesanan')->num_rows();
        $data['stok'] = $this->db->get('stok')->num_rows();
        $data['historis'] = $this->db->get('historis')->num_rows();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('supplier/index', $data);
        $this->load->view('templates/footer', $data);

    }

}