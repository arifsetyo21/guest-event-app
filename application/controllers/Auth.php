<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $this->load->view('auth/login-form');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        if ($this->db->query("SELECT * FROM admins WHERE `username` = '$username' AND `password` = '$password'") == true) {
            $data = $this->db->query("SELECT * FROM admins WHERE `username` = '$username' AND `password` = '$password'")->result_array();

            foreach ($data as $key => $sData) {
                $_SESSION['id'] = $sData['admin_id'];
                $_SESSION['username'] = $sData['username'];
            }

            redirect(base_url('index.php/Admin'), 'refresh');
        } else {
            redirect(base_url('index.php/Auth'), 'refresh');
        }

    }

    public function logout()
    {
        session_destroy();
        redirect(base_url('index.php/Auth'), 'refresh');
    }
}
