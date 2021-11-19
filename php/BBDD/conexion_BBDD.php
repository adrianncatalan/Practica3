<?php

    require("../BBDD/datos_conexion_BBDD.php");

    $conexion = mysqli_connect($db_host, $db_usuario, $db_clave);

    if(mysqli_connect_errno()){

        echo "Fallo al conectar con el servidor o la ubicación a la que pretende entrar no existe.";

        exit();

    } 

    mysqli_select_db($conexion, $db_nombre) or die ("No se encuentra la BBDD o el nombre de la BBDD es incorrecto.");

    mysqli_set_charset($conexion, "utf8");
    
?>