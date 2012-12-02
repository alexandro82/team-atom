<?php
include_once("conectar.php");

$sql= new BDD;
$sql->Connect();

//Creamos  el archivo json de temática
// Se realiza una busqueda de los puntos en la base de datos
$consulta = "SELECT  m.municipio_longitud,m.municipio_latitud,m.municipio_nombre,m.municipio_departamento,m.municipio_categoria FROM municipio AS m ";

$resultado = mysql_query($consulta) or die(mysql_error());

$json="";
//Creamos el archivo json
$json.="{";
$json.='"type": "FeatureCollection",';
$json.='"features": [';
$aux=0;
//Se recupera los datos de la base de datos fila por fila
while ($fila = @mysql_fetch_assoc($resultado))
{
if ($aux == 0) {$a=""; $aux=1;} else $a=",";

$color= "e05b2f";
$radio=10;
$lon=$fila["municipio_longitud"];
$lat=$fila["municipio_latitud"];
$nombre=$fila["municipio_nombre"];
$departamento=$fila["municipio_departamento"];
$categoria=$fila["municipio_categoria"];
$puntos="[".$lon.", ".$lat."]";
$json.=$a.'{"type":"Feature","properties":{"color":"#'.$color.'","radio":"'.$radio.'","nombre":"'.$nombre.'","departamento":"'.$departamento.'","categoria":"'.$categoria.'"}, "geometry":{"type":"Point", "coordinates":'.$puntos.'}}';
} 

$json.=']';
$json.='}';
//Creamos  el archivo json de temática

$sql->Disconnect();

echo $json;
?>
