<?php
require_once __DIR__.'/../../app/autoload.php';

use atom\model\Indice;

header('Content-Type: application/json; charset=utf8');
$json="";
//Creamos el archivo json
$json.="{";
$json.='"type": "FeatureCollection",';
$json.='"features": [';
$aux=0;
$indicadores_x = array();
try {
    $indice = new Indice();
    $indicadores_x = $indice->getIndiceByIndicadorAndYear('1', '2005');

//Se recupera los datos de la base de datos fila por fila
    foreach ($indicadores_x as $fila) {
        
if ($aux == 0) {$a=""; $aux=1;} else $a=",";

$color= "e05b2f";
$radio=$fila["valor"];
$lon=$fila["municipio_longitud"];
$lat=$fila["municipio_latitud"];
$nombre=$fila["municipio"];
$departamento=$fila["departamento"];
$puntos="[".$lon.", ".$lat."]";
$json.=$a.'{"type":"Feature","properties":{"color":"#'.$color.'","radio":"'.$radio.'","nombre":"'.$nombre.'","departamento":"'.$departamento.'"}, "geometry":{"type":"Point", "coordinates":'.$puntos.'}}';
} 

$json.=']';
$json.='}';
//Creamos  el archivo json de temática
} catch (\Exception $e) {
    error_log("Error map/municipios.php\n$e");
    $response['result'] = 'error';
    $response['exception'] = $e;
    header('HTTP/1.1 403 Forbidden');
}

echo $json;
?>
