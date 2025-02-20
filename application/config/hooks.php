<?php
defined('BASEPATH') or exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
    'class'    => '',
    'function' => 'add_cors_headers',
    'filename' => 'add_cors_headers.php',
    'filepath' => 'hooks',
    'params'   => array()
);
