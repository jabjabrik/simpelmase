<?php
class Surat_model extends CI_Model
{
    public function get_all_surat($surat, $is_penduduk_role)
    {
        $query = "SELECT $surat.*, kependudukan.*
        FROM $surat 
        JOIN kependudukan ON $surat.id_kependudukan = kependudukan.id_kependudukan";
        if ($is_penduduk_role) {
            $id_kependudukan = $this->session->userdata('id_kependudukan');
            $query = $query . " WHERE $surat.id_kependudukan = $id_kependudukan";
        }
        return $this->db->query($query)->result();
    }
    public function get_surat_kependudukan($surat, $id_surat)
    {
        $query = "SELECT $surat.*, kependudukan.* 
        FROM $surat 
        JOIN kependudukan ON $surat.id_kependudukan = kependudukan.id_kependudukan 
        WHERE $surat.id = '$id_surat'";
        return $this->db->query($query)->row();
    }

    function get_surat_by($surat, $field, $value)
    {
        $where = [
            "$field" => "$value"
        ];
        return $this->db->get_where($surat, $where)->row();
    }

    function get_latest_surat($surat)
    {
        return $this->db->query("SELECT id FROM $surat ORDER BY id DESC LIMIT 1");
    }

    function create_surat($surat, $data)
    {
        return $this->db->insert($surat, $data);
    }

    function delete_surat($surat, $id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($surat);
    }
}
