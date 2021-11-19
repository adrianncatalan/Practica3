<?php

    //Requiere la conexión BBDD
    require("../BBDD/conexion_BBDD.php");

    //Atrapamos la fecha actual con una consulta SQL
    $sql_date = "SELECT CAST(SYSDATE()as date)";

    $fecha_consulta = mysqli_query($conexion, $sql_date);
    $sysdate = mysqli_fetch_all($fecha_consulta, MYSQLI_ASSOC);
    $sysdate = $sysdate[0]['CAST(SYSDATE()as date)'];

    //Cerramos la conexión BBDD
    $conexion->close();

?>