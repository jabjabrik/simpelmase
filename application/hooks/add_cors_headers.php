<?php

function add_cors_headers()
{
    header("Access-Control-Allow-Origin: " . base_url()); // Ganti '*' dengan domain yang spesifik
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
}
