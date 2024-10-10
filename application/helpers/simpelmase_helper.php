<?php

use PhpOffice\PhpWord\TemplateProcessor;


function is_logged_in()
{
    $CI = &get_instance();
    if (!$CI->session->userdata('username')) {
        redirect("/");
    }
}

function authorize_user()
{
    $CI = &get_instance();
    $role = $CI->session->userdata("role");
    if ($role == "penduduk") {
        redirect("surat");
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
    $config['allowed_types'] = 'jpg|png|jpeg|webp';
    $config['max_size'] = 2048;

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
