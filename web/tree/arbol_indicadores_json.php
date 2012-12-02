<?php
include_once("conectar.php");



function busca_hijos($var)
{
// Buscamos indices en la tabla indicador
$consulta = "SELECT agrupador_hijo_id FROM agrupador WHERE agrupador_padre_id=".$var;
$resultado = mysql_query($consulta) or die("Error nodo_padre".mysql_error());  

$lista=array();
while ($fila= mysql_fetch_assoc($resultado))
    {
    $agrupador_hijo_id=$fila["agrupador_hijo_id"];
    $lista[]=$agrupador_hijo_id;
    }
    
return $lista;
}

function tiene_padre($var)
{
    /***
     *  Verificamos si el nodo buscado tiene un nodo padre
     */

// Buscamos indices en la tabla indicador
$consulta = "SELECT id FROM agrupador WHERE agrupador_hijo_id=".$var;
$resultado = mysql_query($consulta) or die("Error nodo_padre".mysql_error());
//Se recupera los datos de la base de datos fila por fila
$num = mysql_num_rows($resultado);

if ($num > 0) return true; else return false;
}

function nodo_inicial()
{
    /***
     * Buscamos los nodos que no tienen padre 
     *
     */
$lista=array();
// Buscamos indices en la tabla indicador
$consulta = "SELECT DISTINCT agrupador_padre_id FROM agrupador";
$resultado = mysql_query($consulta) or die("Error nodo_inicial ".mysql_error());
//Se recupera los datos de la base de datos fila por fila
while ($fila= mysql_fetch_assoc($resultado))
    {
    $agrupador_padre_id=$fila["agrupador_padre_id"];
    if (!tiene_padre($agrupador_padre_id)) $lista[]=$agrupador_padre_id;
    }

return $lista;

}


/*
$json="";
//Creamos el archivo json
$json.="{";
$json.='"name": "Indices",';
$json.='"children": [';
$aux1=0;

// Buscamos indices en la tabla indicador
$consulta_indice = "SELECT agrupador_padre_id FROM agrupador  ";
$resultado_indice = mysql_query($consulta_indice) or die(mysql_error());
//Se recupera los datos de la base de datos fila por fila
while ($fila_indice = @mysql_fetch_assoc($resultado_indice))
{
if ($aux1 == 0) {$a=""; $aux1=1;} else $a=",";

$indice_id=$fila_indice["id"];
$indice_descripcion=$fila_indice["indicador_descripcion"];
$json.=$a.'{"name":"'.$indice_descripcion.'","children": [';
$aux1=0;
// Buscamos subindices en la tabla indicador
$consulta_indice = "SELECT i.id, i.indicador_descripcion,i.indicador_tipo FROM indicador as i 
    INNER JOIN agrupador as a ON i.id=a.agrupador_hijo_id
 WHERE i.indicador_tipo='SUBINDICE' AND a.agrupador_hijo_id='$indice_id' ";
$resultado_indice = mysql_query($consulta_indice) or die(mysql_error());
//Se recupera los datos de la base de datos fila por fila
} 

$json.=']';
$json.='}';
//Creamos  el archivo json de temática
*/
$sql= new BDD;
$sql->Connect();

foreach (nodo_inicial() as $nodo) {
 $nodos_hijos=busca_hijos($nodo);
 if (count($nodos_hijos) > 0) 
     foreach ($nodos_hijos as $nodo_hijo) {
         echo $nodo."-".$nodo_hijo."<br />";
     }   
};
$sql->Disconnect();    
//echo $json;
?>
