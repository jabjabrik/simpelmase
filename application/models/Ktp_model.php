<?php

class Ktp_model extends CI_Model
{
    public function get_all(): array
    {
        $query = "SELECT kependudukan.* 
        FROM kependudukan 
        WHERE DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tanggal_lahir)), '%Y') + 0 >= 17
        AND kependudukan.hubungan_keluarga NOT IN ('kepala keluarga', 'istri', 'orang-tua', 'mertua', 'menantu');";
        return $this->db->query($query)->result();
    }
}
