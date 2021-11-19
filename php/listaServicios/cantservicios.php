<?php 
   //Requiere conexión BBDD
   require("../BBDD/conexion_BBDD.php");

   //Consulta SQL
   $consulta_sql_servicios = "select max(id_servicio) from registro_servicios;";
   $resultados_servicios = mysqli_query($conexion, $consulta_sql_servicios);

   //Mostramos los registros alojados en la BBDD
   while ($registros_cantse = mysqli_fetch_all($resultados_servicios, MYSQLI_ASSOC)) {
      $cantservicios = $registros_cantse[0]["max(id_servicio)"];
   }
?>