<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pkh extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        authorize_user(['sekretaris desa', 'kepala desa']);
    }

    public function index()
    {
        $query = "SELECT kependudukan.nik, kependudukan.nama, kependudukan.no_kk, kependudukan.id_kependudukan AS id_penduduk, pkh.*
            FROM kependudukan
            LEFT JOIN pkh ON kependudukan.id_kependudukan = pkh.id_kependudukan";
        // LIMIT 250 OFFSET 0";
        $data['pkh'] = $this->db->query($query)->result();
        $data['title'] = 'PKH';
        $this->load->view('pkh/index', $data);
    }


    public function create()
    {
        $data = array(
            'id_kependudukan' => $this->input->post('id_kependudukan'),
            'status' => $this->input->post('status'),
            'tanggal' => $this->input->post('tanggal'),
            'nominal' => $this->input->post('nominal'),
        );

        $result = $this->db->insert('pkh', $data);
        if ($result) {
            set_alert('Data PKH Berhasil di Tambahkan', 'success');
        } else {
            set_alert('Data PKH Gagal di Tambahkan', 'danger');
        }

        redirect('pkh');
    }

    public function edit()
    {
        $id_kependudukan = $this->input->post('id_kependudukan');
        $data = array(
            'status' => $this->input->post('status'),
            'tanggal' => $this->input->post('tanggal'),
            'nominal' => $this->input->post('nominal'),
        );

        $this->db->where('id_kependudukan', $id_kependudukan);
        $result = $this->db->update('pkh', $data);

        if ($result) {
            set_alert('Data PKH Berhasil di Update', 'success');
        } else {
            set_alert('Data PKH Gagal di Update', 'danger');
        }

        redirect('pkh');
    }
    public function delete($id_kependudukan)
    {
        $this->db->where('id_kependudukan', $id_kependudukan);
        $result = $this->db->delete('pkh');

        if ($result) {
            set_alert('Data PKH Berhasil Hapus', 'success');
        } else {
            set_alert('Data PKH Gagal Hapus', 'danger');
        }
        redirect('pkh');
    }
}
