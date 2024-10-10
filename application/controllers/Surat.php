<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('surat_model');
        $this->load->model('kependudukan_model');
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
            unlink("./files/img/$sk->ft_ktp_pelapor");
            unlink("./files/img/$sk->ft_kk_jenazah");
            unlink("./files/img/$sk->ft_ktp_jenazah");
            unlink("./files/img/$sk->ft_akte_lahir");
        }

        $result = $this->surat_model->delete_surat($surat, $id);
        if ($result) {
            set_alert('Surat Keterangan Berhasil di Hapus', 'success');
        } else {
            set_alert('Surat Keterangan Gagal di Hapus', 'danger');
        }
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

    public function sk_usaha()
    {
        $is_penduduk_role = $this->session->userdata('role') == 'penduduk';
        $data['sk_usaha'] = $this->surat_model->get_all_surat('sk_usaha', $is_penduduk_role);
        $data['title']    = 'SK Usaha';
        $data['no_surat'] = generate_no_surat('sk_usaha');
        $this->load->view('surat/sk_usaha', $data);
    }

    public function sk_usaha_create()
    {
        $id_kependudukan = $this->session->userdata('id_kependudukan');
        $no_surat = $this->input->post('no_surat');

        $data = [
            'id_kependudukan' => $id_kependudukan,
            'no_surat' => $no_surat,
            'tanggal_pengajuan' => date('Y/m/d'),
            'nama_usaha' => $this->input->post('nama_usaha'),
            'keperluan' => $this->input->post('keperluan'),
            'status_print' => $this->input->post('status_print'),
        ];

        $this->load->library('upload');

        $data['foto_ktp'] = upload_file('foto_ktp');
        $data['foto_kartu_pajak'] = upload_file('foto_kartu_pajak');

        if ($_FILES['foto_kartu_vaksin']['name']) {
            $data['foto_kartu_vaksin'] = upload_file('foto_kartu_vaksin');
        }
        if ($_FILES['pas_foto']['name']) {
            $data['pas_foto'] = upload_file('pas_foto');
        }

        $result = $this->surat_model->create_surat("sk_usaha", $data);

        if ($result) {
            set_alert('Pengajuan Surat Keterangan Berhasil Terkirim', 'success');
        } else {
            set_alert('Pengajuan Surat Keterangan Gagal Terkirim', 'danger');
        }
        redirect("surat/sk_usaha");
    }

    public function sk_domisili()
    {
        $is_penduduk_role = $this->session->userdata('role') == 'penduduk';
        $data['sk_domisili'] = $this->surat_model->get_all_surat('sk_domisili', $is_penduduk_role);
        $id_kependudukan = $this->session->userdata('id_kependudukan');
        $data['kependudukan'] = $this->kependudukan_model->get_kependudukan_by('id_kependudukan', $id_kependudukan);
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

        $this->load->library('upload');

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

        $result = $this->surat_model->create_surat("sk_domisili", $data);

        if ($result) {
            set_alert('Pengajuan Surat Keterangan Berhasil Terkirim', 'success');
        } else {
            set_alert('Pengajuan Surat Keterangan Gagal Terkirim', 'danger');
        }
        redirect("surat/sk_domisili");
    }

    public function sk_kematian()
    {
        $is_penduduk_role    = $this->session->userdata('role') == 'penduduk';
        $data['sk_kematian'] = $this->surat_model->get_all_surat('sk_kematian', $is_penduduk_role);
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
        $is_penduduk_role = $this->session->userdata('role') == 'penduduk';
        $data['sk_kelahiran'] = $this->surat_model->get_all_surat('sk_kelahiran', $is_penduduk_role);
        $data['title']        = 'SK Kelahiran';
        $data['no_surat']     = generate_no_surat('sk_kelahiran');
        $this->load->view('surat/sk_kelahiran', $data);
    }

    public function sk_kelahiran_create()
    {
        $data = array(
            'id_kependudukan' => $this->session->userdata('id_kependudukan'),
            'no_surat' => $this->input->post('no_surat'),
            'nik_ayah' => $this->input->post('nik_ayah'),
            'nik_ibu' => $this->input->post('nik_ibu'),
            'nama_bayi' => $this->input->post('nama_bayi'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'hari_lahir' => $this->input->post('hari_lahir'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'tanggal_pengajuan' => date('Y/m/d'),
            'status_print' => $this->input->post('status_print'),
        );


        $this->load->library('upload');
        $data['foto_kk'] = upload_file('foto_kk');
        $data['foto_buku_nikah'] = upload_file('foto_buku_nikah');
        $data['foto_ktp_ayah'] = upload_file('foto_ktp_ayah');
        $data['foto_ktp_ibu'] = upload_file('foto_ktp_ibu');


        $result = $this->surat_model->create_surat("sk_kelahiran", $data);

        if ($result) {
            set_alert('Pengajuan Surat Keterangan Berhasil Terkirim', 'success');
        } else {
            set_alert('Pengajuan Surat Keterangan Gagal Terkirim', 'danger');
        }
        redirect("surat/sk_kelahiran");
    }

    public function sk_kehilangan()
    {
        $is_penduduk_role = $this->session->userdata('role') == 'penduduk';
        $data['sk_kehilangan'] = $this->surat_model->get_all_surat('sk_kehilangan', $is_penduduk_role);
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

        $this->load->library('upload');

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

        $result = $this->surat_model->create_surat("sk_kehilangan", $data);

        if ($result) {
            set_alert('Pengajuan Surat Keterangan Berhasil Terkirim', 'success');
        } else {
            set_alert('Pengajuan Surat Keterangan Gagal Terkirim', 'danger');
        }
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