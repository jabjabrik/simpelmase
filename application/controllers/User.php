<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        authorize_user(['sekretaris desa']);
        $this->load->model('user_model');
        $this->load->model('base_model');
    }

    public function index()
    {
        $data['data_result'] = $this->user_model->get_user();
        $data['title'] = 'User';
        $this->load->view('user/index', $data);
    }

    public function insert()
    {
        $username = htmlspecialchars($this->input->post('username', true));

        $is_exist_username = (bool)$this->base_model->get_one_data_by('user', 'username', $username);
        if ($is_exist_username) {
            set_alert("Username '$username' telah terpakai, Mohon inputkan username baru.", 'danger');
            redirect('user');
        }

        $password = htmlspecialchars($this->input->post('password', true));
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $id_kependudukan = htmlspecialchars($this->input->post('id_kependudukan', true));
        $role = htmlspecialchars($this->input->post('role', true));

        $data = array(
            'id_kependudukan' => $id_kependudukan,
            'username' => $username,
            'password' => $hashed_password,
            'role' => $role,
        );

        $this->base_model->insert('user', $data);
        set_alert('Berhasil Menambahkan User baru', 'success');
        redirect('user');
    }

    public function edit()
    {
        $id_kependudukan = htmlspecialchars($this->input->post('id_kependudukan', true));
        $username = htmlspecialchars($this->input->post('username'));

        $is_exist_username = (bool)$this->base_model->get_one_data_by('user', 'username', $username);
        $user = $this->base_model->get_one_data_by('user', 'id_kependudukan', $id_kependudukan);

        if ($is_exist_username && $username != $user->username) {
            set_alert("Username '$username' telah terpakai, Mohon inputkan username baru.", 'danger');
            redirect('user');
        }

        $role = htmlspecialchars($this->input->post('role', true));

        $data = [
            'username' => $username,
            'role' => $role,
        ];

        $password = htmlspecialchars($this->input->post('password', true));
        if ($password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $data['password'] = $hashed_password;
        }

        $this->base_model->update('user', $data, $user->id_user);
        set_alert('Data User Berhasil di Edit', 'success');
        redirect('user');
    }

    public function delete($id_kependudukan)
    {
        $this->base_model->delete('user', $id_kependudukan);
        set_alert('User Berhasil di Hapus', 'success');
        redirect('user');
    }
}
