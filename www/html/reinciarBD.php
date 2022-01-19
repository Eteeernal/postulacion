<?php
header('Cache-Control: no-cache, must-revalidate');
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header('Content-type: application/json');

require_once './src/subidaArchivos/Archivos.php';

$archivos = new Archivos();
$archivos->CreateTable();

$json = ['status' => 'success'];
echo json_encode(array_utf8_encode($json));