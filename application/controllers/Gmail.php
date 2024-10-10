<?php
defined('BASEPATH') or exit('No direct script access allowed');

class gmail extends CI_Controller
{
    public function index()
    {
        $this->load->library('email');
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'orangyusif92@gmail.com',
            'smtp_pass' => 'ibee vfjk sunl ohel',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'wordwrap'  => TRUE,
            'newline'   => "\r\n"
        ];

        $this->email->initialize($config);


        $this->email->from('orangyusif92@gmail.com', 'test');
        $this->email->to('yusufjabriko@gmail.com');

        $this->email->subject('Email Test');
        $this->email->message('mutakin');

        if ($this->email->send()) {
            echo 'success';
        } else {
            show_error($this->email->print_debugger());
            die();
        }
    }
}
