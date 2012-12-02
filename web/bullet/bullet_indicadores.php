<?php
include_once("conectar.php");

  

 
$sql= new BDD;
$sql->Connect();


//Creamos  el archivo json de temática
// Se realiza una busqueda de los puntos en la base de datos
$codigom=236;
$gestionm=2005;
$consulta = "select m.id,ind.id indi,m.municipio_nombre,i.indice_gestion,i.indice_valor,ind.indicador_descripcion from municipio m,indice i,indicador ind where m.id=i.municipio_id and ind.id=i.indicador_id and m.id=$codigom and i.indice_gestion=$gestionm and ind.id>30";
$resultado = mysql_query($consulta) or die(mysql_error());

 //{"title":"Revenue","subtitle":"US$, in thousands","ranges":[150,225,300],"measures":[220,270],"markers":[250]},
//{";
$json='[';
$aux=0;
//Se recupera los datos de la base de datos fila por fila
while ($fila = @mysql_fetch_assoc($resultado))
{
if ($aux == 0) {$a=""; $aux=1;} else $a=",";

$q=0;
$r=$fila["indi"];
//print($r);
$consulta2 = "select avg(i.indice_valor) from municipio m,indice i,indicador ind where m.id=i.municipio_id and ind.id=i.indicador_id and i.indice_gestion=$gestionm and ind.id=$r";
//print($consulta2);
$resultado2 = mysql_query($consulta2) or die(mysql_error());
     if ($resultado2) {
            $row = mysql_fetch_row($resultado2);
            $q = $row[0];
        }
   
$nombre=$fila["indicador_descripcion"];
$valor=$fila["indice_valor"];
$json.=$a.'{"title":"'.$nombre.'","subtitle":"-","ranges":[0,100],"measures":['.$valor.'],"markers":['.$q.']}';
} 

$json.=']';


//Creamos  el archivo json de temática


$sql->Disconnect();


echo $json;
?>
