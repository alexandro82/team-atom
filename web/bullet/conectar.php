<?php

class BDD
{
 
 // Esta variable almacena la ultima sentencia SQL usada
 var $SentenciaSQL = ""; 
 
 // Esta variable almacena el error (si existe)
 var $Error = "";
 
 function BDD()
 {
  // Datos para la conexion a la base de datos
  $this->DBHost = "localhost";  
  $this->DBUsuario = "root";
  $this->DBPassword = "";
  $this->DBNombreBDD = "atom";
 }
 
 // Conectar a la Base de Datos
 function Connect()
 {
  // Conectar a la Base de Datos
  $this->db = mysql_connect($this->DBHost,  $this->DBUsuario, $this->DBPassword) or   die("MYSQL ERROR: ".mysql_error());
  // Selecciona la base de datos
  mysql_select_db($this->DBNombreBDD,  $this->db) or die("MYSQL ERROR: ".mysql_error());
 }
 
 // Desconectar de la Base de Datos
 function Disconnect()
 {
  mysql_close($this->db) or die("MYSQL ERROR: ".mysql_error());
 } 
}

?>
