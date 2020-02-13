<?php


defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function index()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $title = 'My Profile';
        $main_view = 'user/index';
        $this->load->view('template/dalam/headerD', compact('title', 'user'));
        $this->load->view('template/dalam/sidebarD', compact('title', 'user'));
        $this->load->view('template/dalam/topbarD', compact('title', 'user'));
        $this->load->view('user/index', compact('title', 'user'));
        $this->load->view('template/dalam/footerD');
    }
}

/* End of file User.php */
