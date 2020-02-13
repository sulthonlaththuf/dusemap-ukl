<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model', 'menu');
        $this->load->model('Borrow_model', 'borrow');
    }

    public function edit_item()
    {
        if (!$_POST) {
            $input = (object)$this->menu->getDefaultValues();
        } else {
            $input = (object)$this->input->post();
        }
        if (!$this->menu->validation()) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['title'] = 'Edit Item';
            $data['items'] = $this->menu->getItem();
            $this->load->view('template/dalam/headerD', $data);
            $this->load->view('template/dalam/sidebarD', $data);
            $this->load->view('template/dalam/topbarD', $data);
            $this->load->view('menu/edit_item', $data);
            $this->load->view('template/dalam/footerD');
            return;
        }

        $this->menu->insertItem($input);
        redirect('menu/edit_item');
    }

    public function users()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Users';
        $data['users'] = $this->menu->getUsers();
        $this->load->view('template/dalam/headerD', $data);
        $this->load->view('template/dalam/sidebarD', $data);
        $this->load->view('template/dalam/topbarD', $data);
        $this->load->view('menu/users', $data);
        $this->load->view('template/dalam/footerD');
    }

    public function DeleteItem()
    {
        $id = $this->input->post('id_item');
        $item = $this->menu->get($id);

        if (!$item) redirect('menu/edit_item');

        $this->menu->deleteItem($id);
        redirect('menu/edit_item');
    }

    public function UpdateItem($id)
    {
        $item = $this->menu->get($id);
        if (!$item) redirect('Menu');

        if (!$_POST) {
            $input = (object)$item;
        } else {
            $input = (object)$this->input->post();
        }

        $this->menu->updateItem($id, $input);
        redirect('Menu/edit_item');
    }

    public function Borrower()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Borrower';
        $data['borrower'] = $this->menu->getBorrower_J();
        $this->load->view('template/dalam/headerD', $data);
        $this->load->view('template/dalam/sidebarD', $data);
        $this->load->view('template/dalam/topbarD', $data);
        $this->load->view('menu/borrower', $data);
        $this->load->view('template/dalam/footerD');
    }

    public function AdminVerify($id, $id_item)
    {
        $item = $this->borrow->get($id);
        $real_value = $this->menu->get($id_item);
        if (!$item) redirect('Borrow');

        if (!$_POST) {
            $input = (object)$item;
        } else {
            $input = (object)$this->input->post();
        }

        $this->borrow->AdminVerify_M($id, $input);
        $this->menu->decrease_quantity($real_value, $input);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><center>An item has been verified</center></div>');
        redirect('Menu/verify');
    }

    public function Verify()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Verify';
        $data['borrower'] = $this->menu->getBorrower_J();
        $this->load->view('template/dalam/headerD', $data);
        $this->load->view('template/dalam/sidebarD', $data);
        $this->load->view('template/dalam/topbarD', $data);
        $this->load->view('menu/Verify', $data);
        $this->load->view('template/dalam/footerD');
    }
}
/* End of file Menu.php */

// id_borrow, id_user, id_item, quantity_borrow, date_borrow, date_end, reason, id_admin, id_status
