<?php
require_once __DIR__.'/../../app/autoload.php';

use atom\database\DatabaseConnection;

function busca_hijos($id,$nombre)
{
$data = array();
$sql= new DatabaseConnection;
$pdo=$sql->getConnection();
$consulta = "SELECT a.agrupador_hijo_id,i.indicador_descripcion  FROM agrupador as a INNER JOIN indicador as i ON i.id=a.agrupador_hijo_id WHERE agrupador_padre_id=".$id;
$stmt = $pdo->prepare($consulta);
 $stmt->execute();
 $data = $stmt->fetchAll(\PDO::FETCH_ASSOC); 
$aux=0;

$var='{"name": "'.$nombre.'"';

if (count($data) > 0) 
{
    
$var.=', "children": [';
foreach ($data as $fila)
    {
    if ($aux == 0) {$a=""; $aux=1;} else $a=",";
    $agrupador_hijo_id=$fila["agrupador_hijo_id"];
    $indicador_descripcion=$fila["indicador_descripcion"];
    $var.=$a.busca_hijos($agrupador_hijo_id,$indicador_descripcion);
    }
$var.=']';
}  
$var.='}';
$sql->closeConnection();
return $var;
}

function tiene_padre($var)
{
    /***
     *  Verificamos si el nodo buscado tiene un nodo padre
     */
$data = array();
$sql= new DatabaseConnection;
$pdo=$sql->getConnection();
$consulta = "SELECT id FROM agrupador WHERE agrupador_hijo_id=".$var;

$stmt = $pdo->prepare($consulta);
 $stmt->execute();
 $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

$num = count($data);
$sql->closeConnection();
//if ($num > 0) return true; else return false;
return true;
}

function nodo_inicial()
{
    /***
     * Buscamos los nodos que no tienen padre 
     *
     */
$data = array();
$lista = array();
$sql= new DatabaseConnection;
$pdo=$sql->getConnection();
// Buscamos indices en la tabla indicador1
$consulta = "SELECT DISTINCT a.agrupador_padre_id as agrupador,i.indicador_descripcion as descripcion FROM agrupador as a INNER JOIN indicador as i ON i.id=a.agrupador_padre_id";
 $stmt = $pdo->prepare($consulta);
 $stmt->execute();

//Se recupera los datos de la base de datos fila por fila
$data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
foreach ($data as $fila)
{
    $agrupador_padre_id=$fila["agrupador"];
    $indicador_descripcion=$fila["descripcion"];
    if (!tiene_padre($agrupador_padre_id)) 
        {
        $lista[]=array($agrupador_padre_id,$indicador_descripcion);
        }
    }
$sql->closeConnection();
return $lista;

}

$json="";
//Creamos el archivo json
$json.="{";
$json.='"name": "Indices",';
$json.='"children": [';






$aux=0;

foreach (nodo_inicial() as $nodo) {
    if ($aux == 0) {$a=""; $aux=1;} else $a=",";
 $nodos_hijos=busca_hijos($nodo[0],$nodo[1]);
  $json.=$a.$nodos_hijos;
};

$json.=']';
$json.='}';
echo $json;
?>
