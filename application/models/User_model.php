<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    function get_user(): array
    {
        $query = "SELECT kependudukan.id_kependudukan AS id_penduduk, kependudukan.nama, kependudukan.nik, user.* 
        FROM kependudukan
        LEFT JOIN user ON kependudukan.id_kependudukan = user.id_kependudukan
        ORDER BY user.id_user IS NULL, user.id_user";
        // LIMIT 100 OFFSET 0";
        return $this->db->query($query)->result();
    }
}
