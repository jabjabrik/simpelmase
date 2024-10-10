<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // authorize_user();
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
            $data["rt$i"] = $this->kependudukan_model->get_kependudukan_rt_count($i);
        }
        for ($i = 1; $i <= 3; $i++) {
            $data["rw$i"] = $this->kependudukan_model->get_kependudukan_rw_count($i);
        }
        // dd($data);
        $data['title'] = 'Dashboard';
        $this->load->view('dashboard/index', $data);
    }
}
