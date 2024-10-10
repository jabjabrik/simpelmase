<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Serahterima extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        authorize_user();
        $this->load->model('surat_model');
        $this->load->model('kependudukan_model');
    }

    public function index()
    {
        redirect('serahterima/sk_usaha');
    }

    public function accept($role, $surat, $id_surat)
    {
        $result = $this->surat_model->get_surat_kependudukan($surat, $id_surat);

        if ($result->validasi_sekdes == "proses" && $result->kades == "proses") {
            $query = "UPDATE $surat set validasi_$role = 'disetujui' WHERE id = '$id_surat'";
            $this->db->query($query);
        } else {
            $id_kependudukan = $result->id_kependudukan;
            $data;
            if ($surat == 'sk_usaha') {
                $data = array(
                    'no_surat' => $result->no_surat,
                    'nama_usaha' => ucwords($result->nama_usaha),
                    'nik' => $result->nik,
                    'nama' => ucwords($result->nama),
                    'tempat_lahir' => ucwords($result->tempat_lahir),
                    'tanggal_lahir' => $result->tanggal_lahir,
                    'jenis_kelamin' => ucwords($result->jenis_kelamin),
                    'agama' => ucwords($result->agama),
                    'pekerjaan' => ucwords($result->pekerjaan),
                    'alamat' => ucwords($result->alamat),
                    'rt' => $result->rt,
                    'rw' => $result->rw,
                    'kecamatan' => ucwords($result->kecamatan),
                    'kelurahan' => ucwords($result->kelurahan),
                );
            } else if ($surat == 'sk_domisili') {
                $data = array(
                    'no_surat' => $result->no_surat,
                    'tanggal_pengajuan' => $result->tanggal_pengajuan,
                    'nama' => ucwords($result->nama),
                    'alamat' => ucwords($result->alamat),
                    'rt' => sprintf("%03d", $result->rt),
                    'rw' => sprintf("%03d", $result->rw),
                    'kecamatan' => ucwords($result->kecamatan),
                    'kelurahan' => ucwords($result->kelurahan),
                );
            } else if ($surat == 'sk_kematian') {
                $data = array(
                    'no_surat' => $result->no_surat,
                    'tanggal_pengajuan' => $result->tanggal_pengajuan,
                    'nama_jenazah' => ucwords($result->nama_jenazah),
                    'nik_jenazah' => ucwords($result->nik_jenazah),
                    'tempat_lahir' => ucwords($result->tempat_lahir),
                    'tanggal_lahir' => ucwords($result->tanggal_lahir),
                    'agama' => ucwords($result->agama),
                    'hari_meninggal' => ucwords($result->hari_meninggal),
                    'tanggal_meninggal' => ucwords($result->tanggal_meninggal),
                    'penyebab_meninggal' => ucwords($result->penyebab_meninggal),
                    'tempat_meninggal' => ucwords($result->tempat_meninggal),
                    'alamat' => ucwords($result->alamat),
                    'rt' => sprintf("%03d", $result->rt),
                    'rw' => sprintf("%03d", $result->rw),
                    'kecamatan' => ucwords($result->kecamatan),
                    'kelurahan' => ucwords($result->kelurahan),
                );
                $this->db->where('nik', $result->nik_jenazah);
                $this->db->update('kependudukan', array('is_active' => '0'));
            } else if ($surat == 'sk_kelahiran') {
                $ibu = $this->kependudukan_model->get_kependudukan_by('nik', $result->nik_ibu);
                $ayah = $this->kependudukan_model->get_kependudukan_by('nik', $result->nik_ayah);
                $data = array(
                    'no_surat' => $result->no_surat,
                    'tanggal_pengajuan' => $result->tanggal_pengajuan,
                    'nama_bayi' => ucwords($result->nama_bayi),
                    'jenis_kelamin' => ucwords($result->jenis_kelamin),
                    'hari_lahir' => ucwords($result->hari_lahir),
                    'tempat_lahir' => ucwords($result->tempat_lahir),
                    'tanggal_lahir' => $result->tanggal_lahir,
                    'nama_ibu' => ucwords($ibu->nama),
                    'agama_ibu' => ucwords($ibu->agama),
                    'pekerjaan_ibu' => ucwords($ibu->pekerjaan),
                    'nama_ayah' => ucwords($ayah->nama),
                    'agama_ayah' => ucwords($ayah->agama),
                    'pekerjaan_ayah' => ucwords($ayah->pekerjaan),
                    'alamat' => ucwords($result->alamat),
                    'rt' => sprintf("%03d", $result->rt),
                    'rw' => sprintf("%03d", $result->rw),
                    'kecamatan' => ucwords($result->kecamatan),
                    'kelurahan' => ucwords($result->kelurahan),
                );
            } else if ($surat == 'sk_kehilangan') {
                $data = array(
                    'no_surat' => $result->no_surat,
                    'tanggal_pengajuan' => $result->tanggal_pengajuan,
                    'kehilangan' => $result->kehilangan,
                    'lokasi' => $result->lokasi,
                    'hari' => $result->hari,
                    'tanggal' => $result->tanggal,
                    'nik' => $result->nik,
                    'nama' => ucwords($result->nama),
                    'tempat_lahir' => ucwords($result->tempat_lahir),
                    'tanggal_lahir' => $result->tanggal_lahir,
                    'jenis_kelamin' => ucwords($result->jenis_kelamin),
                    'pekerjaan' => ucwords($result->pekerjaan),
                    'alamat' => ucwords($result->alamat),
                    'rt' => sprintf("%03d", $result->rt),
                    'rw' => sprintf("%03d", $result->rw),
                    'kecamatan' => ucwords($result->kecamatan),
                    'kelurahan' => ucwords($result->kelurahan),
                );
            }
            $file_surat = generate_surat($surat, $data);
            $query = "UPDATE $surat set validasi_$role = 'disetujui', file_surat = '$file_surat' WHERE id = '$id_surat'";
            $this->db->query($query);
        }

        set_alert('Pengajuan Surat Berhasil  di Konfirmasi', 'success');

        redirect("serahterima/$surat");
    }

    public function reject($role, $surat)
    {
        $id = $this->input->post('id');
        $data = array(
            'notifikasi' => $this->input->post('notifikasi'),
            "validasi_$role" => 'ditolak'
        );

        $this->db->where('id', $id);
        $result = $this->db->update($surat, $data);

        if ($result) {
            set_alert('Pengajuan Surat Berhasil di Tolak', 'success');
        } else {
            set_alert('Pengajuan Surat Gagal di Ttolak', 'danger');
        }
        redirect("serahterima/$surat");
    }

    public function sk_usaha()
    {
        $query = "SELECT sk_usaha.*, kependudukan.nama 
            FROM sk_usaha 
            JOIN kependudukan ON sk_usaha.id_kependudukan = kependudukan.id_kependudukan";
        $data['sk_usaha'] =  $this->db->query($query)->result();

        $data['title'] = 'Serah terima SK Usaha';
        $this->load->view('serahterima/sk_usaha', $data);
    }

    public function sk_domisili()
    {
        $is_penduduk_role = $this->session->userdata('role') == 'penduduk';
        // if ($is_penduduk_role) {
        $id_kependudukan      = $this->session->userdata('id_kependudukan');
        $data['kependudukan'] = $this->kependudukan_model->get_kependudukan_by("id_kependudukan", $id_kependudukan);
        // }
        $data['sk_domisili'] = $this->surat_model->get_all_surat('sk_domisili', $is_penduduk_role);
        $data['title']        = 'Serah terima SK Domisili';
        $this->load->view('serahterima/sk_domisili', $data);
    }

    public function sk_kematian()
    {
        $query = "SELECT sk_kematian.*, kependudukan.*
            FROM sk_kematian 
            JOIN kependudukan ON sk_kematian.id_kependudukan = kependudukan.id_kependudukan";
        $data['sk_kematian']  =  $this->db->query($query)->result();
        $data['jenis_surat']  = 'sk_kematian';
        $data['title']        = 'Serah terima SK Kematian';
        $this->load->view('serahterima/sk_kematian', $data);
    }

    public function sk_kelahiran()
    {
        $query = "SELECT sk_kelahiran.*, kependudukan.*
            FROM sk_kelahiran 
            JOIN kependudukan ON sk_kelahiran.id_kependudukan = kependudukan.id_kependudukan";
        $data['sk_kelahiran'] =  $this->db->query($query)->result();
        if (!empty($data['sk_kelahiran'])) {
            $nik_ayah = isset($data['sk_kelahiran'][0]) ? $data['sk_kelahiran'][0]->nik_ayah : '';
            $nik_ibu = isset($data['sk_kelahiran'][0]) ? $data['sk_kelahiran'][0]->nik_ibu : '';
            $data['nama_ayah']    = $this->kependudukan_model->get_kependudukan_by('nik', $nik_ayah)->nama;
            $data['nama_ibu']     = $this->kependudukan_model->get_kependudukan_by('nik', $nik_ibu)->nama;
        }
        $data['jenis_surat']  = 'sk_kelahiran';
        $data['title']        = 'Serah terima SK Kelahiran';
        $this->load->view('serahterima/sk_kelahiran', $data);
    }

    public function sk_kehilangan()
    {
        $is_penduduk_role = $this->session->userdata('role') == 'penduduk';
        $data['sk_kehilangan'] = $this->surat_model->get_all_surat('sk_kehilangan', $is_penduduk_role);
        $data['title']        = 'Serah terima SK Kehilangan';
        $this->load->view('serahterima/sk_kehilangan', $data);
    }
}
