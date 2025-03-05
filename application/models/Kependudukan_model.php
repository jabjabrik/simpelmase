<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kependudukan_model extends CI_Model
{
    function get_all_kependudukan($type = null, $value = null): array
    {
        $where = "";
        if ($type) {
            $where .= "AND keluarga.$type = '$value'";
        }

        $query = "SELECT kependudukan.* 
        FROM kependudukan 
        JOIN keluarga ON kependudukan.no_kk = keluarga.no_kk
        WHERE kependudukan.hubungan_keluarga = 'kepala keluarga' $where
        ORDER BY kependudukan.id_kependudukan";
        return $this->db->query($query)->result();
    }

    function get_penduduk(string $no_kk): array
    {
        $query = "SELECT * FROM kependudukan WHERE kependudukan.no_kk = '$no_kk'";
        return $this->db->query($query)->result();
    }

    function get_keluarga(string $no_kk): object
    {
        $query = "SELECT * FROM keluarga WHERE keluarga.no_kk = '$no_kk'";
        return $this->db->query($query)->row();
    }

    function get_aset_penduduk(string $no_kk, string $kategori): array
    {
        $query = "SELECT * FROM aset WHERE aset.no_kk = '$no_kk' AND aset.kategori = '$kategori'";
        return $this->db->query($query)->result();
    }

    function get_bansos_penduduk(string $no_kk): array
    {
        $query = "SELECT * FROM bansos WHERE bansos.no_kk = '$no_kk'";
        return $this->db->query($query)->result();
    }

    function get_informasi_tambahan_penduduk(string $no_kk): array
    {
        $query = "SELECT * FROM informasi_tambahan WHERE informasi_tambahan.no_kk = '$no_kk'";
        return $this->db->query($query)->result();
    }








    function get_kependudukan_count()
    {
        $query = "SELECT COUNT(*) AS total FROM kependudukan";
        return $this->db->query($query)->row('total');
    }

    function get_kependudukan_pendidikan_count()
    {
        $query = "SELECT pendidikan, COUNT(*) AS jumlah
        FROM kependudukan
        GROUP BY pendidikan";
        return $this->db->query($query)->result();
    }

    function get_kependudukan_pernikahan_count()
    {
        $query = "SELECT status_perkawinan, COUNT(*) AS jumlah
        FROM kependudukan
        GROUP BY status_perkawinan";
        return $this->db->query($query)->result();
    }

    function get_kependudukan_gender_count($gender)
    {
        $query = "SELECT jenis_kelamin, COUNT(*) AS jumlah
            FROM kependudukan
            WHERE kependudukan.jenis_kelamin = '$gender'
            GROUP BY jenis_kelamin";
        return $this->db->query($query)->row('jumlah');
    }

    function get_kependudukan_rt_rw($type, $value)
    {
        $query = "SELECT keluarga.$type, COUNT(*) AS total FROM kependudukan
        JOIN keluarga ON kependudukan.no_kk = keluarga.no_kk
        WHERE keluarga.$type = '$value'
        GROUP BY '$type'";
        return $this->db->query($query)->row('total');
    }

    function get_kependudukan_rt($rt)
    {
        $query = "SELECT * 
            FROM kependudukan 
            WHERE kependudukan.rt = '$rt' AND kependudukan.is_active = 1";
        return $this->db->query($query)->result();
    }

    function get_kependudukan_rw($rw)
    {
        $query = "SELECT * 
            FROM kependudukan 
            WHERE kependudukan.rw = '$rw' AND kependudukan.is_active = 1";
        return $this->db->query($query)->result();
    }

    function get_kependudukan_by($field, $value, $is_active = false)
    {
        $where = ["$field" => "$value"];
        if ($is_active) $where["is_active"] = "1";
        return $this->db->get_where('kependudukan', $where)->row();
    }

    function is_exist_kependudukan($field, $value, $is_active = false)
    {
        $where = ["$field" => "$value"];
        if ($is_active) $where["is_active"] = "1";
        return $this->db->get_where('kependudukan', $where)->num_rows() > 0;
    }

    function create_kependudukan($data)
    {
        return $this->db->insert('kependudukan', $data);
    }

    function edit_kependudukan($id_kependudukan, $data)
    {
        $this->db->where('id_kependudukan', $id_kependudukan);
        return $this->db->update('kependudukan', $data);
    }

    function delete_kependudukan($id_kependudukan)
    {
        $this->db->where('id_kependudukan', $id_kependudukan);
        return $this->db->delete('kependudukan');
    }
}
