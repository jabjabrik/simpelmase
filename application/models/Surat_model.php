<?php
class Surat_model extends CI_Model
{
    public function get_all_surat(string $surat, bool $is_penduduk_role, string $id_kependudukan): array
    {
        $where = "";

        if ($is_penduduk_role) {
            $where .= "AND $surat.id_kependudukan = $id_kependudukan";
        }

        $query = "SELECT $surat.*, kependudukan.nama
        FROM $surat
        JOIN kependudukan ON $surat.id_kependudukan = kependudukan.id_kependudukan
        WHERE 1=1 $where";
        return $this->db->query($query)->result();
    }

    public function validasi_surat(string $role, string $surat, string $id_surat): void
    {
        $query = "UPDATE $surat set validasi_$role = 'disetujui' WHERE id = '$id_surat'";
        $this->db->query($query);
    }

    public function get_surat_kependudukan(string $surat, string $id_surat): object
    {
        $query = "SELECT $surat.*, kependudukan.*, keluarga.*
        FROM $surat 
        JOIN kependudukan ON $surat.id_kependudukan = kependudukan.id_kependudukan 
        JOIN keluarga ON kependudukan.no_kk = keluarga.no_kk
        WHERE $surat.id = '$id_surat'";
        return $this->db->query($query)->row();
    }

    public function set_file_surat(string $surat, string $file_surat, string $id_surat): void
    {
        $query = "UPDATE $surat set file_surat = '$file_surat' WHERE id = '$id_surat'";
        $this->db->query($query);
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
