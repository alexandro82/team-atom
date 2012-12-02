<?php

require_once __DIR__.'/../../app/autoload.php';

use atom\model\Indice;

header('Content-Type: application/json; charset=utf8');

$response = array();
$indicadores_x = array();
$indicadores_y = array();
try {
    $indice = new Indice();
    $indicadores_x = $indice->getIndiceByIndicadorAndYear('1');
    $indicadores_y = $indice->getIndiceByIndicadorAndYear('2');
    $response[] = $indicadores_x;
    $response[] = $indicadores_y;
} catch (\Exception $e) {
    error_log("Error dispersion/municipios.php\n$e");
    $response['result'] = 'error';
    $response['exception'] = $e;
    header('HTTP/1.1 403 Forbidden');
}

echo json_encode($response);