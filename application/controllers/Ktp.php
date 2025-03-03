<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ktp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        authorize_user(['sekretaris desa', 'kepala desa']);
        $this->load->model('ktp_model');
        $this->load->model('base_model');
    }

    public function index()
    {
        $data['data_result'] = $this->ktp_model->get_all();
        $data['title'] = 'Pendataan KTP';
        $this->load->view('ktp/index', $data);
    }
}
