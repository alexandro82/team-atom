<?php

require_once __DIR__.'/../../app/autoload.php';

use atom\model\Municipio;

header('Content-Type: application/json');

$response = array();
try {
    $municipio = new Municipio();
    $municipio->setData($_POST);
    $municipio->save();
    $response['result'] = 'ok';
} catch (\Exception $e) {
    $response['result'] = 'error';
    header('HTTP/1.1 403 Forbidden');
}

echo json_encode($response);