<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Borrow_model extends CI_Model
{
    public $borrow = 'borrow';

    public function Borrower($borrower)
    {
        $this->db->insert($this->borrow, $borrower);
        return $this->db->insert_id();
    }

    public function ShowName($id)
    {
        $user = $this->db->get_where('user', ['id' => $id])->row_array();
        return $user['name'];
    }

    public function getDefaultValues()
    {
        return [
            'id_user' => '',
            'id_item' => '',
            'quantity' => '',
            'date_borrow' => '',
            'date_end' => '',
        ];
    }

    public function get($id)
    {
        return $this->db->where('id_borrow', $id)
            ->get($this->borrow)
            ->row();
    }

    public function AdminVerify_M($id, $admin)
    {
        $this->db->where('id_borrow', $id)->update($this->borrow, $admin);
    }

    public function toHistory($id, $status)
    {
        $this->db->where('id_borrow', $id)->update($this->borrow, $status);
    }
}

/* End of file Borrow_model.php */
