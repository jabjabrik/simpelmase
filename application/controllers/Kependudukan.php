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
        $data['kependudukan'] = $this->kependudukan_model->get_all_kependudukan();
        $data['title'] = 'Kependudukan';
        $this->load->view('kependudukan/index', $data);
    }

    public function nik($nik = null)
    {
        if (is_null($nik)) redirect('kependudukan');
        $penduduk = $this->base_model->get_one_data_by('kependudukan', 'nik', $nik);
        if (is_null($penduduk)) redirect('kependudukan');

        redirect("kependudukan/kk/$penduduk->no_kk");
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
        $data['no_kk'] = $no_kk;
        $this->load->view('kependudukan/penduduk', $data);
    }







    public function rt($rt)
    {
        $data['kependudukan'] = $this->kependudukan_model->get_kependudukan_rt($rt);
        $data['title'] = 'Kependudukan';
        $data['title_table'] = "Data Kependudukan Sumberkledung RT " . sprintf("%03d", $rt);
        $this->load->view('kependudukan/index', $data);
    }

    public function rw($rw)
    {
        $data['kependudukan'] = $this->kependudukan_model->get_kependudukan_rw($rw);
        $data['title'] = 'Kependudukan';
        $data['title_table'] = "Data Kependudukan Sumberkledung RW " . sprintf("%03d", $rw);
        $this->load->view('kependudukan/index', $data);
    }

    public function create()
    {
        $nik = $this->input->post('nik');
        $data = [
            'nik' => $nik,
            'no_kk' => $this->input->post('no_kk'),
            'nama' => $this->input->post('nama'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'agama' => $this->input->post('agama'),
            'hubungan_keluarga' => $this->input->post('hubungan_keluarga'),
            'status_perkawinan' => $this->input->post('status_perkawinan'),
            'pendidikan' => $this->input->post('pendidikan'),
            'nama_ibu' => $this->input->post('nama_ibu'),
            'nama_ayah' => $this->input->post('nama_ayah'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'alamat' => $this->input->post('alamat'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'kelurahan' => $this->input->post('kelurahan'),
            'kecamatan' => $this->input->post('kecamatan'),
            'gaji' => $this->input->post('gaji'),
            'ktp' => $this->input->post('ktp'),
        ];

        if ($_FILES['foto_rumah']['name']) {
            $this->load->library('upload');
            $data["foto_rumah"] = upload_file('foto_rumah');
        }

        $is_exist_nik = $this->kependudukan_model->is_exist_kependudukan("nik", $nik);
        if ($is_exist_nik) {
            set_alert("NIK '$nik' telah terpakai, Mohon inputkan nik baru.", 'danger');
        } else {
            $result = $this->kependudukan_model->create_kependudukan($data);

            if ($result) {
                set_alert('Data Kependudukan Berhasil di Tambahkan', 'success');
            } else {
                set_alert('Data Kependudukan Gagal di Tambahkan', 'danger');
            }
        }

        redirect('kependudukan');
    }

    public function edit()
    {
        $id_kependudukan =  $this->input->post('id_kependudukan');
        $nik =  $this->input->post('nik');
        $data = array(
            'nik' =>  $nik,
            'no_kk' =>  $this->input->post('no_kk'),
            'nama' =>  $this->input->post('nama'),
            'jenis_kelamin' =>  $this->input->post('jenis_kelamin'),
            'tanggal_lahir' =>  $this->input->post('tanggal_lahir'),
            'tempat_lahir' =>  $this->input->post('tempat_lahir'),
            'agama' =>  $this->input->post('agama'),
            'hubungan_keluarga' =>  $this->input->post('hubungan_keluarga'),
            'status_perkawinan' =>  $this->input->post('status_perkawinan'),
            'pendidikan' =>  $this->input->post('pendidikan'),
            'nama_ibu' =>  $this->input->post('nama_ibu'),
            'nama_ayah' =>  $this->input->post('nama_ayah'),
            'pekerjaan' =>  $this->input->post('pekerjaan'),
            'alamat' =>  $this->input->post('alamat'),
            'rt' =>  $this->input->post('rt'),
            'rw' =>  $this->input->post('rw'),
            'kelurahan' =>  $this->input->post('kelurahan'),
            'kecamatan' =>  $this->input->post('kecamatan'),
            'gaji' =>  $this->input->post('gaji'),
            'ktp' =>  $this->input->post('ktp'),
        );

        $is_exist_nik = $this->kependudukan_model->is_exist_kependudukan("nik", $nik);
        $kependudukan = $this->kependudukan_model->get_kependudukan_by("id_kependudukan", $id_kependudukan);

        if ($is_exist_nik && $nik != $kependudukan->nik) {
            set_alert("Nilai NIK tidak boleh sama dengan penduduk lain", 'danger');
        } else {
            if ($_FILES['foto_rumah']['name']) {
                $foto_rumah = $kependudukan->foto_rumah;
                $this->load->library('upload');
                $data['foto_rumah'] = upload_file('foto_rumah');
                if ($foto_rumah) {
                    unlink("./files/img/$foto_rumah");
                }
            }

            $result = $this->kependudukan_model->edit_kependudukan($id_kependudukan, $data);

            if ($result) {
                set_alert('Data Kependudukan Berhasil di Update.', 'success');
            } else {
                set_alert('Data Kependudukan Gagal di Update.', 'danger');
            }
        }

        redirect('kependudukan');
    }

    public function delete($id_kependudukan)
    {
        $foto_rumah = $this->kependudukan_model->get_kependudukan_by("id_kependudukan", $id_kependudukan)->foto_rumah;

        if ($foto_rumah) {
            unlink("./files/img/$foto_rumah");
        }

        $result = $this->kependudukan_model->delete_kependudukan($id_kependudukan);
        if ($result) {
            set_alert('Data Kependudukan Berhasil di Hapus.', 'success');
        } else {
            set_alert('Data Kependudukan Gagal di Hapus.', 'danger');
        }
        redirect('kependudukan');
    }
}
