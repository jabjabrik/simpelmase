<?php

class Ktp_model extends CI_Model
{
    public function get_all($filter, $op = null): array
    {
        $where = "";
        if ($filter == '1') {
            $where .= "AND kependudukan.status_ktp = 'belum diketahui'";
        }
        if ($filter == '2') {
            $where .= "AND kependudukan.status_ktp = 'memiliki KTP'";
        }
        if ($filter == '3') {
            $where .= "AND kependudukan.status_ktp = 'belum memiliki KTP'";
        }
        $op = $op == '>' ? '>= 17' : '< 17 ';

        $query = "SELECT kependudukan.* 
        FROM kependudukan 
        WHERE DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tanggal_lahir)), '%Y') + 0 $op
        AND kependudukan.hubungan_keluarga NOT IN ('kepala keluarga', 'istri', 'orang-tua', 'mertua', 'menantu')
        $where";
        return $this->db->query($query)->result();
    }
}
