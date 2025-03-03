<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
    private $is_penduduk_role, $id_kependudukan;

    public function __construct()
    {
        parent::__construct();
        authorize_user(['sekretaris desa', 'kepala desa', 'penduduk']);
        $this->load->model('surat_model');
        $this->load->model('kependudukan_model');
        $this->load->model('base_model');
        $this->is_penduduk_role = $this->session->userdata('role') == 'penduduk';
        $this->id_kependudukan = $this->session->userdata('id_kependudukan');
    }

    public function index()
    {
        redirect('surat/sk_usaha');
    }

    public function sk_delete($id, $surat)
    {
        $sk = $this->surat_model->get_surat_by($surat, "id", $id);

        unlink("./files/dokumen/$sk->file_surat");

        if ($surat == 'sk_usaha' || $surat == 'sk_domisili') {
            unlink("./files/img/$sk->foto_ktp");
            unlink("./files/img/$sk->pas_foto");
            unlink("./files/img/$sk->foto_kartu_vaksin");
            unlink("./files/img/$sk->foto_kartu_pajak");
        } else if ($surat == 'sk_kematian') {
            unlink("./files/img/$sk->foto_ktp_pelapor");
            unlink("./files/img/$sk->foto_kk_jenazah");
            unlink("./files/img/$sk->foto_ktp_jenazah");
            unlink("./files/img/$sk->foto_akte_lahir");
        }

        $this->surat_model->delete_surat($surat, $id);
        set_alert('Surat Keterangan Berhasil di Hapus', 'success');
        redirect("surat/$surat");
    }

    public function find($nik = null)
    {
        $response;
        if ($nik) {
            $kependudukan = $this->kependudukan_model->get_all_kependudukan();
            $kependudukan = array_filter($kependudukan, function ($kependudukan) use ($nik) {
                return $kependudukan->nik == $nik;
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

    public function accept($role, $surat, $id_surat)
    {
        $result = $this->surat_model->get_surat_kependudukan($surat, $id_surat);
        $this->surat_model->validasi_surat($role, $surat, $id_surat);


        if ($result->validasi_sekdes == "proses" && $result->validasi_kades == "proses") {
            set_alert('Pengajuan Surat Berhasil  di Konfirmasi', 'success');
            redirect("surat/$surat");
        }

        $data = [
            'no_surat' => $result->no_surat,
            'tanggal_pengajuan' => $result->tanggal_pengajuan,
            'alamat' => ucwords($result->alamat),
            'rt' => sprintf("%03d", $result->rt),
            'rw' => sprintf("%03d", $result->rw),
            'kecamatan' => ucwords($result->kecamatan),
            'kelurahan' => ucwords($result->kelurahan),
        ];

        if ($surat == 'sk_usaha') {
            $data['nama_usaha'] = ucwords($result->nama_usaha);
            $data['nik'] = $result->nik;
            $data['nama'] = ucwords($result->nama);
            $data['tempat_lahir'] = ucwords($result->tempat_lahir);
            $data['tanggal_lahir'] = $result->tanggal_lahir;
            $data['jenis_kelamin'] = ucwords($result->jenis_kelamin);
            $data['agama'] = ucwords($result->agama);
            $data['pekerjaan'] = ucwords($result->pekerjaan);
        }
        if ($surat == 'sk_domisili') {
            $data['nama'] = ucwords($result->nama);
        }
        if ($surat == 'sk_kematian') {
            $data['nama_jenazah'] = ucwords($result->nama_jenazah);
            $data['nik_jenazah'] = ucwords($result->nik_jenazah);
            $data['tempat_lahir'] = ucwords($result->tempat_lahir);
            $data['tanggal_lahir'] = ucwords($result->tanggal_lahir);
            $data['agama'] = ucwords($result->agama);
            $data['hari_meninggal'] = ucwords($result->hari_meninggal);
            $data['tanggal_meninggal'] = ucwords($result->tanggal_meninggal);
            $data['penyebab_meninggal'] = ucwords($result->penyebab_meninggal);
            $data['tempat_meninggal'] = ucwords($result->tempat_meninggal);

            $this->db->where('nik', $result->nik_jenazah);
            $this->db->update('kependudukan', array('is_active' => '0'));
        }
        if ($surat == 'sk_kelahiran') {
            $ayah = $this->base_model->get_one_data_by('kependudukan', 'nik', $result->nik_ayah);
            $ibu = $this->base_model->get_one_data_by('kependudukan', 'nik', $result->nik_ibu);

            $data['nama_bayi'] = ucwords($result->nama_bayi);
            $data['jenis_kelamin'] = ucwords($result->jenis_kelamin);
            $data['hari_lahir'] = ucwords($result->hari_lahir);
            $data['tempat_lahir'] = ucwords($result->tempat_lahir);
            $data['tanggal_lahir'] = $result->tanggal_lahir;
            $data['nama_ibu'] = ucwords($ibu->nama);
            $data['agama_ibu'] = ucwords($ibu->agama);
            $data['pekerjaan_ibu'] = ucwords($ibu->pekerjaan);
            $data['nama_ayah'] = ucwords($ayah->nama);
            $data['agama_ayah'] = ucwords($ayah->agama);
            $data['pekerjaan_ayah'] = ucwords($ayah->pekerjaan);
        }
        if ($surat == 'sk_kehilangan') {
            $data['kehilangan'] = $result->kehilangan;
            $data['lokasi'] = $result->lokasi;
            $data['hari'] = $result->hari;
            $data['tanggal'] = $result->tanggal;
            $data['nik'] = $result->nik;
            $data['nama'] = ucwords($result->nama);
            $data['tempat_lahir'] = ucwords($result->tempat_lahir);
            $data['tanggal_lahir'] = $result->tanggal_lahir;
            $data['jenis_kelamin'] = ucwords($result->jenis_kelamin);
            $data['pekerjaan'] = ucwords($result->pekerjaan);
        }

        $file_surat = generate_surat($surat, $data);
        $this->surat_model->set_file_surat($surat, $file_surat, $id_surat);
        set_alert('Pengajuan Surat Berhasil  di Konfirmasi', 'success');
        redirect("surat/$surat");
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

        set_alert('Pengajuan Surat Berhasil di Tolak', 'success');
        redirect("surat/$surat");
    }

    public function sk_usaha()
    {
        $data['sk_usaha'] = $this->surat_model->get_all_surat('sk_usaha', $this->is_penduduk_role, $this->id_kependudukan);
        $data['title']    = 'SK Usaha';
        $data['no_surat'] = generate_no_surat('sk_usaha');
        $this->load->view('surat/sk_usaha', $data);
    }

    public function sk_usaha_create()
    {
        $data = [
            'id_kependudukan' => $this->id_kependudukan,
            'no_surat' => $this->input->post('no_surat'),
            'tanggal_pengajuan' => date('Y/m/d'),
            'nama_usaha' => $this->input->post('nama_usaha'),
            'keperluan' => $this->input->post('keperluan'),
            'status_print' => $this->input->post('status_print'),
        ];

        $data['foto_ktp'] = upload_file('foto_ktp');
        $data['foto_kartu_pajak'] = upload_file('foto_kartu_pajak');

        if ($_FILES['foto_kartu_vaksin']['name']) {
            $data['foto_kartu_vaksin'] = upload_file('foto_kartu_vaksin');
        }
        if ($_FILES['pas_foto']['name']) {
            $data['pas_foto'] = upload_file('pas_foto');
        }

        $this->base_model->insert('sk_usaha', $data);
        set_alert('Pengajuan Surat Keterangan Berhasil Terkirim', 'success');
        redirect("surat/sk_usaha");
    }

    public function sk_domisili()
    {
        $data['sk_domisili'] = $this->surat_model->get_all_surat('sk_domisili', $this->is_penduduk_role, $this->id_kependudukan);
        $data['kependudukan'] = $this->base_model->get_one_data_by('kependudukan', 'id_kependudukan', $this->id_kependudukan);
        $data['title']       = 'SK Domisili';
        $data['no_surat']    = generate_no_surat('sk_domisili');
        $this->load->view('surat/sk_domisili', $data);
    }

    public function sk_domisili_create()
    {
        $id_kependudukan = $this->session->userdata('id_kependudukan');
        $no_surat = $this->input->post('no_surat');

        $data = array(
            'id_kependudukan' => $id_kependudukan,
            'no_surat' => $no_surat,
            'tanggal_pengajuan' => date('Y/m/d'),
            'keperluan' => $this->input->post('keperluan'),
            'status_print' => $this->input->post('status_print'),
        );

        $data['foto_ktp'] = upload_file('foto_ktp');

        if ($_FILES['pas_foto']['name']) {
            $data['pas_foto'] = upload_file('pas_foto');
        }
        if ($_FILES['foto_kartu_vaksin']['name']) {
            $data['foto_kartu_vaksin'] = upload_file('foto_kartu_vaksin');
        }
        if ($_FILES['foto_kartu_pajak']['name']) {
            $data['foto_kartu_pajak'] = upload_file('foto_kartu_pajak');
        }

        $this->base_model->insert('sk_domisili', $data);
        set_alert('Pengajuan Surat Keterangan Berhasil Terkirim', 'success');
        redirect("surat/sk_domisili");
    }

    public function sk_kematian()
    {
        $data['sk_kematian'] = $this->surat_model->get_all_surat('sk_kematian', $this->is_penduduk_role, $this->id_kependudukan);
        $data['title']       = 'SK Kematian';
        $data['no_surat']    = generate_no_surat('sk_kematian');
        $this->load->view('surat/sk_kematian', $data);
    }

    public function sk_kematian_create()
    {
        $data = array(
            'id_kependudukan' => $this->session->userdata('id_kependudukan'),
            'no_surat' => $this->input->post('no_surat'),
            'nik_jenazah' => $this->input->post('nik_jenazah'),
            'nama_jenazah' => $this->input->post('nama_jenazah'),
            'hari_meninggal' => $this->input->post('hari_meninggal'),
            'tanggal_meninggal' => $this->input->post('tanggal_meninggal'),
            'penyebab_meninggal' => $this->input->post('penyebab_meninggal'),
            'tempat_meninggal' => $this->input->post('tempat_meninggal'),
            'tanggal_pengajuan' => date('Y/m/d'),
            'status_print' => $this->input->post('status_print'),
        );

        $this->load->library('upload');
        $data['foto_ktp_pelapor'] = upload_file('foto_ktp_pelapor');
        $data['foto_kk_jenazah'] = upload_file('foto_kk_jenazah');
        $data['foto_ktp_jenazah'] = upload_file('foto_ktp_jenazah');
        $data['foto_akte_lahir'] = upload_file('foto_akte_lahir');

        $result = $this->surat_model->create_surat("sk_kematian", $data);

        if ($result) {
            set_alert('Pengajuan Surat Keterangan Berhasil Terkirim', 'success');
        } else {
            set_alert('Pengajuan Surat Keterangan Gagal Terkirim', 'danger');
        }
        redirect("surat/sk_kematian");
    }

    public function sk_kelahiran()
    {
        $data['sk_kelahiran'] = $this->surat_model->get_all_surat('sk_kelahiran', $this->is_penduduk_role, $this->id_kependudukan);
        $data['title']        = 'SK Kelahiran';
        $data['no_surat']     = generate_no_surat('sk_kelahiran');
        $this->load->view('surat/sk_kelahiran', $data);
    }

    public function sk_kelahiran_create()
    {
        $nik_ayah = $this->input->post('nik_ayah');
        $nik_ibu = $this->input->post('nik_ibu');

        $ayah = $this->base_model->get_one_data_by('kependudukan', 'nik', $nik_ayah);
        $ibu = $this->base_model->get_one_data_by('kependudukan', 'nik', $nik_ibu);

        if (is_null($ayah)) {
            set_alert("NIK Ayah ($nik_ayah) tidak ditemukan", 'danger');
            redirect("surat/sk_kelahiran");
        }
        if (is_null($ibu)) {
            set_alert("NIK Ibu ($nik_ibu) tidak ditemukan", 'danger');
            redirect("surat/sk_kelahiran");
        }

        $data = [
            'id_kependudukan' => $this->session->userdata('id_kependudukan'),
            'no_surat' => $this->input->post('no_surat'),
            'nik_ayah' => $nik_ayah,
            'nik_ibu' => $nik_ibu,
            'nama_bayi' => $this->input->post('nama_bayi'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'hari_lahir' => $this->input->post('hari_lahir'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'tanggal_pengajuan' => date('Y/m/d'),
            'status_print' => $this->input->post('status_print'),
        ];


        $data['foto_kk'] = upload_file('foto_kk');
        $data['foto_buku_nikah'] = upload_file('foto_buku_nikah');
        $data['foto_ktp_ayah'] = upload_file('foto_ktp_ayah');
        $data['foto_ktp_ibu'] = upload_file('foto_ktp_ibu');

        $this->base_model->insert("sk_kelahiran", $data);
        set_alert('Pengajuan Surat Keterangan Berhasil Terkirim', 'success');
        redirect("surat/sk_kelahiran");
    }

    public function sk_kehilangan()
    {
        $data['sk_kehilangan'] = $this->surat_model->get_all_surat('sk_kehilangan', $this->is_penduduk_role, $this->id_kependudukan);
        $data['title']         = 'SK Kehilangan';
        $data['no_surat']      = generate_no_surat('sk_kehilangan');
        $this->load->view('surat/sk_kehilangan', $data);
    }

    public function sk_kehilangan_create()
    {
        $data = array(
            'id_kependudukan' => $this->session->userdata('id_kependudukan'),
            'no_surat' => $this->input->post('no_surat'),
            'kehilangan' => $this->input->post('kehilangan'),
            'lokasi' => $this->input->post('lokasi'),
            'hari' => $this->input->post('hari'),
            'tanggal' => $this->input->post('tanggal'),
            'tanggal_pengajuan' => date('Y/m/d'),
            'status_print' => $this->input->post('status_print'),
        );

        $data['foto_ktp'] = upload_file('foto_ktp');

        if ($_FILES['pas_foto']['name']) {
            $data['pas_foto'] = upload_file('pas_foto');
        }
        if ($_FILES['foto_kartu_pajak']['name']) {
            $data['foto_kartu_pajak'] = upload_file('foto_kartu_pajak');
        }
        if ($_FILES['foto_kartu_vaksin']['name']) {
            $data['foto_kartu_vaksin'] = upload_file('foto_kartu_vaksin');
        }

        $this->base_model->insert("sk_kehilangan", $data);
        set_alert('Pengajuan Surat Keterangan Berhasil Terkirim', 'success');
        redirect("surat/sk_kehilangan");
    }
}



    // public function no_surat()
    // {
    //     $data['no_surat'] = $this->db->get('no_surat')->result();
    //     $data['title'] = 'Nomor Surat';
    //     $this->load->view('surat/no_surat', $data);
    // }

    // public function no_surat_create()
    // {
    //     $data = array(
    //         'nama_surat' => $this->input->post('nama_surat'),
    //         'no_surat' => $this->input->post('no_surat'),
    //     );

    //     $result = $this->db->insert('no_surat', $data);
    //     if ($result) {
    //         set_alert('Nomor Surat Berhasil di Tambahkan', 'success');
    //     } else {
    //         set_alert('Nomor Surat Gagal di Tambahkan', 'danger');
    //     }
    //     redirect('surat/no_surat');
    // }

    // public function no_surat_edit()
    // {
    //     $id_nosurat = $this->input->post('id_nosurat');
    //     $data = array(
    //         'nama_surat' => $this->input->post('nama_surat'),
    //         'no_surat' => $this->input->post('no_surat'),
    //     );

    //     $this->db->where('id_nosurat', $id_nosurat);
    //     $result = $this->db->update('no_surat', $data);

    //     if ($result) {
    //         set_alert('Nomor Surat Berhasil di Update', 'success');
    //     } else {
    //         set_alert('Nomor Surat Gagal di Update', 'danger');
    //     }
    //     redirect('surat/no_surat');
    // }

    // public function no_surat_delete($id_nosurat)
    // {
    //     $this->db->where('id_nosurat', $id_nosurat);
    //     $result = $this->db->delete('no_surat');

    //     if ($result) {
    //         set_alert('Nomor Surat Berhasil di Hapus', 'success');
    //     } else {
    //         set_alert('Nomor Surat Gagal di Hapus', 'danger');
    //     }
    //     redirect('surat/no_surat');
    // }