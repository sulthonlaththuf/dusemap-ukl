<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        $data['jumlahBarang'] = $this->db->get('item')->num_rows();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Dashboard';
        $this->load->view('template/dalam/headerD', $data);
        $this->load->view('template/dalam/sidebarD', $data);
        $this->load->view('template/dalam/topbarD', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/dalam/footerD');
    }
}

/* End of file Admin.php */
// ketika user meminjam, maka barang yang dipinjam masuk ke database dan menunggu verifikasi dari admin dengan cara menduplicate data yang telah ada di database dan dimasukkan ke database peminjam
