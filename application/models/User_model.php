<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    function get_user_by($field, $value)
    {
        return $this->db->get_where('user', ["$field" => $value])->row();
    }

    // Tambah percobaan login dan atur waktu blokir jika mencapai 5 kali
    public function increment_login_attempts($username)
    {
        $this->db->set('login_attempts', 'login_attempts+1', FALSE);
        $this->db->set('last_login_attempt', 'NOW()', FALSE); // Atur waktu percobaan login terakhir

        // Jika login_attempts >= 5, tetapkan waktu blokir
        $this->db->where('username', $username);
        $this->db->update('user');
    }

    // Reset percobaan login setelah berhasil login
    public function reset_login_attempts($username)
    {
        $this->db->set('login_attempts', 0); // Reset percobaan login
        $this->db->set('last_login_attempt', NULL); // Reset waktu percobaan login terakhir
        $this->db->where('username', $username);
        $this->db->update('user');
    }
}
