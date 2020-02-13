<?php


defined('BASEPATH') or exit('No direct script access allowed');

class auth_model extends CI_Model
{

    public $table = 'user';

    public function validation($require = 'register')
    {
        if ($require == 'login') {
            $rules = $this->getValidationRulesLogin();
        } else {
            $rules = $this->getValidationRules();
        }
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters('<small class="text-danger pl-3">', '</small>');
        return $this->form_validation->run();
    }

    public function session()
    {
        return $this->session->userdata();
    }

    protected function getValidationRulesLogin()
    {
        return [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
                'errors' => [
                    'valid_email' => 'This is not an email !'
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            ]
        ];
    }

    protected function getValidationRules()
    {
        return [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'valid_email|required|trim|is_unique[user.email]',
                'errors' => [
                    'valid_email' => 'This is not an email !',
                    'is_unique' => 'This email has already registered !'
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[3]|matches[password2]',
                'errors' => [
                    'matches' => 'Password dont match !',
                    'min_length' => 'Password too short !'
                ]

            ],
            [
                'field' => 'password2',
                'label' => 'Password',
                'rules' => 'trim|required|matches[password]'

            ]
        ];
    }

    public function query_insert()
    {
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 1,
            'date_created' => time()
        ];
        $this->db->insert($this->table, $data);
    }

    public function validSession()
    {
        return $query = "SELECT user . role_id, user_access_menu . role_id, user_access_menu . menu_id, user_menu . id 
                        FROM user JOIN user_access_menu ON user . role_id = user_access_menu . role_id 
                        JOIN user_menu ON user_access_menu . 
                ";
    }
}

/* End of file auth_model.php */
