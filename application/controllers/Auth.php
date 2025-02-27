<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('base_model');
    }

    public function index()
    {
        $is_login = $this->session->userdata('is_login');
        if ($is_login) redirect('dashboard');

        $this->form_validation->set_rules('username', 'Username', 'trim|callback_validate_username');
        $this->form_validation->set_rules('password', 'Password', 'trim|callback_validate_password');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Page';
            $this->load->view('auth/login', $data);
        } else {
            $username = $this->input->post('username');
            $this->_login($username);
        }
    }

    public function validate_username($username)
    {
        if (empty($username)) {
            $this->form_validation->set_message('validate_username', 'Silahkan masukan username');
            return FALSE;
        }

        $user = $this->base_model->get_one_data_by('user', 'username', $username);

        if (is_null($user)) {
            $this->form_validation->set_message('validate_username', 'Username tidak ditemukan');
            return FALSE;
        }

        return TRUE;
    }

    public function validate_password($password)
    {
        if (empty($password)) {
            $this->form_validation->set_message('validate_password', 'Silahkan masukan password');
            return FALSE;
        }

        $username = $this->input->post('username');
        $user = $this->base_model->get_one_data_by('user', 'username', $username);

        if (is_null($user)) {
            $this->form_validation->set_message('validate_password', '');
            return FALSE;
        }

        if (!password_verify($password, $user->password)) {
            $this->form_validation->set_message('validate_password', 'Password salah');
            return FALSE;
        }

        return TRUE;
    }

    private function _login($username)
    {
        $user = $this->base_model->get_one_data_by('user', 'username', $username);
        $kependudukan = $this->base_model->get_one_data_by('kependudukan', 'id_kependudukan', $user->id_kependudukan);

        $data = [
            'is_login' => TRUE,
            'username' => $user->username,
            'id_kependudukan' => $user->id_kependudukan,
            'role' => $user->role,
            'nama' => $kependudukan->nama
        ];

        $this->session->set_userdata($data);
        redirect("dashboard");
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect();
    }
}
