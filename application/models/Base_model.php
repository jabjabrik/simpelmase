<?php

class Base_model extends CI_Model
{
    public function get_all(string $table_name, bool $is_active = false): array
    {
        $where = $is_active ? "AND $table_name.is_active = '1'" : "";
        $query = "SELECT * FROM $table_name WHERE 1=1 $where";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function get_one_data_by(string $table_name, string $field, string $value)
    {
        $result = $this->db->get_where($table_name, [$field => $value])->row();
        return $result;
    }

    public function insert(string $table_name, array $data): void
    {
        $this->db->insert($table_name, $data);
    }

    public function update(string $table_name, array $data, string $id): void
    {
        $this->db->where("id_$table_name", $id);
        $this->db->update($table_name, $data);
    }

    public function delete(string $table_name, string $id): void
    {
        $this->db->where("id_$table_name", $id);
        $this->db->delete($table_name);
    }

    public function nonactive(string $table_name, string $id): void
    {
        $this->db->where("id_$table_name", $id);
        $this->db->update($table_name, ['is_active' => '0']);
    }
}
