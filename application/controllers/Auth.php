<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->helper('captcha');
        $this->load->model('kependudukan_model');
    }

    public function index()
    {
        $username = $this->session->userdata("username");
        $role = $this->session->userdata("role");

        if ($username) {
            if ($role == "penduduk") {
                redirect("surat");
            } else {
                redirect("dashboard");
            }
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|callback_validate_username');
        $this->form_validation->set_rules('password', 'Password', 'trim|callback_validate_password');
        // $this->form_validation->set_rules('captcha', 'Captcha', 'callback_validate_captcha');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $data['captcha_img'] = $this->_captcha();
            $this->load->view('auth/login', $data);
        } else {
            $this->_login();
        }
    }

    public function validate_username($username)
    {
        if (empty($username)) {
            $this->form_validation->set_message('validate_username', 'Silahkan masukan username');
            return FALSE;
        }

        $this->db->where('username', $username);
        $query = $this->db->get('user');

        if ($query->num_rows() === 0) {
            $this->form_validation->set_message('validate_username', 'Username tidak ditemukan');
            return FALSE;
        }
        return TRUE;
    }

    public function validate_password($password)
    {
        if (empty($password)) {
            $this->form_validation->set_message('validate_password', 'Silahkan masukan password');
            return FALSE;
        }

        $username = $this->input->post('username');
        $this->db->where('username', $username);
        $query = $this->db->get('user');

        if ($query->num_rows() == 0) {
            $this->form_validation->set_message('validate_password', '');
            return FALSE;
        }

        $user = $query->row();

        // Cek apakah pengguna sudah mencapai batas percobaan login
        $current_time = time();
        $last_attempt_time = strtotime($user->last_login_attempt);

        $time  = 180; // 3mnt
        if ($user->login_attempts >= 5) {
            // Jika 5 kali salah
            if (($current_time - $last_attempt_time) < $time) {
                // kurang dari 3 menit
                $remaining_time = $time - ($current_time - $last_attempt_time);
                $this->form_validation->set_message("validate_password", "Terlalu banyak percobaan login. Silakan coba lagi setelah " . ceil($remaining_time / 60) . " menit.");
                return FALSE;
            } else {
                $this->user_model->reset_login_attempts($user->username);
            }
        }

        if (password_verify($password, $user->password)) {
            $this->user_model->reset_login_attempts($user->username);
            return TRUE;
        } else {
            $this->user_model->increment_login_attempts($user->username);
            $this->form_validation->set_message('validate_password', 'Password salah');
            return FALSE;
        }
    }

    public function validate_captcha($captcha)
    {
        if (empty($captcha)) {
            $this->form_validation->set_message('validate_captcha', 'Silahkan masukan captcha');
            return FALSE;
        }

        if ($this->session->userdata('captcha_word') !== $captcha) {
            $this->form_validation->set_message('validate_captcha', 'Captcha tidak sesuai');
            return FALSE;
        }
        return TRUE;
    }



    private function _captcha()
    {
        $params = array(
            'img_path'      => './captcha-images/',
            'img_url'       => base_url() . 'captcha-images/',
            'font_path'     => './path/to/fonts/texb.ttf',
            'img_width'     => 150,
            'img_height'    => 30,
            'expiration'    => 7200,
            'word_length'   => 5,
            'font_size'     => 16,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors'        => array(
                'background'    => array(255, 255, 255),
                'border'        => array(255, 255, 255),
                'text'          => array(0, 0, 0),
                'grid'          => array(255, 40, 40)
            )
        );

        $cap = create_captcha($params);
        $captcha_word = $cap['word'];
        $this->session->set_userdata('captcha_word', $captcha_word);
        return $cap['image'];
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user     = $this->user_model->get_user_by("username", $username);


        if (isset($user)) {
            if (password_verify($password, $user->password)) {
                $data = [
                    'username'        => $user->username,
                    'id_kependudukan' => $user->id_kependudukan,
                    'role'            => $user->role,
                    'nama'            => $this->kependudukan_model->get_kependudukan_by("id_kependudukan", $user->id_kependudukan)->nama,
                ];

                $this->session->set_userdata($data);

                $current_date = new DateTime(date('Y-m-d'));
                $expired_date = new DateTime($user->expired_password);

                if ($user->is_new_user) {
                    set_alert('Mohon Ubah Kata Sandi Default Anda', 'warning');
                }

                if ($current_date > $expired_date) {
                    set_alert('Mohon Ubah Kata Sandi Anda Karena Sudah Melebihi 1 Tahun', 'warning');
                }

                redirect("dashboard");
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak ditemukan</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        // $this->session->unset_userdata('username');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil logout!</div>');
        redirect('auth');
    }
}
