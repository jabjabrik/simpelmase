<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        authorize_user(['sekretaris desa', 'kepala desa']);
        $this->load->model('kependudukan_model');
    }

    public function index()
    {
        $data['jumlah_penduduk'] = $this->kependudukan_model->get_kependudukan_count();
        $data['jumlah_laki_laki'] = $this->kependudukan_model->get_kependudukan_gender_count('laki-laki');
        $data['jumlah_perempuan'] = $this->kependudukan_model->get_kependudukan_gender_count('perempuan');
        $data['jumlah_pendidikan'] = $this->kependudukan_model->get_kependudukan_pendidikan_count();
        $data['jumlah_pernikahan'] = $this->kependudukan_model->get_kependudukan_pernikahan_count();
        for ($i = 1; $i <= 16; $i++) {
            $data["rt$i"] = $this->kependudukan_model->get_kependudukan_rt_rw('rt', sprintf("%03d", $i));
        }
        for ($i = 1; $i <= 3; $i++) {
            $data["rw$i"] = $this->kependudukan_model->get_kependudukan_rt_rw('rw', sprintf("%03d", $i));
        }

        $year = $this->input->get('year') ?? '2025';

        $this->db->from('bansos');
        $this->db->where('YEAR(tanggal_penetapan)', $year);
        $data['total_bansos'] = $this->db->count_all_results();

        $this->db->from('kependudukan');
        $this->db->where('pendapatan !=', 0);
        $data['total_pendapatan'] = $this->db->count_all_results();


        $this->db->from('kependudukan');
        $this->db->where('status_ktp', 'memiliki KTP');
        $this->db->where_not_in('hubungan_keluarga', [
            'kepala keluarga',
            'istri',
            'orang-tua',
            'mertua',
            'menantu'
        ]);
        $data['total_ktp'] = $this->db->count_all_results();


        $data['total_aset'] = $this->db->count_all('aset');


        $data['title'] = 'Dashboard';
        $this->load->view('dashboard/index', $data);
    }
}
