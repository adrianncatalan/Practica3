<?php 
//Requerimos conexión a BBDD
require("../BBDD/conexion_BBDD.php");

//Consulta sql
$consulta_sql_cantvehiculos = "select * from registro_usuarios where id_usuario = '$id_usuario'";
$resultados_cantvehiculos = mysqli_query($conexion, $consulta_sql_cantvehiculos);

//Mostramos registros de la BBDD con un bucle while
while ($registros_cantve = mysqli_fetch_all($resultados_cantvehiculos, MYSQLI_ASSOC)) {
   $cantvehiculos = $registros_cantve[0]["cantidad_vehiculos"];
}
?>