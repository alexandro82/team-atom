<?php

require_once __DIR__.'/../../app/autoload.php';

use atom\model\Indice;

header('Content-Type: application/json; charset=utf8');

$response = array();
try {
    $indice = new Indice();
    $response = $indice->getIndiceByIndicador($_POST['index']);
} catch (\Exception $e) {
    error_log("Error dispersion/municipios.php\n$e");
    $response['result'] = 'error';
    $response['exception'] = $e;
    header('HTTP/1.1 403 Forbidden');
}

echo json_encode($response);