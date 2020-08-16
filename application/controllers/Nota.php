<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nota extends CI_Controller
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
        $data['title'] = 'Nota Pemesanan';

        $this->db->group_by('tipe');
        $this->db->order_by('tipe', 'ASC');
        $data['pesan'] = $this->db->get('pemesanan')->result_array();
        $data['nota'] = $this->db->query("SELECT * FROM nota")->result_array();
        
        if(isset($_POST['cari'])){
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $data['nota'] = $this->db->query("SELECT * FROM nota WHERE MONTH(tgl_nota)='$bulan' AND YEAR(tgl_nota)='$tahun' ")->result_array();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('nota/index', $data);
        $this->load->view('templates/footer', $data);
    }


    public function aksi()
    {
        if(isset($_POST['simpan'])){
            $data = [
                'nama_unit' => htmlspecialchars($this->input->post('nama_unit')),
                'sebanyak' => htmlspecialchars($this->input->post('sebanyak')),
                'harga' => htmlspecialchars($this->input->post('harga')),
                'jumlah' => htmlspecialchars($this->input->post('sebanyak')*$this->input->post('harga')),
                'tgl_nota' => htmlspecialchars($this->input->post('tgl_nota')),
            ];

            $this->db->insert('nota', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Tambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Nota');
        }elseif(isset($_POST['ubah'])){
            $data = [
                'nama_unit' => htmlspecialchars($this->input->post('nama_unit')),
                'sebanyak' => htmlspecialchars($this->input->post('sebanyak')),
                'harga' => htmlspecialchars($this->input->post('harga')),
                'jumlah' => htmlspecialchars($this->input->post('sebanyak')*$this->input->post('harga'))
            ];

            $this->db->where('id_nota', $this->input->post('id_nota'));
            $this->db->update('nota', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Ubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Nota');
        }
    }

    function hapus($id)
    {
       $this->db->where('id_nota', $id);
       $this->db->delete('nota');
       $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil di Hapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('Nota');
    }

    public function dt_ubah()
    {
        if ($_POST['id_nota']) {
            $kd = $_POST['id_nota'];
            $data['data'] = $this->db->get_where('nota', ['id_nota' => $kd])->row_array();

            $this->load->view('nota/_uPesan', $data);
        }
    }

}