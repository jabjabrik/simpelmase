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


        $this->email->from('orangyusif92@gmail.com', 'simpelmase');
        $this->email->to('yusufjabriko@gmail.com');

        $this->email->subject('Verifikasi Kode');
        $this->email->message('
        <!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
            text-align: center;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .code-box {
            font-size: 24px;
            font-weight: bold;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <p>Halo,</p>
        <p>Berikut adalah kode verifikasi satu kali Anda:</p>
        <div class="code-box">345678</div>
        <p>Kode ini hanya berlaku selama 90 menit. Jika kode ini sudah kadaluarsa, silakan ajukan permintaan kode baru.</p>
        <div class="footer">
            <p>Terima kasih telah menggunakan SimpleMase!</p>
            <p>SimpleMase - Sistem Informasi Pelayanan Masyarakat Desa</p>
        </div>
    </div>
</body>

</html>
        ');

        if ($this->email->send()) {
            echo 'success';
        } else {
            show_error($this->email->print_debugger());
            die();
        }
    }
}
