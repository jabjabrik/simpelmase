<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        authorize_user();
    }

    public function index()
    {
        $query = "SELECT kependudukan.id_kependudukan AS id_penduduk, kependudukan.nama, kependudukan.nik, user.* 
        FROM kependudukan
        LEFT JOIN user ON kependudukan.id_kependudukan = user.id_kependudukan
        LIMIT 100 OFFSET 0";
        $data['user'] = $this->db->query($query)->result();
        $data['title'] = 'User';
        $this->load->view('user/index', $data);
    }

    public function create()
    {
        $username = htmlspecialchars($this->input->post('username', true));
        $password = htmlspecialchars($this->input->post('password', true));

        $is_exist_username = $this->db->get_where('user', array('username' => $username))->num_rows() > 0;

        if ($is_exist_username) {
            set_alert("Username '$username' telah terpakai, Mohon inputkan username baru.", 'danger');
            redirect('user');
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = array(
            'id_kependudukan' => htmlspecialchars($this->input->post('id_kependudukan', true)),
            'username' => $username,
            'password' => $hashed_password,
            'role' => htmlspecialchars($this->input->post('role', true)),
        );

        $result = $this->db->insert('user', $data);
        if ($result) {
            set_alert('Berhasil Menambahkan User baru', 'success');
        } else {
            set_alert('Gagal Menambahkan User baru', 'danger');
        }

        redirect('user');
    }

    public function edit()
    {
        $id_kependudukan = $this->input->post('id_kependudukan');
        $username = $this->input->post('username');

        $hashed_password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
        $data = array(
            'username' => $username,
            'password' => $hashed_password,
            'expired_password' => date('Y-m-d', strtotime('+1 year')),
            'role' => $this->input->post('role'),
        );

        dd($data);

        $is_exist_username = $this->db->get_where('user', array('username' => $username))->num_rows() > 0;
        $query = $this->db->get_where('user', array('id_kependudukan' => $id_kependudukan));

        if ($is_exist_username && $username != $query->row('username')) {
            set_alert("Username '$username' telah terpakai, Mohon inputkan username baru.", 'danger');
        } else {
            $this->db->where('id_kependudukan', $id_kependudukan);
            $result = $this->db->update('user', $data);

            if ($result) {
                set_alert('User Berhasil di Update', 'success');
            } else {
                set_alert('User Gagal di Update', 'danger');
            }
        }

        redirect('user');
    }

    public function delete($id_kependudukan)
    {
        $this->db->where('id_kependudukan', $id_kependudukan);
        $result = $this->db->delete('user');

        if ($result) {
            set_alert('User Berhasil di Hapus', 'success');
        } else {
            set_alert('User Gagal di Hapus', 'danger');
        }
        redirect('user');
    }

    public function changePassword()
    {
        $this->db->where('id_kependudukan', $id_kependudukan);
        $result = $this->db->delete('user');

        if ($result) {
            set_alert('User Berhasil di Hapus', 'success');
        } else {
            set_alert('User Gagal di Hapus', 'danger');
        }
        redirect('user');
    }
}
