<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Borrow extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model', 'menu');
        $this->load->model('Borrow_model', 'borrow');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Items';
        $data['items'] = $this->menu->getItem();
        $this->load->view('template/dalam/headerD', $data);
        $this->load->view('template/dalam/sidebarD', $data);
        $this->load->view('template/dalam/topbarD', $data);
        $this->load->view('Borrow/index', $data);
        $this->load->view('template/dalam/footerD');
    }

    public function userBorrowing()
    {

        if (!$_POST) {
            $input = (object)$this->borrow->getDefaultValues();
        } else {
            $input = (object)$this->input->post();
        }

        $item = $this->menu->get($input->id_item);

        if ($input->quantity_borrow == $item->quantity || $input->quantity_borrow < $item->quantity && $input->quantity_borrow > 0) {
            $this->borrow->Borrower($input);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><center>Wait for verify from admin! If something happen go to our place.</center></div>');
            redirect('Borrow/index');
        } else {
            $this->session->set_flashdata('message', "<div class='alert alert-danger' role='alert'><center>Cant Borrow, quantity of $item->item is out of stock</center></div>");
            redirect('Borrow/index');
        }
    }

    public function Borrowed()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Borrowed';
        $data['borrower'] = $this->menu->getBorrower_J();
        $this->load->view('template/dalam/headerD', $data);
        $this->load->view('template/dalam/sidebarD', $data);
        $this->load->view('template/dalam/topbarD', $data);
        $this->load->view('borrow/borrowed', $data);
        $this->load->view('template/dalam/footerD');
    }

    public function ReturnItem($id_borrow, $id_item)
    {
        $idBorrow = $this->borrow->get($id_borrow);
        $real_value = $this->menu->get($id_item);
        if (!$_POST) {
            $input = (object)$idBorrow;
        } else {
            $input = (object)$this->input->post();
        }

        $this->borrow->toHistory($id_borrow, $input);
        $this->menu->returnQuantity($real_value, $input);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><center>Success to return it!</center></div>');
        redirect('Borrow/borrowed');
    }

    public function history()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'History';
        $data['borrower'] = $this->menu->getBorrower_J();
        $this->load->view('template/dalam/headerD', $data);
        $this->load->view('template/dalam/sidebarD', $data);
        $this->load->view('template/dalam/topbarD', $data);
        $this->load->view('borrow/history', $data);
        $this->load->view('template/dalam/footerD');
    }
}

/* End of file Borrow.php */
