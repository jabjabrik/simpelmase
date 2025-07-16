<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bansos extends CI_Controller
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
        $filter = $this->input->get('f');

        $data['filter'] = $filter;
        $data['data_result'] = $this->base_model->get_all('bansos');
        $data['title'] = 'Bantuan Sosial';
        $this->load->view('bansos/index', $data);
    }

    public function edit()
    {
        $id_kependudukan = $this->input->post('id_kependudukan');
        $status_ktp = $this->input->post('status_ktp');
        $this->base_model->update('kependudukan', ['status_ktp' => $status_ktp], $id_kependudukan);
        set_alert('Berhasil mengedit status KTP penduduk', 'success');
        redirect('ktp');
    }

    public function report($filter = '')
    {
        $data['data_result'] = $this->base_model->get_all('bansos');
        $data['filter'] = $filter;
        $this->load->view('bansos/report', $data);
    }
}
