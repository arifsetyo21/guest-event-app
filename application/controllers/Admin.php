<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        // $this->load->view('auth/login-form');
        if (isset($_SESSION['id']) == true) {
            $data = array(
                'title' => 'Halaman Adminstrator',
                'isi' => 'auth/admin/list',
            );

            $this->load->view('template/atas');
            $this->load->view('layout/home', $data);
            $this->load->view('template/bawah');

            // echo "<a href='".base_url('index.php/Auth/logout')."'>Logout</a>";
        } else {
            redirect(base_url('index.php/Auth'), 'refresh');
        }

    }

    public function logout()
    {
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        redirect('Auth');
    }
}
