<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eoq extends CI_Controller
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
        $data['title'] = 'Persediaan EOQ';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('eoq/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function view()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Persediaan EOQ';

        $this->db->order_by('waktu', 'DESC');
        $data['fore'] = $this->db->get_where('ramalan',['tipe' => $this->uri->segment(3)])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('eoq/view', $data);
        $this->load->view('templates/footer', $data);
    }

    function aksi()
    {
        if(isset($_POST['simpan'])){
            $tipe = htmlspecialchars($this->input->post('tipe'));
            $data = [
                'permintaan'    => htmlspecialchars($this->input->post('permintaan')),
                'hbeli'         => htmlspecialchars($this->input->post('hbeli')),
                'hjual'         => htmlspecialchars($this->input->post('bpesan')),
                'bsimpan'       => htmlspecialchars($this->input->post('bsimpan')),
                'hkerja'        => htmlspecialchars($this->input->post('hkerja')),
                'terlambat'     => htmlspecialchars($this->input->post('terlambat')),
                'eoq'           => htmlspecialchars($this->input->post('eoq1')),
                'q'             => htmlspecialchars($this->input->post('q1')),
                'frekuensi'     => htmlspecialchars($this->input->post('frekuensi1')),
                'interval'      => htmlspecialchars($this->input->post('interval1')),
                'safety'        => htmlspecialchars($this->input->post('safety1')),
                'reorder'       => htmlspecialchars($this->input->post('reorder1')),
                'tic'           => htmlspecialchars($this->input->post('tic1')),
                'toc'           => htmlspecialchars($this->input->post('toc1')),
                'tcc'           => htmlspecialchars($this->input->post('tcc1')),
                'tipe'          => htmlspecialchars($this->input->post('tipe')),
                'waktu'         => date('y-m-d H:i:s')
            ];

            $this->db->insert('eoq', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Simpan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            // redirect('Eoq/View/'.$tipe);
            redirect('Eoq');
        }
    }

}