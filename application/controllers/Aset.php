<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        authorize_user();
    }

    public function index()
    {
        $query = "SELECT kependudukan.nama, kependudukan.nik, kependudukan.no_kk, aset.* 
            FROM aset
            JOIN kependudukan on aset.id_kependudukan = kependudukan.id_kependudukan";
        $data['aset'] = $this->db->query($query)->result();
        // dd($data);
        $data['title'] = 'Aset';
        $this->load->view('aset/index', $data);
    }

    public function find($nik = null)
    {
        $response;
        if ($nik) {
            $kependudukan = $this->db->get('kependudukan')->result_array();
            $kependudukan = array_filter($kependudukan, function ($kependudukan) use ($nik) {
                return $kependudukan['nik'] == $nik;
            });

            if ($kependudukan) {
                $kependudukan = array_values($kependudukan)[0];
                $response = ['status' => 'success', 'kependudukan' => $kependudukan];
            } else {
                $response = ['status' => 'error', 'message' => "Penduduk dengan NIK $nik tidak ditemukan"];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Masuakn NIK'];
        }

        echo json_encode($response);
    }

    public function create()
    {
        $data = array(
            'id_kependudukan' => $this->input->post('id_kependudukan'),
            'kategori' => $this->input->post('kategori'),
            'jenis' => $this->input->post('jenis'),
            'keterangan' => $this->input->post('keterangan'),
            'nilai' => $this->input->post('nilai'),
            'luas' => $this->input->post('luas'),
            'alamat' => $this->input->post('alamat'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
        );

        $result = $this->db->insert('aset', $data);
        if ($result) {
            set_alert('Berhasil Menambahkan Aset Kependudukan', 'success');
        } else {
            set_alert('Gagal Menambahkan Aset Kependudukan', 'danger');
        }

        redirect('aset');
    }

    public function edit()
    {
        $id_aset = $this->input->post('id_aset');
        $data = array(
            'kategori' => $this->input->post('kategori'),
            'jenis' => $this->input->post('jenis'),
            'keterangan' => $this->input->post('keterangan'),
            'nilai' => $this->input->post('nilai'),
            'luas' => $this->input->post('luas'),
            'alamat' => $this->input->post('alamat'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
        );

        $this->db->where('id_aset', $id_aset);
        $result = $this->db->update('aset', $data);

        if ($result) {
            set_alert('Aset Kependudukan Berhasil di Update', 'success');
        } else {
            set_alert('Aset Kependudukan Gagal di Update', 'danger');
        }

        redirect('aset');
    }
    public function delete($id_aset)
    {
        $this->db->where('id_aset', $id_aset);
        $result = $this->db->delete('aset');

        if ($result) {
            set_alert('Aset Kependudukan Berhasil di Hapus', 'success');
        } else {
            set_alert('Aset Kependudukan Gagal di Hapus', 'danger');
        }
        redirect('aset');
    }
}
