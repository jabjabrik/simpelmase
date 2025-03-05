<?php

use PhpOffice\PhpWord\TemplateProcessor;

function authorize_user(array $roles): void
{
    $CI = &get_instance();
    $role = $CI->session->userdata('role');

    if (!$role) redirect();

    if (!in_array($role, $roles)) {
        if ($role == 'penduduk') {
            redirect('surat');
        } else {
            redirect('dashboard');
        }
    }
}

function convert_usia(string $tanggal_lahir): string
{
    $tanggal_lahir = new DateTime($tanggal_lahir);
    $now = new DateTime();
    $selisih = $now->diff($tanggal_lahir);
    $usia = $selisih->y;
    return $usia;
}

function convert_kelas_usia(string $usia): string
{
    if ($usia < 7) {
        return "Tidak/Belum Sekolah";
    } else if ($usia >= 7 && $usia <= 12) {
        return $usia - 6 . " SD/Sederajat";
    } else if ($usia >= 13 && $usia <= 15) {
        return $usia - 6 . " SMP/Sederajat";
    } else if ($usia >= 16 && $usia <= 18) {
        return $usia - 6 . " SMA/Sederajat";
    } else {
        return "Lulus";
    }
}

function convert_kelas_real($kelas, $kelas_update)
{


    $tanggal_update = new DateTime($kelas_update);
    $tahun_update = (int) $tanggal_update->format('Y');

    // Tentukan tanggal tahun ajaran baru
    $tahun_ajaran_baru = new DateTime("$tahun_update-07-01");

    // Ambil tanggal hari ini
    $sekarang = new DateTime();

    // Jika sudah melewati 1 Juli tahun ini, maka kelas naik
    if ($sekarang >= $tahun_ajaran_baru) {
        $kelas_baru = $kelas + 1;
    } else {
        $kelas_baru = $kelas;
    }

    if ($kelas_baru >= 1 && $kelas_baru <= 6) {
        return $kelas_baru . " SD/Sederajat";
    } else if ($kelas_baru >= 7 && $kelas_baru <= 9) {
        return $kelas_baru . " SM/SederajatP";
    } else if ($kelas_baru >= 10 && $kelas_baru <= 12) {
        return $kelas_baru . " SMA/Sederajat";
    } else {
        return "Lulus";
    }
}



function dd($data)
{
    var_dump($data);
    die();
}


function generate_surat($jenis_surat, $data)
{
    $templateFile = "files/dokumen/template/$jenis_surat.docx";
    $templateProcessor = new TemplateProcessor($templateFile);
    $templateProcessor->setValues($data);
    $id = substr(bin2hex(random_bytes(7)), 0, 7);
    $output_file = "$id-$jenis_surat.docx";
    $templateProcessor->saveAs("files/dokumen/$output_file");
    return $output_file;
}

function generate_id($table_name)
{
    $ci = get_instance();

    if ($table_name == 'sk_usaha') {
        $latest_id = $ci->db->query("SELECT id FROM $table_name ORDER BY id DESC LIMIT 1")->row('id');
        if (!$latest_id) {
            return '001';
        }
        $convert_numeric = sscanf($latest_id, "sku_%d")[0];
        return sprintf("%03d", $convert_numeric + 1);
    }
}

function generate_no_surat($surat)
{
    $CI = &get_instance();
    $CI->load->model('surat_model');

    $no = "/426.420.10/";
    $latest_id = $CI->surat_model->get_latest_surat($surat)->row("id");
    $year = mdate('%Y', now());

    if ($latest_id) {
        $id = sprintf("%03d", intval($latest_id) + 1);
    } else {
        $id = '001';
    }
    return "$id/426.420.10/$year";
}

function upload_file($file_upload)
{
    $CI = get_instance();
    $image_type = pathinfo($_FILES[$file_upload]['name'], PATHINFO_EXTENSION);
    $id = substr(bin2hex(random_bytes(7)), 0, 7);

    $config['upload_path'] = "./files/img/";
    $config['file_name'] = "$file_upload-$id.$image_type";
    $config['allowed_types'] = '*';

    $CI->upload->initialize($config);
    if (!$CI->upload->do_upload($file_upload)) {
        var_dump($CI->upload->display_errors());
        die();
    } else {
        return $CI->upload->data()['file_name'];
    }
}

function set_alert($message, $color)
{
    $CI = get_instance();
    $params = array(
        'message' => $message,
        'color' => $color
    );
    $CI->session->set_flashdata('alert', $params);
}

function generateRandomNumbers($length)
{
    $numbers = '';
    for ($i = 0; $i < $length; $i++) {
        $numbers .= rand(0, 9); // Menghasilkan angka acak antara 0-9
    }
    return $numbers;
}
