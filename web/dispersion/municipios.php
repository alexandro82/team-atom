<?php

require_once __DIR__.'/../../app/autoload.php';

use atom\model\Municipio;

header('Content-Type: application/json; charset=utf8');

$response = array();
try {
    $municipio = new Municipio();
    $response = $municipio->getMunicipiosByMunicipioName('');
} catch (\Exception $e) {
    error_log("Error dispersion/municipios.php\n$e");
    $response['result'] = 'error';
    header('HTTP/1.1 403 Forbidden');
}

echo json_encode($response);