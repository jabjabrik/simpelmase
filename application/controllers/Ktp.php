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
        $filter = $this->input->get('f');
        $op = $this->input->get('op') ?? '>';

        if (!empty($filter) && !preg_match('/\b(1|2|3)\b/', $filter)) {
            redirect('ktp');
        }

        $data['filter'] = $filter;
        $data['op'] = $op;
        $data['data_result'] = $this->ktp_model->get_all($filter, $op);
        $data['title'] = 'Pendataan KTP';
        $this->load->view('ktp/index', $data);
    }

    public function edit()
    {
        $id_kependudukan = $this->input->post('id_kependudukan');
        $status_ktp = $this->input->post('status_ktp');
        $this->base_model->update('kependudukan', ['status_ktp' => $status_ktp], $id_kependudukan);
        set_alert('Berhasil mengedit status KTP penduduk', 'success');
        redirect('ktp');
    }
}
