<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auth');
    }

    public function index()
    {
        if (!$this->auth->validation('login')) {
            $title = 'Login | B@LICOM';
            $this->load->view('template/luar/headerL', compact('title'));
            $this->load->view('Auth/login');
            $this->load->view('template/luar/footerL', compact('title'));
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array(); 

        if ($user) {
            //user is added
            if ($user['is_active'] == 1) {
                //check email activate
                if (password_verify($password, $user['password'])) {
                    //check password
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('User');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><center>Wrong Password!</center></div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><center>This Email has not been activated!</center></div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><center>Email is not registered!</center></div>');
            redirect('Auth');
        }
    }

    public function register()
    {
        if (!$this->auth->validation()) {
            $title = 'Register | B@LICOM';
            $this->load->view('template/luar/headerL', compact('title'));
            $this->load->view('Auth/register');
            $this->load->view('template/luar/footerL', compact('title'));
        } else {
            $this->auth->query_insert();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><center>Congratulation! your account has been created. Please Login!</center></div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $data = ['email', 'role_id'];
        $this->session->unset_userdata($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><center>You have been logged out!</center></div>');
        redirect('auth');
    }
}

/* End of file Auth.php */
