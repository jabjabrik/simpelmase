<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('user_model');
        $this->load->library('form_validation');

        // authorize_user();
    }

    public function email()
    {
        $username = $this->session->userdata('username');
        $this->db->select('username, email');
        $user = $this->db->get_where('user', ['username' => $username]);
        $data['user'] = $user->result()[0];
        // dd($data);
        $data['title'] = 'Info Login';
        $this->load->view('account/email', $data);
    }

    public function add_update_email()
    {
        $email = $this->input->post('email');
        $verify_code = $this->input->post('verify_code');

        $result = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();
        if ($result->verify_code == $verify_code) {
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->update('user', ['verify_code' => $verify_code]);
        }
    }

    public function send_verification_email()
    {
        $this->load->library('email');
        $email = $this->input->post('email');
        // Cek apakah request menggunakan metode POST
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Ambil data JSON dari request body
            $postData = json_decode($this->input->raw_input_stream, true);

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


            $this->email->from('orangyusif92@gmail.com', 'SIMPELMASE');
            $this->email->to($postData['email']);


            $verify_code = generateRandomNumbers(5);

            $this->email->subject('Verifikasi Kode');
            $this->email->message($verify_code);

            $this->db->where('username', $this->session->userdata('username'));
            $this->db->update('user', ['verify_code' => $verify_code]);

            if ($this->email->send()) {
                echo $verify_code;
                die();
            } else {
                show_error($this->email->print_debugger());
                echo 'error';
                die();
            }
        }
    }

    public function changepassword()
    {
        $data['title'] = 'Change Password';
        $this->load->view('account/changepassword', $data);
    }

    public function changepassword_change()
    {

        $username = $this->session->userdata('username');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        $password3 = $this->input->post('password3');

        $this->form_validation->set_rules('password1', 'Password1', 'trim|callback_validate_password1');
        $this->form_validation->set_rules('password2', 'Password2', 'trim|callback_validate_password2');
        $this->form_validation->set_rules('password3', 'Password2', 'trim|matches[password2]', [
            'matches' => 'password yang anda masukan tidak sesuai'
        ]);


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('account/changepassword', $data);
            // redirect('account/changepassword');
        } else {
            $hashed_password = password_hash($password2, PASSWORD_DEFAULT);
            $data = array(
                'password' => $hashed_password,
                'is_new_user' => 0,
                'expired_password' => date('Y-m-d', strtotime('+1 year'))
            );

            $this->db->where('username', $username);
            $result = $this->db->update('user', $data);

            if ($result) {
                set_alert('Password Berhasil di Ubah', 'success');
            } else {
                set_alert('Password Gagal di Ubah', 'danger');
            }

            redirect('account/changepassword');
        }
    }

    public function validate_password1($password)
    {
        if (empty($password)) {
            $this->form_validation->set_message('validate_password1', 'Silahkan masukan password');
            return FALSE;
        }

        $username = $this->session->userdata('username');
        $user = $this->user_model->get_user_by('username', $username);
        if (password_verify($password, $user->password) == FALSE) {
            $this->form_validation->set_message('validate_password1', 'Password Salah!');
            return FALSE;
        }
        return TRUE;
    }

    public function validate_password2($password)
    {
        if (empty($password)) {
            $this->form_validation->set_message('validate_password2', 'Silahkan masukan password');
            return FALSE;
        }

        if (strlen($password) < 8) {
            $this->form_validation->set_message('validate_password2', 'Password harus minimal 8 karakter.');
            return FALSE;
        }

        // Harus mengandung setidaknya satu huruf besar
        if (!preg_match('/[A-Z]/', $password)) {
            $this->form_validation->set_message('validate_password2', 'Password harus mengandung setidaknya satu huruf besar.');
            return FALSE;
        }

        // Harus mengandung setidaknya satu huruf kecil
        if (!preg_match('/[a-z]/', $password)) {
            $this->form_validation->set_message('validate_password2', 'Password harus mengandung setidaknya satu huruf kecil.');
            return FALSE;
        }

        // Harus mengandung setidaknya satu angka
        if (!preg_match('/[0-9]/', $password)) {
            $this->form_validation->set_message('validate_password2', 'Password harus mengandung setidaknya satu angka.');
            return FALSE;
        }

        // Harus mengandung setidaknya satu karakter spesial
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $this->form_validation->set_message('validate_password2', 'Password harus mengandung setidaknya satu karakter spesial.');
            return FALSE;
        }

        return TRUE;
    }
}
