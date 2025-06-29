<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kependudukan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        authorize_user(['sekretaris desa', 'kepala desa']);
        $this->load->model('kependudukan_model');
        $this->load->model('base_model');
    }

    public function index()
    {

        $rt = $this->input->get('rt');
        $rw = $this->input->get('rw');

        $kependudukan = [];
        $title_page = "Kelola Data Penduduk";

        if ($rt && empty($rw)) {
            $keluarga = $this->base_model->get_one_data_by('keluarga', 'rt', $rt);
            if (is_null($keluarga)) redirect('kependudukan');
            $kependudukan = $this->kependudukan_model->get_all_kependudukan('rt', $rt);
            $title_page .= " RT $rt";
        } else if ($rw && empty($rt)) {
            $keluarga = $this->base_model->get_one_data_by('keluarga', 'rw', $rw);
            if (is_null($keluarga)) redirect('kependudukan');
            $kependudukan = $this->kependudukan_model->get_all_kependudukan('rw', $rw);
            $title_page .= " RW $rw";
        } else {
            $kependudukan = $this->kependudukan_model->get_all_kependudukan();
        }

        $data['kependudukan'] = $kependudukan;
        $data['title'] = 'Kependudukan';
        $data['title_page'] = $title_page;
        $this->load->view('kependudukan/index', $data);
    }

    public function cari()
    {
        $nik = $this->input->post('nik', true);
        $penduduk = $this->base_model->get_one_data_by('kependudukan', 'nik', $nik);
        if (is_null($penduduk)) {
            set_alert("NIK ($nik) tidak ditemukan", 'danger');
            redirect("kependudukan");
        } else {
            redirect("kependudukan/kk/$penduduk->no_kk");
        }
    }

    public function kk($no_kk = null)
    {
        if (is_null($no_kk)) redirect('kependudukan');
        $penduduk = $this->base_model->get_one_data_by('kependudukan', 'no_kk', $no_kk);
        if (is_null($penduduk)) redirect('kependudukan');

        $data['title'] = 'Kependudukan';
        $data['penduduk'] = $this->kependudukan_model->get_penduduk($no_kk);
        $data['keluarga'] = $this->kependudukan_model->get_keluarga($no_kk);
        $data['aset_bergerak'] = $this->kependudukan_model->get_aset_penduduk($no_kk, 'aset bergerak');
        $data['aset_tidak_bergerak'] = $this->kependudukan_model->get_aset_penduduk($no_kk, 'aset tidak bergerak');
        $data['bansos'] = $this->kependudukan_model->get_bansos_penduduk($no_kk);
        $data['informasi_tambahan'] = $this->kependudukan_model->get_informasi_tambahan_penduduk($no_kk);
        $data['no_kk'] = $no_kk;

        $this->load->view('kependudukan/penduduk', $data);
    }

    public function edit_keluarga()
    {
        $id_keluarga = $this->input->post('id_keluarga', true);
        $no_kk =  $this->input->post('no_kk', true);

        $data = [
            'no_kk' => $no_kk,
            'alamat' => $this->input->post('alamat', true),
            'rt' => $this->input->post('rt', true),
            'rw' => $this->input->post('rw', true),
            'kelurahan' => $this->input->post('kelurahan', true),
            'kecamatan' => $this->input->post('kecamatan', true),
        ];

        if ($_FILES['foto_rumah']['name']) {
            $data['foto_rumah'] = upload_file('foto_rumah');
        }
        if ($_FILES['foto_sppt']['name']) {
            $data['foto_sppt'] = upload_file('foto_sppt');
        }

        $this->base_model->update('keluarga', $data, $id_keluarga);
        set_alert('Data Informasi Keluarga Berhasil di Perbarui', 'success');
        redirect("kependudukan/kk/$no_kk");
    }

    public function delete_keluarga($id_keluarga = null, $jenis_foto = null)
    {

        if (is_null($id_keluarga) || is_null($jenis_foto)) redirect('kependudukan');
        $keluarga = $this->base_model->get_one_data_by('keluarga', 'id_keluarga', $id_keluarga);

        unlink("./files/img/" . $keluarga->$jenis_foto);

        $this->base_model->update('keluarga', [$jenis_foto => null], $id_keluarga);
        set_alert('Foto berhasil dihapus', 'success');
        redirect("kependudukan/kk/$keluarga->no_kk");
    }

    public function edit_penduduk()
    {
        $id_kependudukan = $this->input->post('id_kependudukan', true);

        $data = [
            'nik' => $this->input->post('nik', true),
            'nama' => $this->input->post('nama', true),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
            'tanggal_lahir' => $this->input->post('tanggal_lahir', true),
            'tempat_lahir' => $this->input->post('tempat_lahir', true),
            'agama' => $this->input->post('agama', true),
            'hubungan_keluarga' => $this->input->post('hubungan_keluarga', true),
            'status_perkawinan' => $this->input->post('status_perkawinan', true),
            'pendidikan' => $this->input->post('pendidikan', true),
            'nama_ibu' => $this->input->post('nama_ibu', true),
            'nama_ayah' => $this->input->post('nama_ayah', true),
        ];


        $this->base_model->update('kependudukan', $data, $id_kependudukan);
        set_alert('Data Penduduk Berhasil di Perbarui', 'success');
        $no_kk = $this->base_model->get_one_data_by('kependudukan', 'id_kependudukan', $id_kependudukan)->no_kk;
        redirect("kependudukan/kk/$no_kk");
    }

    public function insert_aset()
    {
        $no_kk = $this->input->post('no_kk', true);
        $kategori = $this->input->post('kategori', true);

        $data = [
            'no_kk' => $no_kk,
            'kategori' => $kategori,
            'jenis' => $this->input->post('jenis', true),
            'keterangan' => $this->input->post('keterangan', true),
            'nilai' => $this->input->post('nilai', true),
        ];

        if ($kategori == 'aset tidak bergerak') {
            $data['luas'] = $this->input->post('luas', true);
            $data['kepemilikan'] = $this->input->post('kepemilikan', true);
            $data['lama_sewa'] = $this->input->post('lama_sewa', true);
            $data['url_maps'] = $this->input->post('url_maps', true);
        }


        $this->base_model->insert('aset', $data);
        set_alert('Data Aset Berhasil di Tambahkan', 'success');
        redirect("kependudukan/kk/$no_kk");
    }

    public function edit_aset()
    {
        $id_aset = $this->input->post('id_aset', true);
        $no_kk = $this->input->post('no_kk', true);
        $kategori = $this->input->post('kategori', true);

        $data = [
            'no_kk' => $no_kk,
            'kategori' => $kategori,
            'jenis' => $this->input->post('jenis', true),
            'keterangan' => $this->input->post('keterangan', true),
            'nilai' => $this->input->post('nilai', true),
        ];

        if ($kategori == 'aset tidak bergerak') {
            $data['luas'] = $this->input->post('luas', true);
            $data['kepemilikan'] = $this->input->post('kepemilikan', true);
            $data['lama_sewa'] = $this->input->post('lama_sewa', true);
            $data['url_maps'] = $this->input->post('url_maps', true);
        }


        $this->base_model->update('aset', $data, $id_aset);
        set_alert('Data Aset Berhasil di Perbarui', 'success');
        redirect("kependudukan/kk/$no_kk");
    }

    public function delete_aset($id_aset = null)
    {

        if (is_null($id_aset)) redirect('kependudukan');
        $no_kk = $this->base_model->get_one_data_by('aset', 'id_aset', $id_aset)->no_kk;
        $this->base_model->delete('aset', $id_aset);
        set_alert('Data Aset berhasil dihapus', 'success');
        redirect("kependudukan/kk/$no_kk");
    }

    public function edit_pendapatan()
    {
        $id_kependudukan = $this->input->post('id_kependudukan', true);

        $data = [
            'pekerjaan' => $this->input->post('pekerjaan', true),
            'pendapatan' => $this->input->post('pendapatan', true),
        ];


        $this->base_model->update('kependudukan', $data, $id_kependudukan);
        set_alert('Data Pendapatan Penduduk Berhasil di Perbarui', 'success');
        $no_kk = $this->base_model->get_one_data_by('kependudukan', 'id_kependudukan', $id_kependudukan)->no_kk;
        redirect("kependudukan/kk/$no_kk");
    }

    public function edit_kelas()
    {
        $id_kependudukan = $this->input->post('id_kependudukan');
        $kelas = $this->input->post('kelas');
        $this->base_model->update('kependudukan', ['kelas' => $kelas], $id_kependudukan);
        $penduduk = $this->base_model->get_one_data_by('kependudukan', 'id_kependudukan', $id_kependudukan);
        set_alert('Berhasil mengedit data kelas penduduk', 'success');
        redirect("kependudukan/kk/$penduduk->no_kk");
    }

    public function edit_ktp()
    {
        $id_kependudukan = $this->input->post('id_kependudukan');
        $status_ktp = $this->input->post('status_ktp');
        $this->base_model->update('kependudukan', ['status_ktp' => $status_ktp], $id_kependudukan);
        $penduduk = $this->base_model->get_one_data_by('kependudukan', 'id_kependudukan', $id_kependudukan);
        set_alert('Berhasil mengedit status KTP penduduk', 'success');
        redirect("kependudukan/kk/$penduduk->no_kk");
    }

    public function insert_bansos()
    {
        $no_kk = $this->input->post('no_kk', true);

        $data = [
            'no_kk' => $no_kk,
            'jenis' => $this->input->post('jenis', true),
            'keterangan' => $this->input->post('keterangan', true),
            'tanggal_penetapan' => $this->input->post('tanggal_penetapan', true),
            'nilai' => $this->input->post('nilai', true),
        ];


        $this->base_model->insert('bansos', $data);
        set_alert('Data Bantuan Sosial Berhasil di Tambahkan', 'success');
        redirect("kependudukan/kk/$no_kk");
    }

    public function edit_bansos()
    {
        $no_kk = $this->input->post('no_kk', true);
        $id_bansos = $this->input->post('id_bansos', true);

        $data = [
            'jenis' => $this->input->post('jenis', true),
            'keterangan' => $this->input->post('keterangan', true),
            'tanggal_penetapan' => $this->input->post('tanggal_penetapan', true),
            'nilai' => $this->input->post('nilai', true),
        ];


        $this->base_model->update('bansos', $data, $id_bansos);
        set_alert('Data Bantuan Sosial Berhasil di Perbarui', 'success');
        redirect("kependudukan/kk/$no_kk");
    }

    public function delete_bansos($id_bansos = null)
    {

        if (is_null($id_bansos)) redirect('kependudukan');
        $no_kk = $this->base_model->get_one_data_by('bansos', 'id_bansos', $id_bansos)->no_kk;
        $this->base_model->delete('bansos', $id_bansos);
        set_alert('Data Bantuan berhasil dihapus', 'success');
        redirect("kependudukan/kk/$no_kk");
    }

    public function insert_informasi_tambahan()
    {
        $no_kk = $this->input->post('no_kk', true);

        $data = [
            'no_kk' => $no_kk,
            'informasi' => $this->input->post('informasi', true),
            'deskripsi' => $this->input->post('deskripsi', true),
        ];


        $this->base_model->insert('informasi_tambahan', $data);
        set_alert('Data Informai Tambahan Berhasil di Tambahkan', 'success');
        redirect("kependudukan/kk/$no_kk");
    }

    public function edit_informasi_tambahan()
    {
        $no_kk = $this->input->post('no_kk', true);
        $id_informasi_tambahan = $this->input->post('id_informasi_tambahan', true);

        $data = [
            'informasi' => $this->input->post('informasi', true),
            'deskripsi' => $this->input->post('deskripsi', true),
        ];


        $this->base_model->update('informasi_tambahan', $data, $id_informasi_tambahan);
        set_alert('Data Informasi Tambahan Berhasil di Perbarui', 'success');
        redirect("kependudukan/kk/$no_kk");
    }

    public function delete_informasi_tambahan($id_informasi_tambahan = null)
    {

        if (is_null($id_informasi_tambahan)) redirect('kependudukan');
        $no_kk = $this->base_model->get_one_data_by('informasi_tambahan', 'id_informasi_tambahan', $id_informasi_tambahan)->no_kk;
        $this->base_model->delete('informasi_tambahan', $id_informasi_tambahan);
        set_alert('Data Informasi Tambahan berhasil dihapus', 'success');
        redirect("kependudukan/kk/$no_kk");
    }


    public function report($no_kk = null)
    {
        if (is_null($no_kk)) redirect('kependudukan');
        $penduduk = $this->base_model->get_one_data_by('kependudukan', 'no_kk', $no_kk);
        if (is_null($penduduk)) redirect('kependudukan');

        $data['title'] = 'Kependudukan';
        $data['penduduk'] = $this->kependudukan_model->get_penduduk($no_kk);
        $data['keluarga'] = $this->kependudukan_model->get_keluarga($no_kk);
        $data['aset_bergerak'] = $this->kependudukan_model->get_aset_penduduk($no_kk, 'aset bergerak');
        $data['aset_tidak_bergerak'] = $this->kependudukan_model->get_aset_penduduk($no_kk, 'aset tidak bergerak');
        $data['bansos'] = $this->kependudukan_model->get_bansos_penduduk($no_kk);
        $data['informasi_tambahan'] = $this->kependudukan_model->get_informasi_tambahan_penduduk($no_kk);
        $this->load->view('kependudukan/report', $data);
    }
}
