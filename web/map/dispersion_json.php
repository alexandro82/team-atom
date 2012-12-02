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

$datos=array();

try {
    $indice = new Indice();
    $indicadores_x = $indice->getIndiceByIndicadorAndYear('1', '2005');
    $indicadores_y = $indice->getIndiceByIndicadorAndYear('2', '2005');

//Se recupera los datos de la base de datos fila por fila
    foreach ($indicadores_x as $filax) {
$municipio_id=$filax["municipio_id"];
$valor=$filax["valor"];
$lon=$filax["longitud"];
$lat=$filax["latitud"];
$nombre=$filax["municipio"];
$departamento=$filax["departamento"];

$datos[]=array($municipio_id => array("indicador1" => $valor,"municipio" => $nombre,"longitud" => $lon, "latitud" => $lat,"departamento" => $departamento));
} 

foreach ($indicadores_y as $filay) {
    $valor2=$filay["valor"];
    $datos[]=array($municipio_id => array("indicador2" => $valor2));
}

echo var_dump($datos);
/*
foreach ($datos as $fila) {
$municipio_id=$fila["municipio_id"];
$indicador1=$fila["indicador1"];
$indicador2=$fila["indicador2"];
$radio=10;
if (($indicador1 > 50) AND ($indicador2 > 50)) $color="FFA033";
    elseif (($indicador1 > 50) AND ($indicador2 < 50)) $color="FFDB24";
        elseif (($indicador1 < 50) AND ($indicador2 > 50)) $color="FFB508";
            elseif (($indicador1 < 50) AND ($indicador2 < 50)) $color="FF0C08";
$lon=$fila["longitud"];
$lat=$fila["latitud"];
$nombre=$fila["municipio"];
$departamento=$fila["departamento"];
if ($aux == 0) {$a=""; $aux=1;} else $a=",";
$puntos="[".$lon.", ".$lat."]";
$json.=$a.'{"type":"Feature","properties":{"color":"#'.$color.'","radio":"'.$radio.'","nombre":"'.$nombre.'","departamento":"'.$departamento.'"}, "geometry":{"type":"Point", "coordinates":'.$puntos.'}}';
$json.=']';


$json.='}';
}*/
} catch (\Exception $e) {
    error_log("Error map/municipios.php\n$e");
    $response['result'] = 'error';
    $response['exception'] = $e;
    header('HTTP/1.1 403 Forbidden');
}

echo $json;
?>
