<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public $item = 'item';
    public $users = 'user';
    public $borrow = 'borrow';

    public function getSubMenu()
    {
        $query = "SELECT user_sub_menu . *, user_menu . menu 
            FROM user_sub_menu JOIN user_menu
            ON user_sub_menu . menu_id = user_menu . id
            ";

        return $this->db->query($query)->result_array();
    }

    public function getDefaultValues()
    {
        return [
            'item' => '',
            'quantity' => '',
            'information' => ''
        ];
    }

    public function validation()
    {
        $rules = $this->getValidationRules();
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        return $this->form_validation->run();
    }

    protected function getValidationRules()
    {
        return [
            [
                'field' => 'item',
                'label' => 'Item',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'quantity',
                'label' => 'Quantity',
                'rules' => 'required|trim|integer'
            ],
            [
                'field' => 'information',
                'label' => 'Information',
                'rules' => 'trim|required'
            ]
        ];
    }

    public function updateItem($id, $item)
    {
        $this->db->where('id_item', $id)->update($this->item, $item);
    }

    public function insertItem($newItem)
    {
        $this->db->insert($this->item, $newItem);
        return $this->db->insert_id();
    }

    public function getItem()
    {
        return $this->db->get($this->item)->result_array();
    }

    public function getUsers()
    {
        return $this->db->get($this->users)->result_array();
    }

    public function get($id)
    {
        return $this->db->where('id_item', $id)
            ->get($this->item)
            ->row();
    }

    public function deleteItem($id)
    {
        $this->db->where('id_item', $id)->delete($this->item);
    }

    public function getBorrower()
    {
        return $this->db->get($this->borrow)->result_array();
    }

    public function getBorrower_J()
    {
        $query = "SELECT borrow . *, user . name , item . item, status . status
            FROM borrow JOIN user
            ON borrow . id_user = user . id
            JOIN item
            ON borrow. id_item = item . id_item
            JOIN status
            ON borrow . id_status = status . id_status
            ";

        // $query2 = "SELECT borrow . *, item . item
        //         FROM borrow JOIN item
        //         ON borrow . id_item = user . id_item
        //         ";

        // $query = array($query1, $query2);

        return $this->db->query($query)->result_array();
    }

    public function decrease_quantity($real_value, $input)
    {
        $id = $real_value->id_item;

        $quantity_item = $real_value->quantity;
        $quantity_borrow = $input->quantity_borrow;

        $real_quantity = $quantity_item - $quantity_borrow;

        if ($real_quantity < 0) {
            return $this->session->flashdata('message', '<div class="alert alert-danger" role="alert"><center>Wrong Password!</center></div>');
            redirect('menu/verify');
        } else {
            $quantity = ['quantity' => $real_quantity];

            $this->updateItem($id, $quantity);
        }
    }

    public function returnQuantity($real_value, $input)
    {
        $id = $real_value->id_item;

        $quantity_item = $real_value->quantity;
        $quantity_borrow = $input->quantity_borrow;

        $real_quantity = $quantity_item + $quantity_borrow;

        $quantity = ['quantity' => $real_quantity];
        $this->updateItem($id, $quantity);
    }
}

/* End of file Menu_model.php */
